<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Infraestructura\Notificacion;

use DaCoach\Compartido\Dominio\Bitacora;
use DaCoach\SolicitudDeDiagnostico\Dominio\NotificadorDeSolicitudes;
use DaCoach\SolicitudDeDiagnostico\Dominio\SolicitudDeDiagnostico;

/**
 * Deja constancia del aviso en la bitácora en lugar de enviarlo.
 *
 * Es el adaptador por defecto hasta que se elija el canal real (correo al equipo
 * comercial, WhatsApp o CRM). Sustituirlo es implementar NotificadorDeSolicitudes
 * y cambiar el cableado en public/index.php.
 */
final class NotificadorEnBitacora implements NotificadorDeSolicitudes
{
    public function __construct(private readonly Bitacora $bitacora)
    {
    }

    public function avisarDeNuevaSolicitud(SolicitudDeDiagnostico $solicitud): void
    {
        $this->bitacora->registrar('Nueva solicitud de diagnóstico', [
            'solicitud' => $solicitud->id->valor,
            'canal' => $solicitud->canal->etiqueta(),
            'resumen' => $solicitud->resumenParaElEquipo(),
            'requiereContactoPrevio' => $solicitud->requiereContactoPrevio(),
        ]);
    }
}
