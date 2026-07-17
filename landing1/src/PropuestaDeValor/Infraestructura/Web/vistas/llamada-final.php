<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

?>
<section class="py-24 bg-gradient-to-br from-deep-navy to-[#041126] text-white relative overflow-hidden">
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 rounded-full bg-cyan-accent/5 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-80 h-80 rounded-full bg-tech-violet/5 blur-[100px] pointer-events-none"></div>

    <svg class="absolute inset-0 w-full h-full pointer-events-none opacity-20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M -50 150 Q 300 20 800 220 T 1600 120" stroke="#19C2FF" stroke-width="1.5" stroke-dasharray="5 5" class="animate-flow-line"/>
        <path d="M 0 50 Q 400 180 900 60 T 1800 180" stroke="#6858FF" stroke-width="1.5" stroke-dasharray="6 4" class="animate-flow-line" style="animation-direction: reverse"/>
    </svg>

    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center flex flex-col items-center">
        <span class="font-inter text-xs lg:text-sm font-bold tracking-[3px] text-cyan-accent uppercase mb-4">EL PRIMER PASO NO ES COMPRAR TECNOLOGÍA</span>

        <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6 max-w-2xl tracking-tight">
            Es identificar qué proceso puede mejorar.
        </h2>

        <p class="font-inter text-base lg:text-lg text-slate-300 leading-relaxed mb-10 max-w-xl">
            Analizamos tu operación para descubrir dónde la automatización y la inteligencia artificial pueden producir un impacto real, reduciendo fricciones y preparando a tu equipo para escalar.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <a
                href="<?= SeccionDelSitio::Contacto->ancla() ?>"
                class="font-sora font-bold text-base px-8 py-4 bg-warm-accent text-deep-navy rounded-full hover:bg-white hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group"
            >
                Solicita un diagnóstico
                <span class="transition-transform group-hover:translate-x-1"><?= Icono::pintar('arrow-right', 'w-5 h-5') ?></span>
            </a>
            <a
                href="<?= SeccionDelSitio::AsistenteDemo->ancla() ?>"
                class="font-sora font-semibold text-base px-8 py-4 bg-white/5 hover:bg-white/15 text-white rounded-full border border-white/10 flex items-center justify-center gap-2 transition-all"
            >
                <span class="text-cyan-accent"><?= Icono::pintar('message-square-code', 'w-4 h-4') ?></span>
                Conversa con nuestro asistente
            </a>
        </div>
    </div>
</section>
