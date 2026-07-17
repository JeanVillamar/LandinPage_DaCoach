<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion;

/**
 * El aviso al equipo no salió. La solicitud ya está guardada, así que esto no
 * invalida el registro: se reporta, no se propaga al visitante.
 */
final class FalloAlNotificar extends \RuntimeException
{
    public static function por(string $motivo, ?\Throwable $causa = null): self
    {
        return new self(sprintf('No se pudo avisar al equipo comercial: %s', $motivo), 0, $causa);
    }
}
