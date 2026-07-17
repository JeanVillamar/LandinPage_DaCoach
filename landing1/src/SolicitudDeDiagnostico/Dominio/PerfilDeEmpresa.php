<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * Contexto de la empresa que solicita el diagnóstico. Sólo lo recoge el
 * formulario de contacto (ver CanalDeOrigen::recogePerfilDeEmpresa()).
 */
final class PerfilDeEmpresa
{
    private function __construct(
        public readonly string $nombre,
        public readonly Industria $industria,
        public readonly TamanoDeEmpresa $tamano,
    ) {
    }

    public static function crear(string $nombre, Industria $industria, TamanoDeEmpresa $tamano): self
    {
        $nombreLimpio = trim($nombre);

        if ($nombreLimpio === '') {
            throw DatosDeSolicitudInvalidos::porCampoObligatorio('empresa');
        }

        if (mb_strlen($nombreLimpio) > 150) {
            throw DatosDeSolicitudInvalidos::porFormato('empresa');
        }

        return new self($nombreLimpio, $industria, $tamano);
    }
}
