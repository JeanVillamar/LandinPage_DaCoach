<?php

declare(strict_types=1);

use DaCoach\CatalogoDeSoluciones\Dominio\Beneficio;
use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<Beneficio> $beneficios
 */
$colorDelIcono = static fn (string $icono): string => match ($icono) {
    'zap', 'scaling', 'eye' => 'text-cyan-accent',
    'clock' => 'text-tech-violet',
    'folder-git', 'shield-check' => 'text-electric-blue',
    'circle-check-big' => 'text-emerald-400',
    'git-pull-request' => 'text-tech-violet',
    default => 'text-warm-accent',
};
?>
<section id="<?= SeccionDelSitio::Beneficios->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-80 h-80 rounded-full bg-light-blue-bg blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">IMPACTO OPERATIVO</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                Resultados que se sienten en el trabajo diario.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Mejoramos el día a día de tus colaboradores y clientes. Sin estadísticas inventadas: nos enfocamos en el valor cualitativo y estructural de tus procesos.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <?php foreach ($beneficios as $beneficio) { ?>
                <article class="bg-soft-neutral-bg border border-slate-100 hover:border-brand-blue/20 hover:bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between min-h-[160px] group">
                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center mb-4 shadow-sm group-hover:scale-105 transition-transform <?= $colorDelIcono($beneficio->icono) ?>">
                        <?= Icono::pintar($beneficio->icono, 'w-5 h-5') ?>
                    </div>
                    <div>
                        <h3 class="font-sora text-sm font-bold text-slate-800 mb-2"><?= Plantilla::escapar($beneficio->titulo) ?></h3>
                        <span class="inline-block font-inter text-[11px] font-bold text-brand-blue bg-light-blue-bg px-2 py-0.5 rounded uppercase tracking-wider">
                            <?= Plantilla::escapar($beneficio->palabraClave) ?>
                        </span>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
