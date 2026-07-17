<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\PropuestaDeValor\Dominio\ProblemaOperativo;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * La solución se revela al pasar el cursor. En pantallas táctiles no hay hover,
 * así que la tarjeta también reacciona a focus y ambas caras son accesibles con
 * el teclado.
 *
 * @var list<ProblemaOperativo> $problemas
 */
?>
<section id="<?= SeccionDelSitio::Problemas->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-10 right-0 w-72 h-72 rounded-full bg-tech-violet/5 blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-10 left-0 w-72 h-72 rounded-full bg-cyan-accent/5 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">¿DÓNDE SE PIERDE EL TIEMPO?</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                Tu empresa no necesita más herramientas. Necesita procesos mejor diseñados.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Implementar tecnología sin una estrategia clara puede generar más complejidad. En DaCoach analizamos primero la operación y después definimos dónde la inteligencia artificial puede generar valor real.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($problemas as $item) { ?>
                <article
                    tabindex="0"
                    class="group relative h-[250px] rounded-2xl border border-slate-100 bg-soft-neutral-bg shadow-sm overflow-hidden cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-blue/40"
                >
                    <div class="absolute inset-0 transition-transform duration-500 group-hover:-translate-y-full group-focus:-translate-y-full flex flex-col justify-between p-6 bg-soft-neutral-bg">
                        <div class="flex-grow">
                            <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center mb-4">
                                <?= Icono::pintar('octagon-alert', 'w-5 h-5') ?>
                            </div>
                            <h3 class="font-sora text-lg font-bold text-primary-dark mb-2"><?= Plantilla::escapar($item->problema) ?></h3>
                            <p class="font-inter text-sm text-secondary-text leading-relaxed"><?= Plantilla::escapar($item->sintoma) ?></p>
                        </div>
                        <p class="flex items-center gap-1 text-xs font-semibold text-brand-blue">
                            Pasa el cursor para ver la mejora
                            <span class="group-hover:translate-x-1 transition-transform"><?= Icono::pintar('arrow-right', 'w-3.5 h-3.5') ?></span>
                        </p>
                    </div>

                    <div class="absolute inset-0 translate-y-full group-hover:translate-y-0 group-focus:translate-y-0 transition-transform duration-500 flex flex-col justify-between p-6 bg-gradient-to-br from-brand-blue to-dark-tech text-white">
                        <div>
                            <div class="w-9 h-9 rounded-lg bg-cyan-accent/20 text-cyan-accent flex items-center justify-center mb-4">
                                <?= Icono::pintar('circle-check-big', 'w-5 h-5') ?>
                            </div>
                            <h4 class="font-sora text-lg font-bold text-white mb-2">Solución: <?= Plantilla::escapar($item->solucion) ?></h4>
                            <p class="font-inter text-sm text-slate-300 leading-relaxed"><?= Plantilla::escapar($item->comoSeResuelve) ?></p>
                        </div>
                        <p class="text-xs font-semibold text-cyan-accent flex items-center gap-1.5">
                            <span class="text-emerald-400"><?= Icono::pintar('circle-check-big', 'w-4 h-4') ?></span>
                            Proceso optimizado con DaCoach
                        </p>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
