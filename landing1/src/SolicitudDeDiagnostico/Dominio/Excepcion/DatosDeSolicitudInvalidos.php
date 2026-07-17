<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion;

/**
 * El mensaje es apto para mostrarse al visitante: describe qué campo corrige
 * sin filtrar detalles internos.
 */
final class DatosDeSolicitudInvalidos extends \DomainException
{
    public static function porCampoObligatorio(string $campo): self
    {
        return new self(sprintf('El campo "%s" es obligatorio.', $campo));
    }

    public static function porFormato(string $campo): self
    {
        return new self(sprintf('El valor indicado en "%s" no tiene un formato válido.', $campo));
    }
}
