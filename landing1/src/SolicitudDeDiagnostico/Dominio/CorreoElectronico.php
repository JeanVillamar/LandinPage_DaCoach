<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

final class CorreoElectronico
{
    private function __construct(public readonly string $valor)
    {
    }

    public static function desdeCadena(string $valor): self
    {
        $normalizado = strtolower(trim($valor));

        if ($normalizado === '') {
            throw DatosDeSolicitudInvalidos::porCampoObligatorio('correo electrónico');
        }

        if (filter_var($normalizado, FILTER_VALIDATE_EMAIL) === false) {
            throw DatosDeSolicitudInvalidos::porFormato('correo electrónico');
        }

        return new self($normalizado);
    }

    public function dominio(): string
    {
        return substr($this->valor, strrpos($this->valor, '@') + 1);
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}
