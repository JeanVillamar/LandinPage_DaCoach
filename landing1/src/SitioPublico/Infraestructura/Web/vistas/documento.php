<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\MetadatosSeo;

/**
 * @var MetadatosSeo         $seo
 * @var array<string, mixed> $jsonLd
 * @var string               $contenido HTML ya compuesto de la página.
 */
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= Plantilla::escapar($seo->titulo) ?></title>
    <meta name="description" content="<?= Plantilla::escapar($seo->descripcion) ?>">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= Plantilla::escapar($seo->titulo) ?>">
    <meta property="og:description" content="<?= Plantilla::escapar($seo->descripcion) ?>">
    <meta property="og:image" content="<?= Plantilla::escapar($seo->imagenParaCompartir) ?>">
    <meta property="og:url" content="<?= Plantilla::escapar($seo->urlBase) ?>">

    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/assets/css/dacoach.css">

    <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
</head>
<body class="min-h-screen flex flex-col bg-soft-neutral-bg antialiased text-primary-dark">
<?= $contenido ?>

<script type="module" src="/assets/js/sitio.js"></script>
</body>
</html>
