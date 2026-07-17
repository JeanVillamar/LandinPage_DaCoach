<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\SitioPublico\Dominio\SeccionDelSitio;

/**
 * Demostración del asistente.
 *
 * El chat habla con /api/asistente/consultas y el panel lateral envía la
 * solicitud a /asistente/solicitudes: a diferencia de la versión React, donde
 * el mini formulario del chat sólo cambiaba estado local y el lead se perdía,
 * aquí acaba en el mismo repositorio que el formulario grande.
 *
 * Cuándo abrir el formulario lo decide el servidor (Tema::pideDiagnostico), no
 * una comprobación de palabras clave incrustada en la interfaz.
 */
$preguntasSugeridas = [
    '¿Qué procesos puedo automatizar?',
    '¿Cómo ayuda la IA a mi empresa?',
    '¿Trabajan con pequeñas empresas?',
    '¿Pueden integrar WhatsApp?',
    '¿Cómo comienza un proyecto?',
    'Quiero solicitar un diagnóstico.',
];

$pasosDelPanel = [
    'Elige la opción "Quiero solicitar un diagnóstico".',
    'Completa el formulario interactivo en este panel.',
    'Coordinaremos una videollamada para estudiar tu proceso.',
];

$campo = 'w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-brand-blue';
$etiqueta = 'text-[10px] font-bold text-slate-500 uppercase block mb-1';
?>
<section id="<?= SeccionDelSitio::AsistenteDemo->value ?>" class="py-24 bg-gradient-to-br from-deep-navy via-brand-blue to-dark-tech relative overflow-hidden text-white">
    <div class="absolute top-10 left-10 w-80 h-80 rounded-full bg-tech-violet/10 blur-[80px]"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 rounded-full bg-cyan-accent/10 blur-[80px]"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="max-w-3xl mb-16 text-left">
            <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-cyan-accent uppercase mb-3 block">PRUEBA UNA EXPERIENCIA INTELIGENTE</span>
            <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                Conversa con nuestro asistente de demostración.
            </h2>
            <p class="font-inter text-lg text-slate-300 leading-relaxed">
                Descubre cómo un asistente automatizado puede orientar clientes, identificar necesidades del negocio, recopilar datos clave y conectar a los usuarios con tu equipo.
            </p>
        </div>

        <div data-asistente class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

            <div class="lg:col-span-8 bg-[#0a1733]/90 border border-white/10 rounded-3xl p-6 flex flex-col h-[520px] justify-between shadow-2xl">
                <div class="flex items-center justify-between border-b border-white/10 pb-4 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-cyan-accent/10 flex items-center justify-center text-cyan-accent">
                            <?= Icono::pintar('sparkles', 'w-5 h-5') ?>
                        </div>
                        <div>
                            <h3 class="font-sora text-sm font-bold text-white leading-none">Asistente DaCoach</h3>
                            <span class="font-inter text-[10px] text-slate-400">Demostración interactiva</span>
                        </div>
                    </div>
                    <button
                        type="button"
                        data-reiniciar-asistente
                        class="text-xs font-semibold text-cyan-accent hover:text-white flex items-center gap-1.5 transition-colors cursor-pointer"
                    >
                        <?= Icono::pintar('refresh-cw', 'w-3.5 h-3.5') ?> Reiniciar
                    </button>
                </div>

                <div
                    data-historial-del-asistente
                    class="flex-1 overflow-y-auto pr-1 flex flex-col gap-4 font-inter text-sm mb-4 dark-scrollbar"
                    role="log"
                    aria-live="polite"
                    aria-label="Conversación con el asistente"
                ></div>

                <p data-error-del-asistente hidden role="alert" class="bg-rose-500/10 border border-rose-500/20 text-rose-300 p-3 rounded-xl text-xs text-center font-semibold mb-4"></p>

                <div class="flex flex-wrap gap-2 mb-4">
                    <?php foreach ($preguntasSugeridas as $pregunta) { ?>
                        <button
                            type="button"
                            data-pregunta-sugerida="<?= htmlspecialchars($pregunta, ENT_QUOTES, 'UTF-8') ?>"
                            class="bg-white/5 hover:bg-cyan-accent hover:text-deep-navy text-white text-xs py-1.5 px-3 rounded-full transition-all border border-white/10 cursor-pointer"
                        >
                            <?= htmlspecialchars($pregunta, ENT_QUOTES, 'UTF-8') ?>
                        </button>
                    <?php } ?>
                </div>

                <form data-formulario-del-asistente class="flex gap-3 border-t border-white/10 pt-4">
                    <label for="consulta-del-asistente" class="sr-only">Escribe tu pregunta</label>
                    <input
                        type="text"
                        id="consulta-del-asistente"
                        name="mensaje"
                        required
                        autocomplete="off"
                        placeholder="Escribe tu pregunta aquí..."
                        class="flex-grow bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-cyan-accent/50 text-white"
                    >
                    <button type="submit" class="bg-cyan-accent hover:bg-white text-deep-navy p-3 rounded-2xl transition-all shadow-md flex items-center justify-center cursor-pointer" aria-label="Enviar mensaje">
                        <?= Icono::pintar('send', 'w-4 h-4') ?>
                    </button>
                </form>
            </div>

            <div class="lg:col-span-4 flex flex-col justify-between">

                <div data-panel-asistente="informacion" class="bg-white/5 border border-white/10 rounded-3xl p-6 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="font-sora text-lg font-bold text-white mb-3">Solicita un Diagnóstico Inicial</h3>
                        <p class="font-inter text-sm text-slate-300 leading-relaxed mb-6">
                            A través de nuestro chatbot o del formulario en línea, analizamos los cuellos de botella de tu empresa para proponer la mejor ruta de automatización.
                        </p>
                        <ol class="space-y-4">
                            <?php foreach ($pasosDelPanel as $indice => $paso) { ?>
                                <li class="flex gap-3 items-start text-sm">
                                    <span class="w-5 h-5 rounded bg-cyan-accent/20 text-cyan-accent flex items-center justify-center flex-shrink-0 mt-0.5 text-xs font-bold"><?= $indice + 1 ?></span>
                                    <span class="text-slate-200"><?= htmlspecialchars($paso, ENT_QUOTES, 'UTF-8') ?></span>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-4">
                        <button
                            type="button"
                            data-pregunta-sugerida="Quiero solicitar un diagnóstico."
                            class="w-full bg-cyan-accent hover:bg-white text-deep-navy font-sora font-bold py-3 px-6 rounded-2xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <?= Icono::pintar('phone-call', 'w-4 h-4') ?>
                            Iniciar Diagnóstico Ahora
                        </button>
                    </div>
                </div>

                <form
                    data-panel-asistente="formulario"
                    data-formulario-de-lead
                    method="post"
                    action="/asistente/solicitudes"
                    hidden
                    class="bg-white text-primary-dark rounded-3xl p-6 border border-slate-100 shadow-2xl h-full flex flex-col justify-between"
                >
                    <div>
                        <h3 class="font-sora text-lg font-bold text-slate-800 mb-2">Datos para tu diagnóstico</h3>
                        <p class="font-inter text-xs text-slate-500 mb-4">Completa la información para que nuestro equipo analice tu operación.</p>

                        <div class="space-y-3">
                            <div>
                                <label for="lead-nombre" class="<?= $etiqueta ?>">Nombre completo *</label>
                                <input required type="text" id="lead-nombre" name="nombre" placeholder="Ej. Carlos Mendoza" class="<?= $campo ?>">
                            </div>
                            <div>
                                <label for="lead-correo" class="<?= $etiqueta ?>">Correo corporativo *</label>
                                <input required type="email" id="lead-correo" name="correo" placeholder="Ej. carlos@empresa.com" class="<?= $campo ?>">
                            </div>
                            <div>
                                <label for="lead-proceso" class="<?= $etiqueta ?>">Proceso que deseas mejorar *</label>
                                <input required type="text" id="lead-proceso" name="procesoAMejorar" placeholder="Ej. Registro y confirmación de citas" class="<?= $campo ?>">
                            </div>

                            <div class="flex items-start gap-2 pt-2">
                                <input required type="checkbox" id="lead-privacidad" name="aceptaPrivacidad" value="1" class="mt-0.5 border-slate-200 rounded text-brand-blue focus:ring-brand-blue/30">
                                <label for="lead-privacidad" class="text-[10px] text-slate-500 leading-snug">
                                    Acepto la Política de Privacidad y el tratamiento de mis datos comerciales.
                                </label>
                            </div>

                            <p data-error-del-lead hidden role="alert" class="text-[10px] font-semibold text-rose-600 bg-rose-50 border border-rose-100 rounded-lg p-2"></p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-4 flex gap-2">
                        <button type="button" data-volver-del-lead class="flex-1 font-sora font-semibold text-xs py-2.5 bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200 transition-all cursor-pointer">
                            Atrás
                        </button>
                        <button type="submit" class="flex-1 font-sora font-bold text-xs py-2.5 bg-brand-blue text-white rounded-xl hover:bg-brand-blue/90 transition-all shadow-md cursor-pointer disabled:bg-slate-400">
                            Confirmar Solicitud
                        </button>
                    </div>
                </form>

                <div data-panel-asistente="exito" hidden class="bg-emerald-50 border border-emerald-100 rounded-3xl p-6 text-slate-800 h-full flex flex-col justify-between items-center text-center">
                    <div class="my-auto flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                            <?= Icono::pintar('circle-check', 'w-8 h-8') ?>
                        </div>
                        <h3 class="font-sora text-lg font-bold text-emerald-800 mb-2">¡Solicitud Recibida!</h3>
                        <p class="font-inter text-xs text-slate-600 leading-relaxed max-w-[220px]">
                            El asistente ha conectado tus datos con nuestro equipo. Nos pondremos en contacto contigo a la brevedad.
                        </p>
                    </div>
                    <button type="button" data-volver-del-lead class="w-full mt-6 font-sora font-semibold text-xs py-2.5 bg-white border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition-all cursor-pointer">
                        Volver a ver información
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
