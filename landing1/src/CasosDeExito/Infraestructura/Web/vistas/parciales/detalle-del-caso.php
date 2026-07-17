<?php

declare(strict_types=1);

use DaCoach\CasosDeExito\Dominio\CasoDeExito;
use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;

/**
 * Ficha completa del caso.
 *
 * Usa <dialog> nativo en vez de recrear un modal: trae gratis el foco atrapado,
 * el cierre con Escape y el fondo inerte, que en la versión React había que
 * implementar a mano (y no estaban).
 *
 * @var CasoDeExito $caso
 */
?>
<dialog
    data-caso="<?= Plantilla::escapar($caso->id) ?>"
    class="backdrop:bg-deep-navy/80 backdrop:backdrop-blur-sm bg-transparent p-4 max-w-2xl w-full max-h-[90vh]"
    aria-labelledby="titulo-caso-<?= Plantilla::escapar($caso->id) ?>"
>
    <div class="bg-white w-full rounded-3xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col max-h-[85vh]">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-light-blue-bg to-white">
            <div>
                <span class="text-[10px] font-bold text-brand-blue uppercase tracking-widest block mb-1">
                    CASO REAL DE OPERACIÓN · <?= Plantilla::escapar($caso->categoria) ?>
                </span>
                <h3 id="titulo-caso-<?= Plantilla::escapar($caso->id) ?>" class="font-sora text-xl lg:text-2xl font-extrabold text-primary-dark">
                    <?= Plantilla::escapar($caso->cliente) ?>
                </h3>
            </div>
            <button
                type="button"
                data-cerrar-caso
                class="p-1.5 rounded-full hover:bg-slate-100 text-slate-500 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-300 cursor-pointer"
                aria-label="Cerrar detalles del caso"
            >
                <?= Icono::pintar('x', 'w-5 h-5') ?>
            </button>
        </div>

        <div class="p-6 overflow-y-auto space-y-6 font-inter text-sm text-secondary-text">
            <?php if ($caso->descripcion !== null) { ?>
                <p class="text-slate-700 leading-relaxed text-xs bg-slate-50 border border-slate-100 p-4 rounded-2xl">
                    <?= Plantilla::escapar($caso->descripcion) ?>
                </p>
            <?php } ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-rose-50/20 border border-rose-100/50 p-4 rounded-2xl">
                    <h4 class="font-sora text-xs font-bold text-rose-600 uppercase tracking-wider mb-2">Reto Inicial Operativo</h4>
                    <p class="text-slate-700 leading-relaxed text-xs"><?= Plantilla::escapar($caso->reto) ?></p>
                </div>
                <div class="bg-emerald-50/15 border border-emerald-100/40 p-4 rounded-2xl">
                    <h4 class="font-sora text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2">Enfoque y Solución</h4>
                    <p class="text-slate-700 leading-relaxed text-xs"><?= Plantilla::escapar($caso->solucion) ?></p>
                </div>
            </div>

            <div>
                <h4 class="font-sora text-xs font-bold text-primary-dark uppercase tracking-wider mb-3">Flujo de proceso implementado</h4>
                <div class="flex flex-wrap gap-2.5">
                    <?php foreach ($caso->flujoOperativo as $indice => $paso) { ?>
                        <div class="flex items-center gap-2 bg-slate-50 border border-slate-100 px-3 py-1.5 rounded-xl">
                            <span class="w-4 h-4 rounded-full bg-brand-blue text-white text-[9px] font-bold flex items-center justify-center flex-shrink-0"><?= $indice + 1 ?></span>
                            <span class="font-sora text-xs font-semibold text-slate-800"><?= Plantilla::escapar($paso) ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if ($caso->capacidades !== []) { ?>
                <div>
                    <h4 class="font-sora text-xs font-bold text-primary-dark uppercase tracking-wider mb-3">Capacidades del asistente</h4>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <?php foreach ($caso->capacidades as $capacidad) { ?>
                            <li class="flex items-start gap-2 text-xs text-slate-600">
                                <span class="text-cyan-accent flex-shrink-0 mt-0.5"><?= Icono::pintar('check', 'w-3.5 h-3.5') ?></span>
                                <span><?= Plantilla::escapar($capacidad) ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <div>
                <h4 class="font-sora text-xs font-bold text-primary-dark uppercase tracking-wider mb-3">Sistemas y herramientas conectadas</h4>
                <div class="flex flex-wrap gap-1.5">
                    <?php foreach ($caso->herramientasConectadas as $herramienta) { ?>
                        <span class="text-xs font-medium px-2.5 py-1 bg-light-blue-bg text-brand-blue rounded-md border border-brand-blue/10">
                            <?= Plantilla::escapar($herramienta) ?>
                        </span>
                    <?php } ?>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-5 bg-slate-50/50 p-4 rounded-2xl">
                <h4 class="font-sora text-xs font-bold text-primary-dark uppercase tracking-wider mb-3 flex items-center gap-1.5">
                    <span class="text-warm-accent"><?= Icono::pintar('sparkles', 'w-4 h-4') ?></span>
                    Categorías de Impacto Operativo
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <?php foreach ($caso->resultados as $resultado) { ?>
                        <p class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <?= Icono::pintar('check', 'w-3 h-3') ?>
                            </span>
                            <span class="font-sora text-xs font-semibold text-slate-800"><?= Plantilla::escapar($resultado) ?></span>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-slate-100 bg-slate-50/40 flex justify-end">
            <button
                type="button"
                data-cerrar-caso
                class="font-sora font-semibold text-xs px-5 py-2.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl transition-all cursor-pointer"
            >
                Cerrar Ventana
            </button>
        </div>
    </div>
</dialog>
