<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * El motivo real de la solicitud: qué duele hoy en la operación.
 *
 * Es el dato con el que un consultor prepara el diagnóstico, por eso la
 * descripción es obligatoria en los dos canales. Las herramientas actuales y el
 * mensaje son contexto adicional que sólo pide el formulario.
 */
final class ProcesoAMejorar
{
    private function __construct(
        public readonly string $descripcion,
        public readonly string $herramientasActuales,
        public readonly string $mensajeAdicional,
    ) {
    }

    public static function crear(
        string $descripcion,
        string $herramientasActuales = '',
        string $mensajeAdicional = '',
    ): self {
        $descripcionLimpia = trim($descripcion);

        if ($descripcionLimpia === '') {
            throw DatosDeSolicitudInvalidos::porCampoObligatorio('proceso que deseas mejorar');
        }

        if (mb_strlen($descripcionLimpia) > 500) {
            throw DatosDeSolicitudInvalidos::porFormato('proceso que deseas mejorar');
        }

        if (mb_strlen(trim($mensajeAdicional)) > 2000) {
            throw DatosDeSolicitudInvalidos::porFormato('mensaje o detalles adicionales');
        }

        return new self($descripcionLimpia, trim($herramientasActuales), trim($mensajeAdicional));
    }

    /**
     * @return list<string> Herramientas citadas por el visitante, separadas por coma.
     */
    public function herramientasCitadas(): array
    {
        if ($this->herramientasActuales === '') {
            return [];
        }

        $herramientas = array_map('trim', explode(',', $this->herramientasActuales));

        return array_values(array_filter($herramientas, static fn (string $h): bool => $h !== ''));
    }
}
