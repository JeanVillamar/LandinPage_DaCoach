<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\EnlaceDeNavegacion;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * El estado (fondo al hacer scroll, enlace activo, menú móvil) lo gestiona
 * assets/js/sitio.js mediante los atributos data-scrolled y data-menu-abierto.
 */
$enlaces = EnlaceDeNavegacion::menuPrincipal();
?>
<nav
    data-barra-de-navegacion
    data-scrolled="false"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-5 data-[scrolled=true]:bg-white/95 data-[scrolled=true]:backdrop-blur-md data-[scrolled=true]:shadow-md data-[scrolled=true]:py-3 data-[scrolled=true]:border-b data-[scrolled=true]:border-slate-100"
>
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <a href="<?= SeccionDelSitio::Inicio->ancla() ?>" class="focus:outline-none focus:ring-2 focus:ring-brand-blue/50 rounded-lg p-1">
            <?= $this->pintar('SitioPublico:parciales/logotipo') ?>
        </a>

        <div class="hidden lg:flex items-center gap-7">
            <?php foreach ($enlaces as $enlace) { ?>
                <a
                    href="<?= $enlace->seccion->ancla() ?>"
                    data-enlace-de-navegacion="<?= Plantilla::escapar($enlace->seccion->value) ?>"
                    class="font-inter text-sm font-medium transition-colors text-white/80 hover:text-electric-blue focus:outline-none focus:text-electric-blue"
                >
                    <?= Plantilla::escapar($enlace->nombre) ?>
                </a>
            <?php } ?>
        </div>

        <div class="hidden lg:block">
            <a
                href="<?= SeccionDelSitio::Contacto->ancla() ?>"
                class="inline-block font-sora font-semibold text-sm px-5 py-2.5 rounded-full transition-all duration-300 shadow-sm bg-warm-accent text-deep-navy hover:bg-white hover:text-brand-blue hover:shadow-lg"
            >
                Solicita un diagnóstico
            </a>
        </div>

        <button
            type="button"
            data-abrir-menu
            aria-expanded="false"
            aria-controls="menu-movil"
            aria-label="Abrir menú"
            class="lg:hidden p-2 rounded-lg transition-colors text-white hover:bg-white/10 focus:outline-none"
        >
            <?= Icono::pintar('menu', 'w-6 h-6') ?>
        </button>
    </div>
</nav>

<div
    id="menu-movil"
    data-menu-movil
    data-abierto="false"
    class="fixed inset-0 z-40 bg-deep-navy transition-transform duration-300 lg:hidden translate-x-full data-[abierto=true]:translate-x-0"
>
    <div class="flex flex-col h-full px-6 pt-24 pb-8 overflow-y-auto">
        <button
            type="button"
            data-cerrar-menu
            aria-label="Cerrar menú"
            class="absolute top-6 right-6 p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none"
        >
            <?= Icono::pintar('x', 'w-6 h-6') ?>
        </button>

        <div class="flex flex-col gap-6">
            <?php foreach ($enlaces as $enlace) { ?>
                <a
                    href="<?= $enlace->seccion->ancla() ?>"
                    data-enlace-de-navegacion="<?= Plantilla::escapar($enlace->seccion->value) ?>"
                    class="font-sora text-xl font-medium border-b border-white/10 pb-3 transition-colors text-white/70 hover:text-white"
                >
                    <?= Plantilla::escapar($enlace->nombre) ?>
                </a>
            <?php } ?>
        </div>

        <div class="mt-auto pt-8">
            <a
                href="<?= SeccionDelSitio::Contacto->ancla() ?>"
                class="block text-center w-full font-sora font-semibold text-base py-3.5 bg-warm-accent text-deep-navy rounded-xl hover:bg-white transition-all shadow-md"
            >
                Solicita un diagnóstico
            </a>
            <p class="text-center mt-6 text-white/40 text-xs">
                Tecnología con estrategia, propósito y acompañamiento humano.
            </p>
        </div>
    </div>
</div>
