<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\PropuestaDeValor\Dominio\RasgoDeLaOperacion;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * Comparativa manual/inteligente. Los dos paneles se envían siempre en el HTML
 * y el conmutador sólo cambia cuál se muestra: así el contenido es indexable y
 * legible sin JavaScript.
 *
 * @var list<RasgoDeLaOperacion> $manual
 * @var list<RasgoDeLaOperacion> $inteligente
 */
?>
<section id="<?= SeccionDelSitio::AntesYDespues->value ?>" class="py-24 bg-soft-neutral-bg relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">DE LO MANUAL A LO INTELIGENTE</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark mb-6">
                Mejorar un proceso comienza por entender cómo funciona.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Analizamos primero la operación y el flujo de información de tu negocio para eliminar cuellos de botella antes de implementar cualquier tecnología.
            </p>

            <div class="mt-10 inline-flex items-center gap-4 bg-white p-2 rounded-2xl border border-slate-200 shadow-sm" role="tablist" aria-label="Comparativa de la operación">
                <button
                    type="button"
                    role="tab"
                    data-conmutador-operacion="manual"
                    aria-selected="true"
                    aria-controls="panel-operacion-manual"
                    class="font-sora font-semibold text-sm px-6 py-2.5 rounded-xl transition-all cursor-pointer text-slate-600 hover:text-slate-900 aria-selected:bg-rose-500 aria-selected:text-white aria-selected:shadow"
                >
                    Proceso Manual (Antes)
                </button>
                <button
                    type="button"
                    role="tab"
                    data-conmutador-operacion="inteligente"
                    aria-selected="false"
                    aria-controls="panel-operacion-inteligente"
                    class="font-sora font-semibold text-sm px-6 py-2.5 rounded-xl transition-all cursor-pointer text-slate-600 hover:text-slate-900 aria-selected:bg-emerald-500 aria-selected:text-white aria-selected:shadow"
                >
                    Proceso Inteligente (Después)
                </button>
            </div>
        </div>

        <div class="relative w-full bg-white border border-slate-200/80 rounded-3xl p-6 lg:p-12 shadow-xl overflow-hidden">
            <div id="panel-operacion-manual" role="tabpanel" data-panel-operacion="manual" class="transition-opacity duration-500 data-[oculto=true]:hidden">
                <div class="flex flex-col lg:flex-row gap-8 items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center">
                            <?= Icono::pintar('ban', 'w-5 h-5') ?>
                        </div>
                        <div>
                            <h3 class="font-sora text-2xl font-bold text-rose-500">Antes: Operación Fragmentada</h3>
                            <p class="font-inter text-sm text-secondary-text">Flujo de trabajo manual, desconectado y lento.</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-rose-50 text-rose-600 border border-rose-100 flex items-center gap-1.5 animate-pulse">
                        <?= Icono::pintar('circle-alert', 'w-3.5 h-3.5') ?> Errores operativos y fricción
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php foreach ($manual as $indice => $rasgo) { ?>
                        <article
                            class="bg-rose-50/20 border border-rose-100 rounded-2xl p-5 relative overflow-hidden hover:bg-rose-50/40 transition-colors"
                            style="transform: rotate(<?= ($indice % 2 === 0 ? 0.5 : -0.5) * ($indice + 1) ?>deg)"
                        >
                            <div class="flex items-start gap-3">
                                <span class="text-rose-400 mt-0.5 flex-shrink-0"><?= Icono::pintar('circle-alert', 'w-5 h-5') ?></span>
                                <div>
                                    <h4 class="font-sora text-sm font-semibold text-slate-800 line-through decoration-rose-400/40"><?= Plantilla::escapar($rasgo->titulo) ?></h4>
                                    <p class="font-inter text-xs text-rose-500 mt-1"><?= Plantilla::escapar($rasgo->detalle) ?></p>
                                </div>
                            </div>
                            <span class="absolute bottom-2 right-3 text-[10px] font-bold text-rose-300 tracking-wide uppercase">Retraso</span>
                        </article>
                    <?php } ?>
                </div>
            </div>

            <div id="panel-operacion-inteligente" role="tabpanel" data-panel-operacion="inteligente" data-oculto="true" class="transition-opacity duration-500 data-[oculto=true]:hidden">
                <div class="flex flex-col lg:flex-row gap-8 items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                            <?= Icono::pintar('zap', 'w-5 h-5') ?>
                        </div>
                        <div>
                            <h3 class="font-sora text-2xl font-bold text-emerald-600">Después: Conexión y Automatización</h3>
                            <p class="font-inter text-sm text-secondary-text">Flujo de datos automatizado con supervisión humana.</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center gap-1.5">
                        <?= Icono::pintar('circle-check', 'w-3.5 h-3.5') ?> Procesos fluidos y escalables
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 relative">
                    <?php
                    $ultimo = \count($inteligente) - 1;
                    foreach ($inteligente as $indice => $rasgo) {
                        ?>
                        <article class="bg-emerald-50/10 hover:bg-emerald-50/20 border border-emerald-100 rounded-2xl p-5 relative group transition-all duration-300 hover:shadow-sm">
                            <div class="flex items-start gap-3">
                                <span class="text-emerald-500 mt-0.5 flex-shrink-0"><?= Icono::pintar('circle-check', 'w-5 h-5') ?></span>
                                <div>
                                    <h4 class="font-sora text-sm font-semibold text-slate-800"><?= Plantilla::escapar($rasgo->titulo) ?></h4>
                                    <p class="font-inter text-xs text-secondary-text mt-1"><?= Plantilla::escapar($rasgo->detalle) ?></p>
                                </div>
                            </div>
                            <?php if ($indice < $ultimo) { ?>
                                <div class="hidden lg:block absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-0.5 bg-emerald-100 z-10 pointer-events-none group-hover:bg-emerald-300 transition-colors"></div>
                            <?php } ?>
                            <span class="absolute bottom-2 right-3 text-[9px] font-bold text-emerald-600 uppercase bg-emerald-50 px-1.5 py-0.5 rounded tracking-wide">
                                <?= $indice === $ultimo ? 'Supervisor' : 'Autómata' ?>
                            </span>
                        </article>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center max-w-2xl mx-auto border-t border-slate-200 pt-8">
            <blockquote class="font-sora text-lg lg:text-xl font-bold text-slate-800 italic">
                “No automatizamos el desorden. Primero mejoramos el proceso y después aplicamos la tecnología.”
            </blockquote>
        </div>
    </div>
</section>
