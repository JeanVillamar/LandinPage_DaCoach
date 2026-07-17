<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\PropuestaDeValor\Dominio\PasoDelFlujoInteligente;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * @var list<PasoDelFlujoInteligente> $pasos
 * @var string                        $lema
 */
$automaticos = array_values(array_filter($pasos, static fn (PasoDelFlujoInteligente $p): bool => !$p->esSupervisionHumana));
$supervision = null;

foreach ($pasos as $paso) {
    if ($paso->esSupervisionHumana) {
        $supervision = $paso;
        break;
    }
}
?>
<section
    id="<?= SeccionDelSitio::Inicio->value ?>"
    class="relative min-h-screen pt-28 pb-16 flex items-center bg-gradient-to-br from-deep-navy via-brand-blue to-dark-tech overflow-hidden"
>
    <div class="absolute top-1/4 left-[10%] w-96 h-96 rounded-full bg-tech-violet/10 blur-[80px] animate-glow-pulse"></div>
    <div class="absolute bottom-1/4 right-[10%] w-[400px] h-[400px] rounded-full bg-cyan-accent/15 blur-[100px] animate-glow-pulse" style="animation-delay: 1.5s"></div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10 w-full">
        <div class="lg:col-span-7 flex flex-col items-start text-left">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[3px] text-cyan-accent uppercase mb-4 animate-reveal-text">
                CONSULTORÍA · AUTOMATIZACIÓN · INTELIGENCIA ARTIFICIAL
            </span>

            <h1 class="font-sora text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
                Convierte procesos lentos en
                <span class="bg-gradient-to-r from-cyan-accent via-electric-blue to-tech-violet bg-clip-text text-transparent drop-shadow-sm">operaciones inteligentes</span>.
            </h1>

            <p class="font-inter text-lg text-slate-300 mb-4 leading-relaxed max-w-xl">
                Ayudamos a las empresas a mejorar, automatizar y optimizar sus procesos mediante soluciones de inteligencia artificial diseñadas alrededor de sus necesidades reales.
            </p>
            <p class="font-inter text-sm font-medium text-white/90 border-l-2 border-warm-accent pl-4 py-1 mb-8 max-w-xl">
                Menos tareas repetitivas. Respuestas más rápidas. Información conectada. Procesos preparados para crecer.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto mb-8">
                <a
                    href="<?= SeccionDelSitio::Contacto->ancla() ?>"
                    class="font-sora font-bold text-base px-8 py-4 bg-warm-accent text-deep-navy rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group"
                >
                    Solicita un diagnóstico
                    <span class="transition-transform group-hover:translate-x-1"><?= Icono::pintar('arrow-right', 'w-5 h-5') ?></span>
                </a>
                <a
                    href="<?= SeccionDelSitio::Metodologia->ancla() ?>"
                    class="font-sora font-semibold text-base px-8 py-4 bg-white/10 hover:bg-white/20 text-white rounded-full transition-all flex items-center justify-center gap-2 border border-white/15"
                >
                    Descubre cómo trabajamos
                    <span class="text-cyan-accent"><?= Icono::pintar('play', 'w-4 h-4') ?></span>
                </a>
            </div>

            <p class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <span class="w-2 h-2 rounded-full bg-warm-accent animate-pulse"></span>
                <?= Plantilla::escapar($lema) ?>
            </p>
        </div>

        <div class="lg:col-span-5 flex justify-center items-center w-full">
            <div
                data-flujo-inteligente
                class="w-full max-w-[450px] aspect-[9/10] bg-white/[0.03] backdrop-blur-md border border-white/10 rounded-3xl p-6 relative overflow-hidden shadow-2xl flex flex-col justify-between"
            >
                <div class="flex items-center justify-between border-b border-white/10 pb-4 mb-4">
                    <span class="font-sora text-xs font-bold text-slate-400 uppercase tracking-widest">Flujo Operativo Inteligente</span>
                    <span class="px-2 py-0.5 rounded bg-cyan-accent/10 text-cyan-accent text-[10px] font-bold uppercase tracking-wider animate-pulse">Simulación en tiempo real</span>
                </div>

                <div class="flex flex-col gap-3 relative flex-grow justify-center">
                    <?php foreach ($automaticos as $indice => $paso) { ?>
                        <div
                            data-paso-del-flujo="<?= $indice ?>"
                            data-activo="<?= $indice === 0 ? 'true' : 'false' ?>"
                            class="group flex items-center gap-4 p-3 rounded-xl border transition-all duration-300 relative z-10 bg-white/[0.02] border-white/5 hover:bg-white/[0.05] hover:border-white/15 data-[activo=true]:bg-gradient-to-r data-[activo=true]:from-brand-blue/30 data-[activo=true]:to-tech-violet/20 data-[activo=true]:border-cyan-accent data-[activo=true]:shadow-lg data-[activo=true]:scale-[1.02]"
                        >
                            <div class="w-9 h-9 rounded-lg flex items-center justify-center transition-all bg-white/5 text-slate-400 group-data-[activo=true]:bg-cyan-accent group-data-[activo=true]:text-deep-navy">
                                <?= Icono::pintar($paso->icono, 'w-5 h-5') ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-sora text-sm font-semibold text-white truncate"><?= Plantilla::escapar($paso->etiqueta) ?></h3>
                                <p class="font-inter text-xs text-slate-400 truncate"><?= Plantilla::escapar($paso->descripcion) ?></p>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full bg-white/10 flex-shrink-0 group-data-[activo=true]:bg-cyan-accent group-data-[activo=true]:animate-ping"></span>
                        </div>
                    <?php } ?>

                    <?php if ($supervision !== null) { ?>
                        <div
                            data-paso-del-flujo="<?= \count($automaticos) ?>"
                            data-activo="false"
                            class="mt-4 flex items-center gap-4 p-3.5 rounded-xl border transition-all duration-300 relative z-10 bg-white/[0.02] border-warm-accent/20 hover:bg-warm-accent/10 hover:border-warm-accent/40 data-[activo=true]:bg-warm-accent/15 data-[activo=true]:border-warm-accent data-[activo=true]:shadow-md data-[activo=true]:scale-[1.02]"
                        >
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all bg-warm-accent/10 text-warm-accent">
                                <?= Icono::pintar($supervision->icono, 'w-5 h-5') ?>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-sora text-sm font-bold text-white flex items-center gap-1.5">
                                    <?= Plantilla::escapar($supervision->etiqueta) ?>
                                    <span class="px-1.5 py-0.5 rounded bg-warm-accent/25 text-warm-accent text-[8px] font-bold uppercase tracking-wider">Control</span>
                                </h3>
                                <p class="font-inter text-xs text-slate-300"><?= Plantilla::escapar($supervision->descripcion) ?></p>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-warm-accent animate-pulse flex-shrink-0"></span>
                        </div>
                    <?php } ?>
                </div>

                <div class="mt-4 border-t border-white/10 pt-3 min-h-[50px] flex items-center">
                    <p data-detalle-del-flujo class="font-inter text-xs text-slate-400 italic">
                        💡 Coloca el cursor sobre cualquier paso del flujo para comprender cómo funciona.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
