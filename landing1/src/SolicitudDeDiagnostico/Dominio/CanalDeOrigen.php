<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

/**
 * Punto de entrada por el que llegó la solicitud.
 *
 * El asistente sólo pide nombre, correo y proceso; el formulario pide además la
 * empresa y su contexto. Saber el canal explica por qué una solicitud tiene
 * menos datos que otra y permite medir qué entrada capta mejor.
 */
enum CanalDeOrigen: string
{
    case FormularioDeContacto = 'formulario-de-contacto';
    case AsistenteVirtual = 'asistente-virtual';

    public function etiqueta(): string
    {
        return match ($this) {
            self::FormularioDeContacto => 'Formulario de contacto',
            self::AsistenteVirtual => 'Asistente virtual',
        };
    }

    /**
     * Un canal es completo si recoge el perfil de la empresa. De él depende que
     * un consultor pueda preparar el diagnóstico sin volver a llamar.
     */
    public function recogePerfilDeEmpresa(): bool
    {
        return $this === self::FormularioDeContacto;
    }
}
