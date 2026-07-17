<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Web;

/**
 * Mensajes de un solo uso entre una petición y la siguiente.
 *
 * Sostienen el patrón POST-Redirect-GET del formulario: tras guardar la
 * solicitud se redirige, de modo que recargar la página no vuelva a enviarla.
 */
final class Sesion
{
    private const ESPACIO = 'dacoach.avisos';

    public function iniciar(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE || headers_sent()) {
            return;
        }

        session_set_cookie_params([
            'httponly' => true,
            'samesite' => 'Lax',
            'secure' => ($_SERVER['HTTPS'] ?? '') !== '',
        ]);
        session_start();
    }

    /**
     * @param array<string, mixed> $valor
     */
    public function guardarAviso(string $clave, array $valor): void
    {
        $this->iniciar();
        $_SESSION[self::ESPACIO][$clave] = $valor;
    }

    /**
     * Lee el aviso y lo consume: al recargar ya no aparece.
     *
     * @return array<string, mixed>|null
     */
    public function tomarAviso(string $clave): ?array
    {
        $this->iniciar();
        $valor = $_SESSION[self::ESPACIO][$clave] ?? null;
        unset($_SESSION[self::ESPACIO][$clave]);

        return \is_array($valor) ? $valor : null;
    }
}
