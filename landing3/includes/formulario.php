<?php
declare(strict_types=1);

/**
 * Procesa el formulario de contacto. Se incluye desde index.php antes de imprimir HTML.
 * Expone: $errores (array), $valores (array), $enviado (bool), $csrf (string).
 *
 * Patrón POST/Redirect/GET: al enviar con éxito redirige a ?enviado=1#contacto para que
 * un refresh del navegador no reenvíe el lead.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf'];

$errores = [];
$valores = ['nombre' => '', 'empresa' => '', 'email' => '', 'telefono' => '', 'sector' => '', 'mensaje' => ''];
$enviado = isset($_GET['enviado']);

function lead_limpiar(string $v, int $max): string
{
    $v = trim($v);
    // Corta inyección de cabeceras en el correo.
    $v = str_replace(["\r", "\n", "%0a", "%0d"], ' ', $v);
    return mb_substr($v, 0, $max);
}

function lead_guardar_respaldo(array $datos, string $dir): void
{
    if (!is_dir($dir) && !@mkdir($dir, 0750, true) && !is_dir($dir)) {
        return;
    }
    // Evita que el CSV sea servible por el navegador si el docroot apunta aquí.
    $htaccess = $dir . '/.htaccess';
    if (!file_exists($htaccess)) {
        @file_put_contents($htaccess, "Require all denied\n");
    }

    $archivo = $dir . '/leads.csv';
    $nuevo   = !file_exists($archivo);
    $fh      = @fopen($archivo, 'a');
    if ($fh === false) {
        return;
    }
    if (flock($fh, LOCK_EX)) {
        if ($nuevo) {
            fputcsv($fh, ['fecha', 'nombre', 'empresa', 'email', 'telefono', 'sector', 'mensaje', 'ip']);
        }
        fputcsv($fh, [
            date('c'),
            $datos['nombre'],
            $datos['empresa'],
            $datos['email'],
            $datos['telefono'],
            $datos['sector'],
            $datos['mensaje'],
            $_SERVER['REMOTE_ADDR'] ?? '',
        ]);
        flock($fh, LOCK_UN);
    }
    fclose($fh);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot: los bots llenan todos los campos, las personas no ven este.
    $trampa = trim((string)($_POST['sitio_web'] ?? ''));

    if (!hash_equals($csrf, (string)($_POST['csrf'] ?? ''))) {
        $errores['general'] = 'Tu sesión expiró. Vuelve a enviar el formulario, por favor.';
    }

    $valores['nombre']   = lead_limpiar((string)($_POST['nombre'] ?? ''), 120);
    $valores['empresa']  = lead_limpiar((string)($_POST['empresa'] ?? ''), 120);
    $valores['email']    = lead_limpiar((string)($_POST['email'] ?? ''), 160);
    $valores['telefono'] = lead_limpiar((string)($_POST['telefono'] ?? ''), 40);
    $valores['sector']   = lead_limpiar((string)($_POST['sector'] ?? ''), 80);
    $valores['mensaje']  = mb_substr(trim((string)($_POST['mensaje'] ?? '')), 0, 2000);

    if ($valores['nombre'] === '') {
        $errores['nombre'] = 'Indícanos tu nombre.';
    }
    if ($valores['email'] === '' || !filter_var($valores['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Necesitamos un correo válido para responderte.';
    }
    if (mb_strlen($valores['mensaje']) < 10) {
        $errores['mensaje'] = 'Cuéntanos en una o dos líneas qué necesitas.';
    }
    if (!in_array($valores['sector'], $config['sectores_form'], true)) {
        $valores['sector'] = '';
    }

    if (!$errores && $trampa === '') {
        $asunto = 'Nueva solicitud de diagnóstico — ' . ($valores['empresa'] !== '' ? $valores['empresa'] : $valores['nombre']);

        $cuerpo = "Nueva solicitud desde la landing.\n\n"
            . "Nombre:   {$valores['nombre']}\n"
            . "Empresa:  " . ($valores['empresa'] !== '' ? $valores['empresa'] : '—') . "\n"
            . "Correo:   {$valores['email']}\n"
            . "Teléfono: " . ($valores['telefono'] !== '' ? $valores['telefono'] : '—') . "\n"
            . "Sector:   " . ($valores['sector'] !== '' ? $valores['sector'] : '—') . "\n\n"
            . "Mensaje:\n{$valores['mensaje']}\n\n"
            . "---\nFecha: " . date('d/m/Y H:i') . "\n"
            . "IP: " . ($_SERVER['REMOTE_ADDR'] ?? '—') . "\n";

        $cabeceras = [
            'From: ' . $config['empresa']['marca'] . ' <' . $config['contacto']['email_remitente'] . '>',
            'Reply-To: ' . $valores['nombre'] . ' <' . $valores['email'] . '>',
            'Content-Type: text/plain; charset=UTF-8',
            'X-Mailer: PHP/' . phpversion(),
        ];

        lead_guardar_respaldo($valores, __DIR__ . '/../data');

        $ok = @mail(
            $config['contacto']['email_destino'],
            '=?UTF-8?B?' . base64_encode($asunto) . '?=',
            $cuerpo,
            implode("\r\n", $cabeceras)
        );

        // El lead ya quedó en el CSV aunque mail() falle, así que confirmamos igual
        // y dejamos rastro del fallo en el log del servidor.
        if (!$ok) {
            error_log('[landing] mail() falló para el lead: ' . $valores['email']);
        }

        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?enviado=1#contacto', true, 303);
        exit;
    }

    // Un bot cayó en el honeypot: fingimos éxito sin hacer nada.
    if (!$errores && $trampa !== '') {
        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?enviado=1#contacto', true, 303);
        exit;
    }
}
