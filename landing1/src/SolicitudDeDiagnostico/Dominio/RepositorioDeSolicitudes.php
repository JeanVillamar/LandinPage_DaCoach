<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

/**
 * Puerto de persistencia. El dominio no sabe si detrás hay un archivo, MySQL o
 * un CRM: sólo exige que la solicitud quede guardada.
 */
interface RepositorioDeSolicitudes
{
    public function guardar(SolicitudDeDiagnostico $solicitud): void;

    /**
     * @return list<SolicitudDeDiagnostico>
     */
    public function recibidasPorCanal(CanalDeOrigen $canal): array;
}
