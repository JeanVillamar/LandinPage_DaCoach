<?php

declare(strict_types=1);

use DaCoach\CatalogoDeSoluciones\Dominio\Relevancia;
use DaCoach\CatalogoDeSoluciones\Dominio\Servicio;
use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<Servicio> $servicios
 */

/** Traduce el peso comercial del servicio a su hueco en la rejilla. */
$tamano = static fn (Relevancia $relevancia): string => match ($relevancia) {
    Relevancia::Principal => 'md:col-span-2 col-span-1 min-h-[300px]',
    Relevancia::Ampliada => 'lg:row-span-2 col-span-1 min-h-[450px]',
    Relevancia::Estandar => 'col-span-1 min-h-[300px]',
};

$fondo = static fn (string $id): string => match ($id) {
    'consultoria' => 'bg-gradient-to-br from-dark-tech to-deep-navy border-cyan-accent/20',
    'automatizacion' => 'bg-gradient-to-b from-[#0e214d] to-deep-navy border-tech-violet/25',
    'integracion' => 'bg-gradient-to-br from-deep-navy to-[#051f49] border-electric-blue/20',
    default => 'bg-gradient-to-b from-[#0a1e3f] to-deep-navy border-white/5',
};

$colorDelIcono = static fn (string $id): string => match ($id) {
    'automatizacion', 'optimizacion' => 'text-tech-violet',
    'bots' => 'text-electric-blue',
    'atencion-247' => 'text-warm-accent',
    default => 'text-cyan-accent',
};
?>
<section id="<?= SeccionDelSitio::Soluciones->value ?>" class="py-24 bg-deep-navy relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-[500px] h-[500px] rounded-full bg-brand-blue/10 blur-[130px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] rounded-full bg-tech-violet/10 blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-cyan-accent uppercase mb-3 block">NUESTRAS SOLUCIONES</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                Inteligencia artificial aplicada a problemas reales.
            </h2>
            <p class="font-inter text-lg text-slate-300 leading-relaxed">
                No recomendamos tecnología solamente porque sea nueva. Diseñamos soluciones por su capacidad de mejorar una operación concreta y producir resultados que se puedan medir.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-fr">
            <?php foreach ($servicios as $servicio) { ?>
                <article class="p-6 lg:p-8 rounded-3xl border flex flex-col justify-between transition-all duration-300 hover:scale-[1.01] hover:shadow-xl hover:border-cyan-accent/40 group <?= $tamano($servicio->relevancia) ?> <?= $fondo($servicio->id) ?>">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-white/[0.04] border border-white/10 flex items-center justify-center mb-6 group-hover:bg-white/[0.08] transition-colors <?= $colorDelIcono($servicio->id) ?>">
                            <?= Icono::pintar($servicio->icono, 'w-6 h-6') ?>
                        </div>
                        <h3 class="font-sora text-xl lg:text-2xl font-bold text-white mb-4 tracking-tight leading-snug">
                            <?= Plantilla::escapar($servicio->titulo) ?>
                        </h3>
                        <p class="font-inter text-sm lg:text-base text-slate-300 leading-relaxed mb-6">
                            <?= Plantilla::escapar($servicio->descripcion) ?>
                        </p>
                    </div>

                    <div class="border-t border-white/10 pt-5 mt-auto">
                        <span class="text-[10px] font-bold text-cyan-accent uppercase tracking-widest mb-3 block">Capacidades clave</span>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2.5">
                            <?php foreach ($servicio->capacidades as $capacidad) { ?>
                                <li class="flex items-start gap-2 text-xs text-slate-400 font-inter">
                                    <span class="text-cyan-accent flex-shrink-0 mt-0.5"><?= Icono::pintar('check', 'w-4 h-4') ?></span>
                                    <span><?= Plantilla::escapar($capacidad) ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
