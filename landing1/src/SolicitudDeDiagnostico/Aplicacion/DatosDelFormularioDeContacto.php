<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Aplicacion;

/**
 * Lo que escribió el visitante en el formulario, todavía sin validar.
 * Son primitivas a propósito: el caso de uso las convierte en objetos del
 * dominio y es ahí donde se rechazan.
 */
final class DatosDelFormularioDeContacto
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $empresa,
        public readonly string $correo,
        public readonly string $telefono,
        public readonly string $industria,
        public readonly string $tamanoDeEmpresa,
        public readonly string $procesoAMejorar,
        public readonly string $herramientasActuales,
        public readonly string $mensaje,
        public readonly bool $aceptaPrivacidad,
    ) {
    }
}
