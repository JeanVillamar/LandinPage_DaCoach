<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\DatosDeContacto;
use DaCoach\SolicitudDeDiagnostico\Dominio\Industria;
use DaCoach\SolicitudDeDiagnostico\Dominio\TamanoDeEmpresa;

/**
 * Formulario de solicitud de diagnóstico.
 *
 * Envía un POST normal, así que funciona sin JavaScript; sitio.js lo intercepta
 * para enviarlo por fetch cuando está disponible. Las opciones de industria y
 * tamaño salen de los enums del dominio: lo que se ofrece aquí y lo que el
 * dominio acepta no pueden divergir.
 *
 * @var DatosDeContacto          $contacto
 * @var array<string, mixed>|null $aviso Resultado del envío anterior, si lo hubo.
 */
$campo = 'w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20';
$etiqueta = 'text-[10px] font-bold text-slate-500 uppercase block mb-1';
$exito = ($aviso['exito'] ?? false) === true;
?>
<section id="contacto" class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/3 left-0 w-80 h-80 rounded-full bg-light-blue-bg blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-5 flex flex-col text-left justify-between py-2">
                <div>
                    <span class="font-inter text-xs lg:text-sm font-bold tracking-[2px] text-brand-blue uppercase mb-3 block">COMENCEMOS POR ENTENDER TU PROCESO</span>
                    <h2 class="font-sora text-3xl sm:text-4xl lg:text-5xl font-extrabold text-primary-dark leading-tight mb-6">
                        Hablemos sobre lo que quieres mejorar.
                    </h2>
                    <p class="font-inter text-base text-secondary-text leading-relaxed mb-8">
                        Cuéntanos qué tareas consumen más tiempo, dónde se pierde información o qué parte de la atención deseas optimizar. Nos tomamos el tiempo de estudiar tu operación sin compromiso.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-brand-blue flex-shrink-0">
                                <?= Icono::pintar('mail', 'w-5 h-5') ?>
                            </div>
                            <div>
                                <h3 class="font-sora text-xs font-bold text-slate-800">Email Corporativo</h3>
                                <p class="font-inter text-xs text-slate-400"><?= Plantilla::escapar($contacto->correo) ?></p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center text-brand-blue flex-shrink-0">
                                <?= Icono::pintar('phone', 'w-5 h-5') ?>
                            </div>
                            <div>
                                <h3 class="font-sora text-xs font-bold text-slate-800">WhatsApp Comercial</h3>
                                <p class="font-inter text-xs text-slate-400"><?= Plantilla::escapar($contacto->telefono) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6">
                    <p class="flex items-center gap-2.5 text-xs text-slate-400">
                        <span class="text-emerald-500 flex-shrink-0"><?= Icono::pintar('shield-check', 'w-5 h-5') ?></span>
                        <span>Tratamos tus datos con total confidencialidad. No compartimos información comercial.</span>
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 bg-soft-neutral-bg border border-slate-200/60 rounded-3xl p-6 lg:p-10 shadow-xl">
                <div data-panel-exito <?= $exito ? '' : 'hidden' ?> class="text-center py-12 flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6">
                        <?= Icono::pintar('circle-check-big', 'w-10 h-10') ?>
                    </div>
                    <h3 class="font-sora text-2xl font-bold text-emerald-800 mb-3">¡Diagnóstico Solicitado!</h3>
                    <p data-mensaje-exito class="font-inter text-slate-600 leading-relaxed text-sm max-w-md mb-8">
                        <?= Plantilla::escapar((string) ($exito ? $aviso['mensaje'] : '')) ?>
                    </p>
                    <button
                        type="button"
                        data-reiniciar-formulario
                        class="font-sora font-semibold text-xs px-6 py-3 bg-brand-blue text-white rounded-xl hover:bg-brand-blue/90 transition-all shadow-md cursor-pointer"
                    >
                        Volver a enviar
                    </button>
                </div>

                <form
                    data-formulario-de-diagnostico
                    method="post"
                    action="/solicitudes/diagnostico"
                    <?= $exito ? 'hidden' : '' ?>
                    class="space-y-5 text-left font-inter text-sm"
                >
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nombre" class="<?= $etiqueta ?>">Nombre completo *</label>
                            <input required type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez" class="<?= $campo ?>">
                        </div>
                        <div>
                            <label for="empresa" class="<?= $etiqueta ?>">Empresa *</label>
                            <input required type="text" id="empresa" name="empresa" placeholder="Ej. Soluciones Globales S.A." class="<?= $campo ?>">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="correo" class="<?= $etiqueta ?>">Correo electrónico *</label>
                            <input required type="email" id="correo" name="correo" placeholder="Ej. juan@empresa.com" class="<?= $campo ?>">
                        </div>
                        <div>
                            <label for="telefono" class="<?= $etiqueta ?>">Teléfono *</label>
                            <input required type="tel" id="telefono" name="telefono" placeholder="Ej. +1 555-123-4567" class="<?= $campo ?>">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="industria" class="<?= $etiqueta ?>">Industria *</label>
                            <select required id="industria" name="industria" class="<?= $campo ?>">
                                <option value="">Selecciona una industria</option>
                                <?php foreach (Industria::cases() as $industria) { ?>
                                    <option value="<?= $industria->value ?>"><?= Plantilla::escapar($industria->etiqueta()) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="tamanoDeEmpresa" class="<?= $etiqueta ?>">Número aproximado de empleados *</label>
                            <select required id="tamanoDeEmpresa" name="tamanoDeEmpresa" class="<?= $campo ?>">
                                <option value="">Selecciona el tamaño</option>
                                <?php foreach (TamanoDeEmpresa::cases() as $tamano) { ?>
                                    <option value="<?= $tamano->value ?>"><?= Plantilla::escapar($tamano->etiqueta()) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="procesoAMejorar" class="<?= $etiqueta ?>">¿Qué proceso deseas mejorar? *</label>
                            <input required type="text" id="procesoAMejorar" name="procesoAMejorar" placeholder="Ej. Reservas, registro manual, atención" class="<?= $campo ?>">
                        </div>
                        <div>
                            <label for="herramientasActuales" class="<?= $etiqueta ?>">Herramientas que utilizas actualmente *</label>
                            <input required type="text" id="herramientasActuales" name="herramientasActuales" placeholder="Ej. WhatsApp, Excel, Gmail, Salesforce" class="<?= $campo ?>">
                        </div>
                    </div>

                    <div>
                        <label for="mensaje" class="<?= $etiqueta ?>">Mensaje o detalles adicionales</label>
                        <textarea id="mensaje" name="mensaje" rows="4" placeholder="Descríbenos brevemente el flujo actual y los principales cuellos de botella que detectas..." class="<?= $campo ?>"></textarea>
                    </div>

                    <div class="flex items-start gap-2.5 pt-2">
                        <input required type="checkbox" id="aceptaPrivacidad" name="aceptaPrivacidad" value="1" class="mt-0.5 border-slate-200 rounded text-brand-blue focus:ring-brand-blue/30">
                        <label for="aceptaPrivacidad" class="text-xs text-slate-500 leading-snug">
                            He leído y acepto la <a href="#" class="font-semibold text-slate-700 underline">Política de Privacidad</a>.
                        </label>
                    </div>

                    <p
                        data-error-del-formulario
                        role="alert"
                        <?= $exito || $aviso === null ? 'hidden' : '' ?>
                        class="p-3.5 bg-rose-500/10 border border-rose-500/25 text-rose-600 rounded-xl text-xs font-semibold"
                    ><?= Plantilla::escapar((string) (!$exito && $aviso !== null ? $aviso['mensaje'] : '')) ?></p>

                    <button
                        type="submit"
                        class="w-full bg-brand-blue hover:bg-brand-blue/90 text-white font-sora font-bold py-3.5 px-6 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer disabled:bg-slate-400 disabled:cursor-not-allowed"
                    >
                        <span data-texto-del-boton>Solicitar diagnóstico</span>
                        <?= Icono::pintar('send', 'w-4 h-4') ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
