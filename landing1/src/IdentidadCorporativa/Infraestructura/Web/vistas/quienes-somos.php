<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\IdentidadCorporativa\Dominio\Identidad;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var Identidad $identidad
 */
$colorDelIcono = static fn (string $icono): string => match ($icono) {
    'heart' => 'text-rose-500',
    'compass' => 'text-cyan-accent',
    'cpu' => 'text-electric-blue',
    'handshake' => 'text-warm-accent',
    default => 'text-tech-violet',
};
?>
<section id="<?= SeccionDelSitio::Nosotros->value ?>" class="py-24 bg-soft-neutral-bg relative overflow-hidden">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-brand-blue/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-16">
            <div class="lg:col-span-7 flex flex-col text-left">
                <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">QUIÉNES SOMOS</span>
                <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                    Somos el puente entre tu empresa, tu equipo y la tecnología.
                </h2>
                <p class="font-inter text-lg text-slate-700 leading-relaxed mb-4">
                    DaCoach Integral Services es una empresa de consultoría e implementación tecnológica especializada en inteligencia artificial, automatización de procesos e integración de herramientas digitales.
                </p>
                <p class="font-inter text-sm text-secondary-text leading-relaxed border-l-2 border-brand-blue pl-4 py-1">
                    Nuestro trabajo no termina con la instalación de una herramienta. Analizamos, diseñamos, implementamos, validamos y acompañamos al equipo durante todo el proceso de adopción.
                </p>
            </div>

            <div class="lg:col-span-5 flex justify-center w-full">
                <div class="w-full max-w-[380px] bg-gradient-to-br from-brand-blue to-deep-navy p-8 rounded-3xl text-white shadow-xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(25,194,255,0.1),transparent)] pointer-events-none"></div>
                    <span class="font-inter text-[10px] font-bold text-cyan-accent tracking-[2px] uppercase block mb-4">NUESTRO COMPROMISO</span>
                    <blockquote class="font-sora text-xl font-bold leading-relaxed mb-6">
                        <?= Plantilla::escapar($identidad->compromiso()) ?>
                    </blockquote>
                    <div class="h-0.5 w-12 bg-warm-accent"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <?php foreach ($identidad->valores() as $valor) { ?>
                <article class="bg-white border border-slate-200/60 hover:border-brand-blue/30 rounded-2xl p-6 transition-all duration-300 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[220px]">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                        <span class="font-sora text-3xl font-extrabold text-slate-200"><?= Plantilla::escapar($valor->numero) ?></span>
                        <div class="p-2 rounded-lg bg-slate-50 flex items-center justify-center <?= $colorDelIcono($valor->icono) ?>">
                            <?= Icono::pintar($valor->icono, 'w-5 h-5') ?>
                        </div>
                    </div>
                    <div class="text-left">
                        <h3 class="font-sora text-sm font-bold text-slate-800 mb-1.5"><?= Plantilla::escapar($valor->titulo) ?></h3>
                        <p class="font-inter text-xs text-secondary-text leading-relaxed"><?= Plantilla::escapar($valor->descripcion) ?></p>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
