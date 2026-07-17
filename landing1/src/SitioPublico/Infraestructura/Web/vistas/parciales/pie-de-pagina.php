<?php

declare(strict_types=1);

use DaCoach\Compartido\Infraestructura\Plantillas\Icono;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\SitioPublico\Dominio\DatosDeContacto;
use DaCoach\SitioPublico\Dominio\EnlaceDeNavegacion;

/**
 * @var DatosDeContacto $contacto
 */
$enlaces = EnlaceDeNavegacion::menuPrincipal();
$anio = (new DateTimeImmutable())->format('Y');
?>
<footer class="bg-deep-navy text-slate-400 border-t border-white/10 pt-16 pb-8 relative overflow-hidden font-inter text-sm">
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full bg-brand-blue/5 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 border-b border-white/10 pb-12 mb-8">

            <div class="lg:col-span-5 flex flex-col text-left">
                <div class="mb-5">
                    <?= $this->pintar('SitioPublico:parciales/logotipo') ?>
                </div>
                <p class="font-sora text-sm text-slate-300 font-semibold mb-6 max-w-sm leading-relaxed">
                    “Inteligencia artificial con estrategia, propósito y acompañamiento humano.”
                </p>
                <p class="text-xs text-slate-500 max-w-sm leading-relaxed">
                    DaCoach Integral Services ayuda a las empresas a simplificar sus operaciones, centralizar información y diseñar flujos automatizados estables.
                </p>
            </div>

            <div class="lg:col-span-3 flex flex-col text-left">
                <h2 class="font-sora text-xs font-bold text-white uppercase tracking-wider mb-5">Navegación</h2>
                <div class="grid grid-cols-2 gap-x-4 gap-y-3">
                    <?php foreach ($enlaces as $enlace) { ?>
                        <a href="<?= $enlace->seccion->ancla() ?>" class="hover:text-cyan-accent transition-colors text-xs">
                            <?= Plantilla::escapar($enlace->nombre) ?>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col text-left">
                <h2 class="font-sora text-xs font-bold text-white uppercase tracking-wider mb-5">Información de contacto</h2>
                <div class="space-y-3 text-xs">
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-accent flex-shrink-0"><?= Icono::pintar('mail', 'w-4 h-4') ?></span>
                        <span><?= Plantilla::escapar($contacto->correo) ?></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-accent flex-shrink-0"><?= Icono::pintar('phone', 'w-4 h-4') ?></span>
                        <span><?= Plantilla::escapar($contacto->telefono) ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-cyan-accent flex-shrink-0 mt-0.5"><?= Icono::pintar('map-pin', 'w-4 h-4') ?></span>
                        <span><?= Plantilla::escapar($contacto->direccion) ?></span>
                    </div>
                </div>

                <div class="flex gap-4 mt-6">
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-accent hover:text-deep-navy transition-all flex items-center justify-center text-slate-300" aria-label="LinkedIn">
                        <?= Icono::pintar('linkedin', 'w-4 h-4') ?>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-accent hover:text-deep-navy transition-all flex items-center justify-center text-slate-300" aria-label="Instagram">
                        <?= Icono::pintar('instagram', 'w-4 h-4') ?>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/5 hover:bg-cyan-accent hover:text-deep-navy transition-all flex items-center justify-center text-slate-300" aria-label="YouTube">
                        <?= Icono::pintar('youtube', 'w-4 h-4') ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>© <?= $anio ?> DaCoach Integral Services. Todos los derechos reservados.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-slate-300 transition-colors">Política de Privacidad</a>
                <span>·</span>
                <a href="#" class="hover:text-slate-300 transition-colors">Términos y Condiciones</a>
            </div>
        </div>
    </div>
</footer>
