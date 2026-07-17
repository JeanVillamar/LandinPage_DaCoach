<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\InteligenciaArtificialResponsable\Dominio\PrincipioDeGobernanza;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<PrincipioDeGobernanza> $principios
 */
$colorDelIcono = static fn (string $icono): string => match ($icono) {
    'shield', 'database' => 'text-brand-blue',
    'key', 'file-spreadsheet' => 'text-cyan-accent',
    'eye', 'heart-handshake' => 'text-tech-violet',
    'circle-alert' => 'text-rose-500',
    default => 'text-emerald-500',
};
?>
<section id="<?= SeccionDelSitio::Responsabilidad->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-72 h-72 rounded-full bg-light-blue-bg blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">INTELIGENCIA ARTIFICIAL RESPONSABLE</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                Automatización con reglas, límites y supervisión.
            </h2>
            <p class="font-inter text-lg text-secondary-text leading-relaxed">
                La automatización genera valor real cuando es predecible, segura y se encuentra bajo el control de las personas. Diseñamos sistemas con una gobernanza sólida para tu tranquilidad.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($principios as $principio) { ?>
                <article class="bg-soft-neutral-bg border border-slate-200/50 hover:border-brand-blue/30 rounded-2xl p-6 transition-all duration-300 shadow-sm flex flex-col justify-between hover:bg-white">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center mb-5 <?= $colorDelIcono($principio->icono) ?>">
                            <?= Icono::pintar($principio->icono, 'w-5 h-5') ?>
                        </div>
                        <h3 class="font-sora text-base font-bold text-slate-800 mb-2"><?= Plantilla::escapar($principio->titulo) ?></h3>
                        <p class="font-inter text-xs text-secondary-text leading-relaxed"><?= Plantilla::escapar($principio->descripcion) ?></p>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
