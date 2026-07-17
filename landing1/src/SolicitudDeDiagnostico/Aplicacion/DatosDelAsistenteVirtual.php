<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Aplicacion;

/**
 * Lo que el asistente logró recoger durante la conversación. Es deliberadamente
 * más corto que el formulario: pedir más campos en un chat hace que el visitante
 * lo abandone.
 */
final class DatosDelAsistenteVirtual
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $correo,
        public readonly string $procesoAMejorar,
        public readonly bool $aceptaPrivacidad,
    ) {
    }
}
