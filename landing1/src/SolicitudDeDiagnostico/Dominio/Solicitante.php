<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * La persona que pide el diagnóstico. El teléfono es opcional porque el
 * asistente virtual no lo pide.
 */
final class Solicitante
{
    private function __construct(
        public readonly string $nombre,
        public readonly CorreoElectronico $correo,
        public readonly ?Telefono $telefono,
    ) {
    }

    public static function crear(string $nombre, CorreoElectronico $correo, ?Telefono $telefono = null): self
    {
        $nombreLimpio = trim($nombre);

        if ($nombreLimpio === '') {
            throw DatosDeSolicitudInvalidos::porCampoObligatorio('nombre completo');
        }

        if (mb_strlen($nombreLimpio) > 120) {
            throw DatosDeSolicitudInvalidos::porFormato('nombre completo');
        }

        return new self($nombreLimpio, $correo, $telefono);
    }

    public function nombreDePila(): string
    {
        return explode(' ', $this->nombre)[0];
    }
}
