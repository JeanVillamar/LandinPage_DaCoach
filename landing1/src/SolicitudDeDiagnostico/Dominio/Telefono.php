<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * Teléfono de contacto. Se acepta cualquier formato internacional razonable:
 * el objetivo es que un consultor pueda llamar, no validar numeración oficial.
 */
final class Telefono
{
    private function __construct(public readonly string $valor)
    {
    }

    public static function desdeCadena(string $valor): self
    {
        $normalizado = trim($valor);

        if ($normalizado === '') {
            throw DatosDeSolicitudInvalidos::porCampoObligatorio('teléfono');
        }

        $digitos = preg_replace('/\D/', '', $normalizado) ?? '';

        if (\strlen($digitos) < 7 || \strlen($digitos) > 15) {
            throw DatosDeSolicitudInvalidos::porFormato('teléfono');
        }

        return new self($normalizado);
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}
