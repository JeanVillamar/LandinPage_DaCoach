<?php

declare(strict_types=1);

use DaCoach\CasosDeExito\Dominio\CasoDeExito;
use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<CasoDeExito> $casos
 */
?>
<section id="<?= SeccionDelSitio::Casos->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/4 right-0 w-[450px] h-[450px] bg-light-blue-bg rounded-full blur-[120px] pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">EXPERIENCIA APLICADA</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                Soluciones diseñadas para operaciones reales.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Trabajamos con organizaciones que buscan mejorar la atención, conectar sus procesos y aprovechar la inteligencia artificial de forma práctica, sin falsas promesas.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <?php foreach ($casos as $caso) { ?>
                <article class="bg-soft-neutral-bg border border-slate-100 hover:border-brand-blue/15 hover:bg-white rounded-3xl p-6 transition-all duration-300 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold text-brand-blue bg-light-blue-bg px-2.5 py-1 rounded-full uppercase tracking-wider">
                                <?= Plantilla::escapar($caso->categoria) ?>
                            </span>
                            <span class="text-slate-400"><?= Icono::pintar('briefcase', 'w-4 h-4') ?></span>
                        </div>
                        <h3 class="font-sora text-xl font-bold text-primary-dark mb-3"><?= Plantilla::escapar($caso->cliente) ?></h3>
                        <p class="font-inter text-sm text-secondary-text leading-relaxed mb-6"><?= Plantilla::escapar($caso->alcance) ?></p>

                        <div class="bg-white rounded-2xl p-4 border border-slate-100 mb-6">
                            <span class="text-[9px] font-bold tracking-widest text-slate-400 uppercase mb-3 block">Flujo Operativo</span>
                            <div class="flex flex-col gap-2">
                                <?php foreach ($caso->primerosPasos() as $indice => $paso) { ?>
                                    <p class="flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-600 font-sora text-[10px] font-bold flex items-center justify-center flex-shrink-0"><?= $indice + 1 ?></span>
                                        <span class="font-inter text-xs text-slate-700"><?= Plantilla::escapar($paso) ?></span>
                                    </p>
                                <?php } ?>
                                <?php if ($caso->pasosRestantes() > 0) { ?>
                                    <p class="text-[10px] text-slate-400 font-medium pl-7 italic">+ <?= $caso->pasosRestantes() ?> pasos adicionales</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <button
                            type="button"
                            data-abrir-caso="<?= Plantilla::escapar($caso->id) ?>"
                            class="text-sm font-semibold text-brand-blue flex items-center gap-1 hover:text-electric-blue transition-colors cursor-pointer"
                        >
                            Ver detalles del caso <?= Icono::pintar('arrow-right', 'w-4 h-4') ?>
                        </button>
                    </div>
                </article>
            <?php } ?>
        </div>

        <?= $this->pintar('CasosDeExito:parciales/demostracion-de-reservas') ?>
    </div>

    <?php foreach ($casos as $caso) { ?>
        <?= $this->pintar('CasosDeExito:parciales/detalle-del-caso', ['caso' => $caso]) ?>
    <?php } ?>
</section>
