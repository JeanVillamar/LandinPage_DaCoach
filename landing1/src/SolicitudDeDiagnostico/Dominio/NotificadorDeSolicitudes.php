<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

/**
 * Puerto de aviso al equipo comercial.
 *
 * Un fallo al notificar no puede perder la solicitud ya guardada: quien
 * implemente este puerto debe lanzar FalloAlNotificar y dejar que el caso de uso
 * decida (ver RegistrarSolicitudDeDiagnostico).
 */
interface NotificadorDeSolicitudes
{
    public function avisarDeNuevaSolicitud(SolicitudDeDiagnostico $solicitud): void;
}
