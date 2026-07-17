<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\MetodologiaDeTrabajo\Dominio\PrincipioDeColaboracion;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<PrincipioDeColaboracion> $principios
 */
?>
<section id="<?= SeccionDelSitio::EnfoqueHumano->value ?>" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[350px] h-[350px] rounded-full bg-warm-accent/5 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-5 flex justify-center w-full">
                <div class="w-full max-w-[400px] aspect-square rounded-3xl bg-soft-neutral-bg border border-slate-200/80 p-6 flex flex-col justify-between shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-warm-accent/10 rounded-full blur-2xl"></div>

                    <span class="font-sora text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-4 border-b border-slate-200 pb-2">
                        Modelo de Colaboración DaCoach
                    </span>

                    <div class="flex-1 flex flex-col justify-center items-center gap-6 relative">
                        <div class="absolute w-[2px] h-[140px] bg-slate-200 z-0">
                            <div class="w-full h-1/2 bg-warm-accent animate-flow-line"></div>
                        </div>

                        <div class="z-10 bg-white border border-slate-200 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm hover:border-warm-accent transition-colors">
                            <div class="w-8 h-8 rounded-lg bg-warm-accent/10 text-warm-accent flex items-center justify-center">
                                <?= Icono::pintar('users', 'w-4 h-4') ?>
                            </div>
                            <div>
                                <h3 class="font-sora text-xs font-bold text-primary-dark">Equipo de Operación</h3>
                                <p class="font-inter text-[10px] text-slate-400">Conoce el proceso real</p>
                            </div>
                        </div>

                        <div class="z-10 bg-white border border-slate-200 px-4 py-3 rounded-2xl flex items-center gap-3 shadow-sm hover:border-brand-blue/30 transition-colors">
                            <div class="w-8 h-8 rounded-lg bg-brand-blue/10 text-brand-blue flex items-center justify-center">
                                <?= Icono::pintar('handshake', 'w-4 h-4') ?>
                            </div>
                            <div>
                                <h3 class="font-sora text-xs font-bold text-primary-dark">Flujo Inteligente</h3>
                                <p class="font-inter text-[10px] text-slate-400">Automatiza y optimiza tareas</p>
                            </div>
                        </div>

                        <div class="absolute right-4 top-1/2 -translate-y-1/2 flex flex-col items-center gap-1.5 bg-warm-accent/10 border border-warm-accent/30 p-2.5 rounded-xl">
                            <span class="text-warm-accent"><?= Icono::pintar('eye', 'w-4 h-4') ?></span>
                            <span class="text-[8px] font-bold text-warm-accent uppercase tracking-wider">Supervisión</span>
                        </div>
                    </div>

                    <p class="mt-4 text-center font-sora text-xs font-semibold text-slate-700">
                        Tecnología integrada, personas al mando.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col text-left">
                <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">TECNOLOGÍA DISEÑADA CON LAS PERSONAS</span>
                <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                    La transformación comienza con quienes conocen el proceso.
                </h2>
                <p class="font-inter text-base text-secondary-text mb-8 leading-relaxed">
                    No llegamos a imponer herramientas. Escuchamos a las personas que trabajan diariamente con la operación y las involucramos en el diseño de la solución para garantizar una adopción exitosa.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <?php foreach ($principios as $principio) { ?>
                        <article class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 text-brand-blue flex-shrink-0 flex items-center justify-center">
                                <?= Icono::pintar($principio->icono, 'w-5 h-5') ?>
                            </div>
                            <div>
                                <h3 class="font-sora text-sm font-bold text-primary-dark mb-1"><?= Plantilla::escapar($principio->titulo) ?></h3>
                                <p class="font-inter text-xs text-secondary-text leading-relaxed"><?= Plantilla::escapar($principio->descripcion) ?></p>
                            </div>
                        </article>
                    <?php } ?>
                </div>

                <blockquote class="border-l-4 border-warm-accent bg-warm-accent/5 p-5 rounded-r-2xl">
                    <p class="font-sora text-base lg:text-lg font-bold text-primary-dark tracking-tight leading-snug">
                        “La tecnología debe facilitar el trabajo de las personas, no complicarlo.”
                    </p>
                </blockquote>
            </div>

        </div>
    </div>
</section>
