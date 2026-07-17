<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\MetodologiaDeTrabajo\Dominio\FaseDeTrabajo;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * En escritorio es una línea de tiempo horizontal seleccionable; en móvil, un
 * acordeón. La descripción de todas las fases viaja en el HTML y JavaScript
 * sólo decide cuál se muestra.
 *
 * @var list<FaseDeTrabajo> $fases
 */
?>
<section id="<?= SeccionDelSitio::Metodologia->value ?>" class="py-24 bg-soft-neutral-bg relative overflow-hidden">
    <div class="absolute top-0 left-1/4 w-[350px] h-[350px] bg-brand-blue/5 rounded-full blur-[90px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">NUESTRA FORMA DE TRABAJAR</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                De la identificación del problema a la optimización continua.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Nuestra metodología garantiza que cada implementación de inteligencia artificial responda a un objetivo de negocio claro y se adopte con éxito.
            </p>
        </div>

        <div data-metodologia class="hidden lg:block relative mb-12">
            <div class="absolute top-[42px] left-[5%] right-[5%] h-0.5 bg-slate-200 z-0">
                <div data-progreso-metodologia class="h-full bg-brand-blue transition-all duration-500" style="width: 0%"></div>
            </div>

            <div class="grid grid-cols-7 gap-4 relative z-10">
                <?php foreach ($fases as $fase) { ?>
                    <button
                        type="button"
                        data-fase="<?= $fase->numero ?>"
                        data-estado="<?= $fase->numero === 1 ? 'activa' : 'pendiente' ?>"
                        class="group flex flex-col items-center text-center cursor-pointer focus:outline-none"
                        aria-label="Fase <?= $fase->numero ?>: <?= Plantilla::escapar($fase->titulo) ?>"
                    >
                        <span class="w-14 h-14 rounded-full flex items-center justify-center border-2 transition-all duration-300 font-sora text-sm font-bold bg-white border-slate-200 text-slate-400 group-hover:border-slate-300 group-data-[estado=activa]:bg-brand-blue group-data-[estado=activa]:border-brand-blue group-data-[estado=activa]:text-white group-data-[estado=activa]:shadow-lg group-data-[estado=activa]:shadow-brand-blue/20 group-data-[estado=activa]:scale-110 group-data-[estado=completada]:border-brand-blue group-data-[estado=completada]:text-brand-blue">
                            <span class="group-data-[estado=completada]:hidden"><?= $fase->numeroConCero() ?></span>
                            <span class="hidden group-data-[estado=completada]:block"><?= Icono::pintar('check', 'w-5 h-5') ?></span>
                        </span>
                        <span class="font-sora text-xs font-bold mt-4 transition-colors text-slate-700 group-data-[estado=activa]:text-brand-blue">
                            <?= Plantilla::escapar($fase->titulo) ?>
                        </span>
                    </button>
                <?php } ?>
            </div>
        </div>

        <div class="hidden lg:block bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
            <?php foreach ($fases as $fase) { ?>
                <div data-detalle-de-fase="<?= $fase->numero ?>" <?= $fase->numero === 1 ? '' : 'hidden' ?>>
                    <div class="flex gap-6 items-center">
                        <span class="text-4xl font-sora font-extrabold text-brand-blue/25"><?= $fase->numeroConCero() ?></span>
                        <div>
                            <h3 class="font-sora text-xl font-bold text-primary-dark mb-2">Fase de <?= Plantilla::escapar($fase->titulo) ?></h3>
                            <p class="font-inter text-slate-600 leading-relaxed text-sm"><?= Plantilla::escapar($fase->descripcion) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="lg:hidden flex flex-col gap-4">
            <?php foreach ($fases as $fase) { ?>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 transition-all">
                    <button
                        type="button"
                        data-acordeon-de-fase="<?= $fase->numero ?>"
                        aria-expanded="<?= $fase->numero === 1 ? 'true' : 'false' ?>"
                        aria-controls="fase-movil-<?= $fase->numero ?>"
                        class="group flex items-center justify-between cursor-pointer w-full text-left"
                    >
                        <span class="flex items-center gap-3">
                            <span class="w-9 h-9 rounded-full font-sora text-xs font-bold flex items-center justify-center bg-slate-100 text-slate-500 group-aria-expanded:bg-brand-blue group-aria-expanded:text-white">
                                <?= $fase->numero ?>
                            </span>
                            <span class="font-sora text-sm font-bold text-slate-800"><?= Plantilla::escapar($fase->titulo) ?></span>
                        </span>
                        <span class="text-slate-500">
                            <span class="group-aria-expanded:hidden"><?= Icono::pintar('chevron-down', 'w-4 h-4') ?></span>
                            <span class="hidden group-aria-expanded:block"><?= Icono::pintar('chevron-up', 'w-4 h-4') ?></span>
                        </span>
                    </button>

                    <div id="fase-movil-<?= $fase->numero ?>" <?= $fase->numero === 1 ? '' : 'hidden' ?> class="mt-3 pl-12 border-t border-slate-100 pt-3">
                        <p class="font-inter text-xs text-slate-600 leading-relaxed"><?= Plantilla::escapar($fase->descripcion) ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
