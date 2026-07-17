<?php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';
require __DIR__ . '/includes/formulario.php';

function e(?string $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$wa = 'https://wa.me/' . preg_replace('/\D+/', '', $config['contacto']['whatsapp'])
    . '?text=' . rawurlencode($config['contacto']['whatsapp_mensaje']);

/** Busca el logo sin exigir una extensión concreta. Devuelve null si no está. */
function logo_de(string $base): ?string
{
    foreach (['svg', 'webp', 'png', 'jpg', 'jpeg'] as $ext) {
        $rel = 'assets/logos/' . $base . '.' . $ext;
        if (is_file(__DIR__ . '/' . $rel)) {
            return $rel;
        }
    }
    return null;
}

/** Aviso visible sobre los bloques con datos inventados. Se apaga con 'borrador' => false. */
function aviso_borrador(bool $activo, string $texto): string
{
    if (!$activo) {
        return '';
    }
    return '<p class="borrador"><svg viewBox="0 0 16 16" fill="none" aria-hidden="true" width="14" height="14">'
        . '<path d="M8 1.5 15 14H1z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>'
        . '<path d="M8 6.2v3.1M8 11.5v.1" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>'
        . e($texto) . '</p>';
}

/** Iniciales para el avatar cuando todavía no hay foto. */
function iniciales(string $nombre): string
{
    $partes = preg_split('/\s+/', trim($nombre)) ?: [];
    $ini = '';
    foreach (array_slice($partes, 0, 2) as $p) {
        $ini .= mb_strtoupper(mb_substr($p, 0, 1));
    }
    return $ini !== '' ? $ini : '?';
}

/** Isotipo en línea: hereda el color del contexto (verde en claro, blanco en oscuro). */
function isotipo(int $px = 21): string
{
    return '<svg class="marca__logo" width="' . $px . '" height="' . $px . '" viewBox="0 0 32 32" '
        . 'fill="currentColor" fill-rule="evenodd" aria-hidden="true">'
        . '<path d="M7 4v24h6a12 12 0 0 0 0-24zm8.6 7.6a4.4 4.4 0 1 1 0 8.8 4.4 4.4 0 0 1 0-8.8z"/></svg>';
}

$servicios = [
    [
        'titulo' => 'Consultoría estratégica en IA',
        'texto'  => 'Analizamos procesos, objetivos y necesidades para identificar oportunidades concretas antes de escribir una línea de código.',
        'items'  => ['Evaluación de procesos actuales', 'Identificación de tareas repetitivas', 'Priorización por impacto y viabilidad'],
    ],
    [
        'titulo' => 'Automatización de procesos',
        'texto'  => 'Diseñamos flujos de trabajo que reducen tareas manuales, errores y tiempos de respuesta.',
        'items'  => ['Registro y clasificación de solicitudes', 'Notificaciones y recordatorios', 'Reportes y coordinación interna'],
    ],
    [
        'titulo' => 'Bots y asistentes inteligentes',
        'texto'  => 'Asistentes conversacionales para atención, orientación y soporte, con escalamiento a personas cuando hace falta.',
        'items'  => ['Preguntas frecuentes y atención inicial', 'Captación y clasificación de prospectos', 'Soporte fuera del horario laboral'],
    ],
    [
        'titulo' => 'Integración de canales y sistemas',
        'texto'  => 'Conectamos tus canales de comunicación con las herramientas que ya usa tu operación.',
        'items'  => ['WhatsApp, Telegram y correo', 'CRM, bases de datos y plataformas internas', 'Google Workspace, calendarios y formularios'],
    ],
    [
        'titulo' => 'Atención automatizada 24/7',
        'texto'  => 'Recibe, orienta y registra solicitudes a cualquier hora, sin dejar a nadie esperando hasta el día siguiente.',
        'items'  => ['Respuesta inicial inmediata', 'Clasificación de consultas', 'Notificación al equipo responsable'],
    ],
    [
        'titulo' => 'Optimización operativa interna',
        'texto'  => 'Mejoramos la coordinación, el seguimiento y la organización entre áreas.',
        'items'  => ['Estandarización de procesos', 'Centralización de información', 'Indicadores y reportes operativos'],
    ],
    [
        'titulo' => 'Soluciones personalizadas',
        'texto'  => 'Proyectos a la medida cuando ninguna herramienta del mercado resuelve tu necesidad particular.',
        'items'  => ['Agentes inteligentes y apps internas', 'Paneles de control y alertas', 'Flujos de aprobación e integraciones'],
    ],
];

// Los subtítulos van cortos a propósito: son los que se desbordan de la tarjeta.
$antes = [
    ['Mensajes en canales dispersos', 'Correos, chats y llamadas sin registro central.'],
    ['Información copiada a mano',    'Errores al pasar datos de una app a otra.'],
    ['Solicitudes sin clasificar',    'Bandejas llenas sin saber qué es urgente.'],
    ['Seguimientos que se olvidan',   'Oportunidades perdidas por no responder.'],
    ['Reportes armados a fin de mes', 'Horas buscando datos en hojas de cálculo.'],
    ['Respuestas de varios días',     'Clientes que se cansan de esperar.'],
    ['Sin forma de medir resultados', 'Ninguna métrica real del equipo.'],
];

$despues = [
    ['Todo en una sola bandeja',      'La comunicación entra unificada.',        'Automático'],
    ['Clasificación automática',      'El motivo y la urgencia, al instante.',   'Automático'],
    ['Información registrada sola',   'Sincronización sin transcribir nada.',    'Automático'],
    ['Notificación inmediata',        'El responsable se entera en segundos.',   'Automático'],
    ['Seguimiento paso a paso',       'Flujos claros con responsable asignado.', 'Automático'],
    ['Reportes en tiempo real',       'Paneles accesibles en un clic.',          'Automático'],
    ['Escalamiento a una persona',    'Tu equipo entra donde hace falta juicio.', 'Tu equipo'],
];

$metodologia = [
    ['Descubrimiento', 'Comprendemos la empresa, sus objetivos, procesos y desafíos.'],
    ['Diagnóstico',    'Identificamos oportunidades de mejora, automatización e integración.'],
    ['Diseño',         'Definimos arquitectura, herramientas, flujos y resultados esperados.'],
    ['Implementación', 'Configuramos, integramos o desarrollamos la solución y la probamos.'],
    ['Validación',     'Revisamos la solución contigo antes de que entre en operación.'],
    ['Capacitación',   'Preparamos a quienes van a usarla y a quienes van a supervisarla.'],
    ['Optimización',   'Medimos el desempeño y ajustamos cuando es necesario.'],
];

$responsabilidad = [
    'Definición clara del alcance y las limitaciones',
    'Accesos y permisos según responsabilidades',
    'Supervisión humana en procesos sensibles',
    'Manejo de errores y excepciones',
    'Protección de datos y buenas prácticas de privacidad',
    'Registro y trazabilidad de acciones',
];

$sectores = [
    'Servicios profesionales y consultorías',
    'Salud, bienestar e investigación clínica',
    'Comercio, ventas y atención al cliente',
    'Educación y capacitación',
    'Empresas con citas o reservaciones',
    'Organizaciones con equipos distribuidos',
    'Pymes en crecimiento',
];

// Íconos reutilizados.
$icoCheck = '<svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8.5 6 11.5 13 4.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($config['empresa']['nombre']) ?> — Inteligencia artificial con estrategia, propósito y acompañamiento humano</title>
<meta name="description" content="<?= e($config['empresa']['descripcion']) ?> Transformamos procesos manuales en soluciones inteligentes, automatizadas y escalables.">
<meta name="theme-color" content="#fbfaf8">
<link rel="canonical" href="<?= e($config['empresa']['url']) ?>">

<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($config['empresa']['nombre']) ?> — Tecnología con propósito">
<meta property="og:description" content="<?= e($config['empresa']['descripcion']) ?>">
<meta property="og:url" content="<?= e($config['empresa']['url']) ?>">
<meta property="og:locale" content="es_ES">

<link rel="icon" type="image/svg+xml" href="assets/logos/dacoach-ficha.svg">
<link rel="apple-touch-icon" href="assets/logos/dacoach-ficha.svg">
<link rel="stylesheet" href="assets/css/estilos.css">

<script type="application/ld+json">
<?= json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'ProfessionalService',
    'name'        => $config['empresa']['nombre'],
    'description' => $config['empresa']['descripcion'],
    'url'         => $config['empresa']['url'],
    'email'       => $config['contacto']['email_publico'],
    'telephone'   => $config['contacto']['whatsapp_visible'],
    'areaServed'  => 'LATAM',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
</head>
<body>
<a class="saltar" href="#contenido">Saltar al contenido</a>

<header class="cabecera" id="cabecera">
  <div class="contenedor cabecera__inner">
    <a class="marca" href="#" aria-label="<?= e($config['empresa']['nombre']) ?> — inicio">
      <?= isotipo() ?>
      <?= e($config['empresa']['marca']) ?>
      <span class="marca__sub">Integral Services</span>
    </a>
    <nav class="nav" aria-label="Principal">
      <span class="nav__enlaces">
        <a href="#caso">Un caso</a>
        <a href="#servicios">Servicios</a>
        <a href="#metodologia">Metodología</a>
        <a href="#equipo">Quiénes somos</a>
      </span>
      <a class="btn btn--primario btn--pequeno" href="#contacto">Hablemos</a>
    </nav>
  </div>
</header>

<main id="contenido">

  <!-- ============ PORTADA ============ -->
  <section class="portada">
    <!-- Red de nodos que se conectan al acercarse: es literalmente lo que vende
         la empresa. Lo dibuja app.js; si no hay JS o se pidió menos movimiento,
         no se dibuja nada y la portada se ve igual de bien. -->
    <canvas class="portada__lienzo" id="lienzo" aria-hidden="true"></canvas>

    <div class="contenedor">
      <span class="eyebrow"><?= e($config['empresa']['tagline']) ?></span>

      <!-- 1. Gran idea. A ancho completo: es lo que da el golpe de entrada. -->
      <h1>
        <span class="linea"><span>Automatiza lo repetitivo.</span></span>
        <span class="linea"><span><em>Libera lo humano.</em></span></span>
      </h1>
    </div>

    <div class="contenedor portada__grid">

      <div>
        <!-- 2. Qué es esto -->
        <p class="portada__sub">
          Somos la consultoría que identifica dónde la inteligencia artificial genera valor
          real en tu operación, la implementa conectada a las herramientas que ya usas, y
          acompaña a tu equipo hasta que la domina.
        </p>

        <!-- 5. Llamado a la acción -->
        <div class="portada__acciones">
          <a class="btn btn--primario" href="#contacto">
            Solicitar diagnóstico gratuito
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a class="btn btn--fantasma" href="<?= e($wa) ?>" target="_blank" rel="noopener">
            Escríbenos por WhatsApp
          </a>
        </div>

        <!-- 6. Bono: elimina objeciones -->
        <ul class="bono">
          <li><?= $icoCheck ?> Diagnóstico inicial sin costo</li>
          <li><?= $icoCheck ?> Sin cambiar tus herramientas actuales</li>
          <li><?= $icoCheck ?> Respuesta en menos de 24 horas</li>
        </ul>
      </div>

      <!-- 3. Creativo: cómo funciona -->
      <div class="creativo">
        <p class="creativo__etiqueta">Así se ve un proceso automatizado</p>

        <svg class="flujo" viewBox="0 0 600 304" role="img"
             aria-label="Diagrama: WhatsApp, correo electrónico y formularios web entran a un asistente de inteligencia artificial con reglas y supervisión, que actualiza el CRM, agenda citas y notifica al equipo.">
          <g class="flujo__lineas">
            <path class="flujo__linea" d="M145,52 C195,52 190,160 232,160"/>
            <path class="flujo__linea" d="M145,152 C195,152 190,160 232,160"/>
            <path class="flujo__linea" d="M145,252 C195,252 190,160 232,160"/>
            <path class="flujo__linea" d="M368,160 C410,160 405,52 455,52"/>
            <path class="flujo__linea" d="M368,160 C410,160 405,152 455,152"/>
            <path class="flujo__linea" d="M368,160 C410,160 405,252 455,252"/>
          </g>
          <g aria-hidden="true">
            <path class="flujo__pulso" d="M145,52 C195,52 190,160 232,160"/>
            <path class="flujo__pulso" d="M145,152 C195,152 190,160 232,160"/>
            <path class="flujo__pulso" d="M145,252 C195,252 190,160 232,160"/>
            <path class="flujo__pulso" d="M368,160 C410,160 405,52 455,52"/>
            <path class="flujo__pulso" d="M368,160 C410,160 405,152 455,152"/>
            <path class="flujo__pulso" d="M368,160 C410,160 405,252 455,252"/>
          </g>

          <rect class="flujo__caja" x="0.5" y="30" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="72" y="52">WhatsApp</text>
          <rect class="flujo__caja" x="0.5" y="130" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="72" y="152">Correo electrónico</text>
          <rect class="flujo__caja" x="0.5" y="230" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="72" y="252">Formularios web</text>

          <rect class="flujo__caja flujo__caja--eje" x="232" y="118" width="136" height="84" rx="11"/>
          <text class="flujo__texto flujo__texto--eje" x="300" y="151">Asistente IA</text>
          <text class="flujo__texto flujo__texto--subeje" x="300" y="173">reglas + supervisión</text>

          <rect class="flujo__caja" x="455.5" y="30" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="527" y="52">CRM y base de datos</text>
          <rect class="flujo__caja" x="455.5" y="130" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="527" y="152">Agenda y citas</text>
          <rect class="flujo__caja" x="455.5" y="230" width="144" height="44" rx="8"/>
          <text class="flujo__texto" x="527" y="252">Tu equipo, avisado</text>
        </svg>

        <p class="creativo__pie">
          Lo que hoy resuelve una persona copiando y pegando, mañana lo resuelve un flujo
          — con tu gente decidiendo lo que de verdad requiere criterio.
        </p>
      </div>

    </div>

    <!-- 4. Social proof -->
    <div class="contenedor">
      <div class="prueba aparece">
        <p class="prueba__titulo">Organizaciones que ya confían en nosotros</p>
        <ul class="prueba__logos">
          <?php foreach ($config['clientes'] as $i => $cliente): ?>
            <?php $logo = logo_de($cliente['archivo']); ?>
            <li class="prueba__cliente revela" style="--i:<?= $i ?>">
              <?php if ($logo !== null): ?>
                <img class="prueba__ficha" src="<?= e($logo) ?>" alt="" loading="lazy" width="52" height="52">
              <?php endif; ?>
              <span class="prueba__wordmark"><?= e($cliente['nombre']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- ============ ANTES / DESPUÉS ============ -->
  <section class="seccion" id="transformacion">
    <div class="contenedor">
      <div class="seccion__cabecera aparece">
        <span class="eyebrow">La diferencia</span>
        <h2>El mismo equipo. Otra operación.</h2>
        <p>
          Nada de esto cambia contratando más gente. Cambia conectando lo que hoy
          está suelto.
        </p>
      </div>

      <div class="cambio aparece">
        <div class="cambio__conmutador" role="tablist" aria-label="Comparar la operación antes y después">
          <span class="cambio__pildora" aria-hidden="true"></span>
          <button type="button" class="cambio__pestana es-activa" role="tab"
                  id="tab-antes" aria-controls="cambio-rejilla" aria-selected="true">
            Proceso manual <span>(antes)</span>
          </button>
          <button type="button" class="cambio__pestana" role="tab"
                  id="tab-despues" aria-controls="cambio-rejilla" aria-selected="false" tabindex="-1">
            Proceso inteligente <span>(después)</span>
          </button>
        </div>

        <p class="cambio__pie" id="cambio-pie">Siete puntos sueltos, torcidos y perdiéndose.</p>

        <!-- Una sola rejilla: las mismas 7 tarjetas giran sobre su eje.
             No son dos listas, es la misma operación transformándose. -->
        <div class="cambio__rejilla" id="cambio-rejilla" role="tabpanel" aria-labelledby="tab-antes">
          <?php foreach ($antes as $i => [$titulo, $texto]): ?>
            <?php [$tituloD, $textoD, $etiquetaD] = $despues[$i]; ?>
            <div class="cambio__carta" style="--i:<?= $i ?>">
              <div class="cambio__giro">
                <article class="cambio__cara cambio__cara--antes">
                  <h3><?= e($titulo) ?></h3>
                  <p><?= e($texto) ?></p>
                  <span class="cambio__etiqueta">Retraso</span>
                </article>
                <article class="cambio__cara cambio__cara--despues" aria-hidden="true">
                  <h3><?= e($tituloD) ?></h3>
                  <p><?= e($textoD) ?></p>
                  <span class="cambio__etiqueta <?= $etiquetaD === 'Tu equipo' ? 'cambio__etiqueta--humana' : '' ?>"><?= e($etiquetaD) ?></span>
                </article>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <p class="cambio__remate aparece">
        No se trata de reemplazar personas. Se trata de reducir fricción, mejorar procesos
        y permitir que los equipos dediquen más tiempo a actividades que requieren
        experiencia, creatividad y criterio humano.
      </p>
    </div>
  </section>

  <!-- ============ CASO ============ -->
  <section class="seccion" id="caso">
    <div class="contenedor">
      <div class="seccion__cabecera aparece">
        <span class="eyebrow">Un caso</span>
        <h2>Lo que pasó cuando dejaron de responder lo mismo cien veces.</h2>
      </div>

      <div class="caso aparece">
        <?= aviso_borrador($config['borrador'], 'Cifras de ejemplo — aún sin verificar') ?>

        <p class="caso__cliente"><?= e($config['caso']['cliente']) ?></p>

        <ul class="caso__cifras">
          <?php foreach ($config['caso']['cifras'] as $i => $c): ?>
            <li class="revela" style="--i:<?= $i ?>">
              <span class="caso__valor" data-contar="<?= (int)$c['valor'] ?>" data-sufijo="<?= e($c['sufijo']) ?>">0<?= e($c['sufijo']) ?></span>
              <span class="caso__label"><?= e($c['label']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="caso__texto">
          <div>
            <span class="caso__et">El reto</span>
            <p><?= e($config['caso']['reto']) ?></p>
          </div>
          <div>
            <span class="caso__et">Lo que hicimos</span>
            <p><?= e($config['caso']['solucion']) ?></p>
          </div>
        </div>

        <blockquote class="caso__cita">
          <p>“<?= e($config['caso']['cita']) ?>”</p>
          <footer><?= e($config['caso']['firma']) ?></footer>
        </blockquote>
      </div>
    </div>
  </section>

  <!-- ============ FRASE ============ -->
  <section class="frase frase--principio" aria-label="Nuestro enfoque" data-frase-escena>
    <div class="frase__media" aria-hidden="true">
      <img src="assets/logos/imagen1.webp" alt="" width="1920" height="1047" loading="lazy" decoding="async">
    </div>
    <div class="frase__trama" aria-hidden="true"></div>
    <div class="contenedor frase__contenido">
      <div class="frase__meta" aria-hidden="true">
        <span>01</span>
        <span>Nuestro principio</span>
      </div>
      <p class="frase__texto" data-frase>
        Escuchamos antes de recomendar.
        <em>Si la respuesta a tu problema no es inteligencia artificial, te lo decimos.</em>
      </p>
      <p class="frase__firma">Estrategia antes que tecnología</p>
    </div>
    <span class="frase__avance" aria-hidden="true"><span></span></span>
  </section>

  <!-- ============ SERVICIOS ============ -->
  <section class="seccion seccion--alt" id="servicios">
    <div class="contenedor">
      <div class="seccion__cabecera aparece">
        <span class="eyebrow">Servicios</span>
        <h2>No implementamos tecnología porque exista. La implementamos donde mueve la aguja.</h2>
        <p>
          Primero entendemos cómo funciona tu empresa, qué procesos consumen más tiempo y
          dónde hay un impacto real esperando. Después construimos.
        </p>
      </div>

      <div class="rejilla aparece">
        <?php foreach ($servicios as $i => $s): ?>
          <article class="tarjeta revela" style="--i:<?= $i ?>">
            <span class="tarjeta__num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3><?= e($s['titulo']) ?></h3>
            <p><?= e($s['texto']) ?></p>
            <ul>
              <?php foreach ($s['items'] as $item): ?>
                <li><?= e($item) ?></li>
              <?php endforeach; ?>
            </ul>
          </article>
        <?php endforeach; ?>
      </div>

      <div style="margin-top:4rem" class="aparece">
        <span class="eyebrow">Para quién</span>
        <ul class="chips">
          <?php foreach ($sectores as $i => $s): ?>
            <li class="revela" style="--i:<?= $i ?>"><?= e($s) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- ============ METODOLOGÍA ============ -->
  <section class="seccion" id="metodologia">
    <div class="contenedor">
      <div class="seccion__cabecera aparece">
        <span class="eyebrow">Metodología</span>
        <h2>Siete etapas. Ninguna sorpresa.</h2>
        <p>
          Sabes en qué punto está el proyecto, qué sigue y qué se espera de tu equipo en
          cada momento.
        </p>
      </div>

      <ol class="pasos aparece">
        <?php foreach ($metodologia as $i => [$titulo, $texto]): ?>
          <li class="revela" style="--i:<?= $i ?>">
            <h3><?= e($titulo) ?></h3>
            <p><?= e($texto) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- ============ ENFOQUE HUMANO ============ -->
  <section class="seccion seccion--alt" id="enfoque">
    <div class="contenedor">
      <div class="manifiesto">
        <div class="aparece">
          <span class="eyebrow">Enfoque humano</span>
          <blockquote class="manifiesto__cita" style="margin-top:1.5rem">
            El reto no es la tecnología disponible.
            <span>Es cómo las personas la reciben, la entienden y la hacen suya.</span>
          </blockquote>
        </div>

        <div class="manifiesto__cuerpo aparece">
          <p>
            No se trata de reemplazar personas. Se trata de reducir fricción, mejorar
            procesos y permitir que los equipos dediquen más tiempo a actividades que
            requieren experiencia, creatividad y criterio humano.
          </p>
          <p>
            Por eso quienes trabajan con los procesos todos los días no son usuarios finales
            en nuestros proyectos: son cocreadores de la solución.
          </p>

          <div style="margin-top:2rem">
            <span class="eyebrow">Responsabilidad y supervisión</span>
            <ul class="beneficios" style="margin-top:1.25rem; grid-template-columns:1fr">
              <?php foreach ($responsabilidad as $r): ?>
                <li><?= $icoCheck ?><?= e($r) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ FRASE ============ -->
  <section class="frase frase--alt frase--personas" aria-label="Nuestra tesis" data-frase-escena>
    <div class="frase__media" aria-hidden="true">
      <img src="assets/logos/imagen2.webp" alt="" width="1920" height="1047" loading="lazy" decoding="async">
    </div>
    <div class="frase__trama" aria-hidden="true"></div>
    <div class="contenedor frase__contenido">
      <div class="frase__meta" aria-hidden="true">
        <span>02</span>
        <span>Nuestra tesis</span>
      </div>
      <p class="frase__texto" data-frase>
        La tecnología por sí sola no transforma una organización.
        <em>Lo hacen las personas preparadas para usarla.</em>
      </p>
      <p class="frase__firma">Tecnología con propósito humano</p>
    </div>
    <span class="frase__avance" aria-hidden="true"><span></span></span>
  </section>

  <!-- ============ QUIÉN ESTÁ DETRÁS ============ -->
  <section class="seccion" id="equipo">
    <div class="contenedor">
      <div class="equipo__grid">
        <div class="aparece">
          <span class="eyebrow">Quién está detrás</span>
          <h2 class="equipo__titulo">Vas a hablar con la misma persona que va a construirlo.</h2>
          <p class="equipo__intro">
            No hay un comercial que promete y un equipo que hereda el problema.
            Quien te escucha en el diagnóstico es quien diseña la solución.
          </p>
        </div>

        <div class="aparece">
          <?= aviso_borrador($config['borrador'], 'Perfil de ejemplo') ?>
          <?php foreach ($config['equipo'] as $p): ?>
            <article class="persona">
              <?php if (!empty($p['foto']) && is_file(__DIR__ . '/' . $p['foto'])): ?>
                <img class="persona__foto" src="<?= e($p['foto']) ?>" alt="<?= e($p['nombre']) ?>" width="72" height="72" loading="lazy">
              <?php else: ?>
                <span class="persona__foto persona__foto--iniciales" aria-hidden="true"><?= e(iniciales($p['nombre'])) ?></span>
              <?php endif; ?>
              <div>
                <h3><?= e($p['nombre']) ?></h3>
                <p class="persona__rol"><?= e($p['rol']) ?></p>
                <p class="persona__bio"><?= e($p['bio']) ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ CONTACTO ============ -->
  <section class="seccion seccion--alt" id="contacto">
    <div class="contenedor contacto__grid">

      <div class="contacto__aparte aparece">
        <span class="eyebrow">Empecemos</span>
        <h2>Una conversación de 30 minutos, sin costo y sin compromiso.</h2>
        <p>
          Cuéntanos qué proceso te está consumiendo tiempo. Te decimos con franqueza si la
          inteligencia artificial ayuda ahí — y si no, también.
        </p>

        <?= aviso_borrador($config['borrador'], 'Precios y plazos de ejemplo') ?>
        <ul class="arranque">
          <?php foreach ($config['arranque'] as $i => $a): ?>
            <li class="revela" style="--i:<?= $i ?>">
              <span class="arranque__paso"><?= e($a['paso']) ?></span>
              <span class="arranque__precio"><?= e($a['precio']) ?></span>
              <span class="arranque__plazo"><?= e($a['plazo']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <ul class="garantias">
          <li>
            <?= $icoCheck ?>
            <span><strong>Escuchamos antes de recomendar</strong>Si la respuesta a tu problema no es IA, te lo decimos. No vendemos tecnología que no necesitas.</span>
          </li>
          <li>
            <?= $icoCheck ?>
            <span><strong>Sin reemplazar lo que ya funciona</strong>Nos integramos con tu CRM, tu WhatsApp y tus hojas de cálculo. Tu equipo no empieza de cero.</span>
          </li>
          <li>
            <?= $icoCheck ?>
            <span><strong>Tu equipo capacitado, no desplazado</strong>Documentación, pruebas y acompañamiento hasta que la solución se use con confianza.</span>
          </li>
          <li>
            <?= $icoCheck ?>
            <span><strong>Empieza pequeño, crece después</strong>Priorizamos un proyecto de impacto rápido. Escalamos cuando veas el resultado.</span>
          </li>
        </ul>
      </div>

      <div class="tarjeta-form aparece">
        <?php if ($enviado): ?>
          <div class="aviso aviso--ok" role="status">
            <!-- El SVG estático es el icono por defecto: si Lottie no carga
                 (red, bloqueador de anuncios, lo que sea), esto es lo único
                 que se ve y la página sigue funcionando igual. -->
            <svg class="aviso__check-estatico" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.4"/><path d="M5 8.2 7 10.2 11 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="aviso__check-animado" data-lottie="assets/lottie/exito.json" aria-hidden="true"></span>
            <span><strong>Mensaje recibido.</strong>Te respondemos en menos de 24 horas hábiles. Si prefieres algo inmediato, escríbenos por WhatsApp.</span>
          </div>
        <?php endif; ?>

        <?php if (!empty($errores)): ?>
          <div class="aviso aviso--error" role="alert">
            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.4"/><path d="M8 4.5v4.2M8 11.2v.1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <span><strong>Revisa los campos marcados.</strong><?= e($errores['general'] ?? 'Faltan algunos datos para poder responderte bien.') ?></span>
          </div>
        <?php endif; ?>

        <form method="post" action="#contacto" novalidate>
          <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
          <div class="trampa" aria-hidden="true">
            <label for="sitio_web">No llenar este campo</label>
            <input type="text" id="sitio_web" name="sitio_web" tabindex="-1" autocomplete="off">
          </div>

          <div class="campos">
            <div class="campo <?= isset($errores['nombre']) ? 'campo--error' : '' ?>">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" autocomplete="name"
                     value="<?= e($valores['nombre']) ?>"
                     <?= isset($errores['nombre']) ? 'aria-invalid="true" aria-describedby="err-nombre"' : '' ?>>
              <?php if (isset($errores['nombre'])): ?>
                <span class="error" id="err-nombre"><?= e($errores['nombre']) ?></span>
              <?php endif; ?>
            </div>

            <div class="campo">
              <label for="empresa">Empresa <span>(opcional)</span></label>
              <input type="text" id="empresa" name="empresa" autocomplete="organization"
                     value="<?= e($valores['empresa']) ?>">
            </div>

            <div class="campo <?= isset($errores['email']) ? 'campo--error' : '' ?>">
              <label for="email">Correo</label>
              <input type="email" id="email" name="email" autocomplete="email"
                     value="<?= e($valores['email']) ?>"
                     <?= isset($errores['email']) ? 'aria-invalid="true" aria-describedby="err-email"' : '' ?>>
              <?php if (isset($errores['email'])): ?>
                <span class="error" id="err-email"><?= e($errores['email']) ?></span>
              <?php endif; ?>
            </div>

            <div class="campo">
              <label for="telefono">Teléfono <span>(opcional)</span></label>
              <input type="tel" id="telefono" name="telefono" autocomplete="tel"
                     value="<?= e($valores['telefono']) ?>">
            </div>

            <div class="campo campo--ancho">
              <label for="sector">Sector <span>(opcional)</span></label>
              <select id="sector" name="sector">
                <option value="">Selecciona una opción</option>
                <?php foreach ($config['sectores_form'] as $s): ?>
                  <option value="<?= e($s) ?>" <?= $valores['sector'] === $s ? 'selected' : '' ?>><?= e($s) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="campo campo--ancho <?= isset($errores['mensaje']) ? 'campo--error' : '' ?>">
              <label for="mensaje">¿Qué proceso te gustaría mejorar?</label>
              <textarea id="mensaje" name="mensaje"
                        placeholder="Ej.: respondemos las mismas preguntas por WhatsApp todo el día y los pedidos se pierden entre correos."
                        <?= isset($errores['mensaje']) ? 'aria-invalid="true" aria-describedby="err-mensaje"' : '' ?>><?= e($valores['mensaje']) ?></textarea>
              <?php if (isset($errores['mensaje'])): ?>
                <span class="error" id="err-mensaje"><?= e($errores['mensaje']) ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form__pie">
            <button class="btn btn--primario" type="submit">
              Enviar solicitud
              <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <p class="form__nota">Usamos tus datos solo para responder esta solicitud.<br>Nada de listas de correo.</p>
          </div>
        </form>
      </div>

    </div>
  </section>
</main>

<footer class="pie">
  <div class="contenedor">
    <div class="pie__grid">
      <div>
        <a class="marca" href="#">
          <?= isotipo() ?>
          <?= e($config['empresa']['marca']) ?>
          <span class="marca__sub">Integral Services</span>
        </a>
        <p class="pie__lema">
          Transformamos procesos manuales en soluciones inteligentes, automatizadas y
          escalables para que tu empresa opere mejor, responda más rápido y crezca con
          estructura.
        </p>
      </div>
      <nav class="pie__enlaces" aria-label="Pie de página">
        <a href="#caso">Un caso</a>
        <a href="#servicios">Servicios</a>
        <a href="#metodologia">Metodología</a>
        <a href="#equipo">Quiénes somos</a>
        <a href="mailto:<?= e($config['contacto']['email_publico']) ?>"><?= e($config['contacto']['email_publico']) ?></a>
        <a href="<?= e($wa) ?>" target="_blank" rel="noopener"><?= e($config['contacto']['whatsapp_visible']) ?></a>
      </nav>
    </div>
    <p class="pie__legal">
      © <?= date('Y') ?> <?= e($config['empresa']['nombre']) ?>. Inteligencia artificial con
      estrategia, propósito y acompañamiento humano.
    </p>
  </div>
</footer>

<a class="wa-flotante" href="<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="Escríbenos por WhatsApp">
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.65.08-.3-.15-1.25-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.21-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.01-1.04 2.47s1.06 2.87 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.42-.07-.13-.27-.2-.57-.35Z"/><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.27-1.38a9.86 9.86 0 0 0 4.76 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm0 18.14a8.2 8.2 0 0 1-4.19-1.15l-.3-.18-3.12.82.83-3.05-.2-.31a8.16 8.16 0 0 1-1.25-4.36c0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c0 4.54-3.7 8.22-8.24 8.22Z"/></svg>
</a>

<?php if ($enviado): ?>
  <!-- Lottie solo se carga en la pantalla de éxito del envío — no en cada
       visita. Si el CDN falla, app.js nunca llama a window.lottie y el
       SVG estático de arriba (aviso__check-estatico) es lo que queda visible. -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" defer></script>
<?php endif; ?>
<script src="assets/js/app.js" defer></script>
</body>
</html>
