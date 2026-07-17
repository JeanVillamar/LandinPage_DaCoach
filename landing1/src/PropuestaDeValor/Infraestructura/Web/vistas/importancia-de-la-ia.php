<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\PropuestaDeValor\Dominio\AreaDeImpacto;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<AreaDeImpacto> $areas
 */

/**
 * El acento de cada área es decoración, no contenido: por eso el color se
 * decide aquí y no en el dominio.
 *
 * @return array{0: string, 1: string} Color del icono y de su fondo.
 */
$acento = static fn (string $icono): array => match ($icono) {
    'zap' => ['text-cyan-accent', 'bg-cyan-accent/10'],
    'target' => ['text-tech-violet', 'bg-tech-violet/10'],
    'folder-git' => ['text-electric-blue', 'bg-electric-blue/10'],
    'clock' => ['text-warm-accent', 'bg-warm-accent/10'],
    default => ['text-brand-blue', 'bg-brand-blue/10'],
};
?>
<section id="<?= SeccionDelSitio::InteligenciaArtificial->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-80 h-80 rounded-full bg-light-blue-bg blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">EL NUEVO ESTÁNDAR OPERATIVO</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                La inteligencia artificial ya está cambiando la forma de trabajar.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                No se trata de reemplazar personas. Se trata de reducir fricción, mejorar procesos y permitir que los equipos dediquen más tiempo a actividades que requieren experiencia, creatividad y criterio humano.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-24">
            <?php foreach ($areas as $area) {
                [$colorIcono, $colorFondo] = $acento($area->icono);
                ?>
                <article class="bg-soft-neutral-bg border border-slate-100 hover:border-brand-blue/20 hover:bg-white rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md flex flex-col justify-between group">
                    <div>
                        <div class="w-12 h-12 rounded-xl <?= $colorFondo ?> <?= $colorIcono ?> flex items-center justify-center mb-5 transition-transform group-hover:scale-110 duration-300">
                            <?= Icono::pintar($area->icono, 'w-6 h-6') ?>
                        </div>
                        <h3 class="font-sora text-lg font-bold text-primary-dark mb-3"><?= Plantilla::escapar($area->titulo) ?></h3>
                        <p class="font-inter text-sm text-secondary-text leading-relaxed"><?= Plantilla::escapar($area->descripcion) ?></p>
                    </div>
                </article>
            <?php } ?>
        </div>

        <div class="bg-gradient-to-r from-deep-navy via-brand-blue to-dark-tech rounded-3xl p-12 lg:p-20 text-center relative overflow-hidden shadow-xl">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(25,194,255,0.08),transparent_50%)] pointer-events-none"></div>
            <div class="max-w-4xl mx-auto relative z-10 flex flex-col items-center">
                <span class="font-inter text-[10px] lg:text-xs font-bold tracking-[3px] text-cyan-accent uppercase mb-4">ENFOQUE ESTRATÉGICO</span>
                <blockquote class="font-sora text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    “La inteligencia artificial no reemplaza una estrategia.
                    <span class="bg-gradient-to-r from-cyan-accent to-warm-accent bg-clip-text text-transparent">La hace más poderosa.</span>”
                </blockquote>
            </div>
        </div>
    </div>
</section>
