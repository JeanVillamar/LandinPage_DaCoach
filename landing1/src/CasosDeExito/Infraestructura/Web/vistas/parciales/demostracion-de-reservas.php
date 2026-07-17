<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;

/**
 * Maqueta del bot de reservas de Alejandro Magno Astral.
 *
 * Es una demostración guiada: el guion está en assets/js/demostracion-de-reservas.js
 * y no llega a ningún servidor. El pago es simulado y se advierte en pantalla.
 */
$capacidades = [
    'Atención inicial 24/7',
    'Selección de servicios',
    'Calendario dinámico',
    'Confirmación automática',
];
?>
<div class="mt-16 bg-gradient-to-br from-deep-navy to-dark-tech rounded-3xl p-6 lg:p-12 text-white grid grid-cols-1 lg:grid-cols-12 gap-8 items-center shadow-xl">
    <div class="lg:col-span-6">
        <span class="font-inter text-xs font-bold tracking-[2px] text-cyan-accent uppercase mb-3 block">DEMOSTRACIÓN INTERACTIVA DE PROYECTO</span>
        <h3 class="font-sora text-2xl lg:text-3xl font-extrabold text-white mb-4">
            Asistente de Reservas: Alejandro Magno Astral
        </h3>
        <p class="font-inter text-sm lg:text-base text-slate-300 leading-relaxed mb-6">
            Diseñamos un bot conversacional inteligente capaz de recibir solicitudes, orientar según necesidades, buscar horarios de citas disponibles, facilitar enlaces de cobro simulados y notificar al equipo interno de forma 100% automatizada.
        </p>

        <div class="grid grid-cols-2 gap-3 mb-6">
            <?php foreach ($capacidades as $capacidad) { ?>
                <p class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded-full bg-cyan-accent/20 flex items-center justify-center flex-shrink-0 text-cyan-accent">
                        <?= Icono::pintar('check', 'w-3 h-3') ?>
                    </span>
                    <span class="font-inter text-xs text-slate-200"><?= $capacidad ?></span>
                </p>
            <?php } ?>
        </div>

        <button
            type="button"
            data-abrir-caso="alejandro-magno-astral"
            class="font-sora font-semibold text-xs py-2 px-4 bg-white/10 hover:bg-white/20 border border-white/15 text-white rounded-lg flex items-center gap-1 transition-all cursor-pointer"
        >
            Ver análisis de caso completo <?= Icono::pintar('external-link', 'w-3.5 h-3.5') ?>
        </button>
    </div>

    <div
        data-demostracion-de-reservas
        class="lg:col-span-6 w-full max-w-[420px] mx-auto bg-[#0a152d]/90 border border-white/10 rounded-2xl p-4 flex flex-col h-[400px] justify-between shadow-2xl relative"
    >
        <div class="flex items-center justify-between border-b border-white/10 pb-3 mb-3">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="font-sora text-xs font-bold text-white uppercase tracking-wider">Asistente Astral (Demo)</span>
            </div>
            <button
                type="button"
                data-reiniciar-demostracion
                class="text-[10px] font-semibold text-cyan-accent hover:text-white transition-colors flex items-center gap-0.5 cursor-pointer"
            >
                <?= Icono::pintar('rotate-ccw', 'w-3 h-3') ?> Reiniciar
            </button>
        </div>

        <div
            data-historial-de-reservas
            class="flex-1 overflow-y-auto pr-1 flex flex-col gap-3 font-inter text-xs dark-scrollbar"
            role="log"
            aria-live="polite"
        ></div>

        <div class="border-t border-white/10 pt-3 mt-3 flex gap-2">
            <input
                disabled
                type="text"
                placeholder="Las opciones se seleccionan haciendo clic..."
                class="flex-grow bg-white/5 border border-white/5 rounded-xl px-3 py-1.5 text-xs text-slate-400 focus:outline-none"
                aria-label="Entrada deshabilitada en la demostración"
            >
            <button disabled class="bg-slate-700 text-slate-400 p-2 rounded-xl" aria-label="Enviar (deshabilitado)">
                <?= Icono::pintar('send', 'w-3.5 h-3.5') ?>
            </button>
        </div>
    </div>
</div>
