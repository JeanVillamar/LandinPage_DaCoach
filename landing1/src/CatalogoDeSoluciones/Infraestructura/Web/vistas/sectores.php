<?php

declare(strict_types=1);

use DaCoach\CatalogoDeSoluciones\Dominio\Sector;
use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<Sector> $sectores
 */
$colorDelIcono = static fn (string $icono): string => match ($icono) {
    'stethoscope' => 'text-rose-500',
    'flask-conical', 'headphones' => 'text-cyan-accent',
    'scale', 'building' => 'text-brand-blue',
    'file-text', 'book-open' => 'text-tech-violet',
    'shopping-bag', 'calendar' => 'text-warm-accent',
    default => 'text-electric-blue',
};
?>
<section id="<?= SeccionDelSitio::Industrias->value ?>" class="py-24 bg-soft-neutral-bg relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full bg-cyan-accent/5 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">SOLUCIONES ADAPTABLES</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                La tecnología cambia. Cada operación también.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                Adaptamos la inteligencia artificial a las necesidades específicas de tu sector. Nos enfocamos en mejorar procesos clave sin alterar la naturaleza de tu servicio.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <?php foreach ($sectores as $sector) { ?>
                <article class="bg-white border border-slate-200/60 hover:border-brand-blue/30 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-3 mb-4">
                            <div class="p-2 rounded-xl bg-slate-50 flex-shrink-0 flex items-center justify-center <?= $colorDelIcono($sector->icono) ?>">
                                <?= Icono::pintar($sector->icono, 'w-5 h-5') ?>
                            </div>
                            <h3 class="font-sora text-sm font-bold text-slate-800 leading-snug"><?= Plantilla::escapar($sector->titulo) ?></h3>
                        </div>

                        <div class="space-y-1.5">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Procesos a optimizar:</span>
                            <?php foreach ($sector->procesosAOptimizar as $proceso) { ?>
                                <p class="flex items-start gap-1.5 text-xs text-slate-600 font-inter">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-blue/40 mt-1.5 flex-shrink-0"></span>
                                    <span><?= Plantilla::escapar($proceso) ?></span>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
