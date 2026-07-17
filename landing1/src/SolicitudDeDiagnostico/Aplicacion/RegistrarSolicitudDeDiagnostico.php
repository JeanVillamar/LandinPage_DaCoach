<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Aplicacion;

use DaCoach\Compartido\Dominio\Bitacora;
use DaCoach\SolicitudDeDiagnostico\Dominio\CorreoElectronico;
use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\FalloAlNotificar;
use DaCoach\SolicitudDeDiagnostico\Dominio\Industria;
use DaCoach\SolicitudDeDiagnostico\Dominio\NotificadorDeSolicitudes;
use DaCoach\SolicitudDeDiagnostico\Dominio\PerfilDeEmpresa;
use DaCoach\SolicitudDeDiagnostico\Dominio\ProcesoAMejorar;
use DaCoach\SolicitudDeDiagnostico\Dominio\RepositorioDeSolicitudes;
use DaCoach\SolicitudDeDiagnostico\Dominio\SolicitudDeDiagnostico;
use DaCoach\SolicitudDeDiagnostico\Dominio\Solicitante;
use DaCoach\SolicitudDeDiagnostico\Dominio\TamanoDeEmpresa;
use DaCoach\SolicitudDeDiagnostico\Dominio\Telefono;

/**
 * Registra una solicitud de diagnóstico, venga del formulario o del asistente.
 *
 * Es el único camino por el que nace una solicitud. Los dos canales comparten
 * este caso de uso porque el negocio es el mismo (captar y avisar); lo que
 * cambia es qué datos trae cada uno.
 */
final class RegistrarSolicitudDeDiagnostico
{
    public function __construct(
        private readonly RepositorioDeSolicitudes $repositorio,
        private readonly NotificadorDeSolicitudes $notificador,
        private readonly Bitacora $bitacora,
    ) {
    }

    /**
     * @throws \DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos
     * @throws \DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\ConsentimientoNoOtorgado
     */
    public function desdeFormulario(DatosDelFormularioDeContacto $datos): SolicitudDeDiagnostico
    {
        $solicitud = SolicitudDeDiagnostico::desdeFormularioDeContacto(
            Solicitante::crear(
                $datos->nombre,
                CorreoElectronico::desdeCadena($datos->correo),
                Telefono::desdeCadena($datos->telefono),
            ),
            PerfilDeEmpresa::crear(
                $datos->empresa,
                Industria::desdeCadena($datos->industria),
                TamanoDeEmpresa::desdeCadena($datos->tamanoDeEmpresa),
            ),
            ProcesoAMejorar::crear($datos->procesoAMejorar, $datos->herramientasActuales, $datos->mensaje),
            $datos->aceptaPrivacidad,
        );

        return $this->registrar($solicitud);
    }

    /**
     * @throws \DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos
     * @throws \DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\ConsentimientoNoOtorgado
     */
    public function desdeAsistente(DatosDelAsistenteVirtual $datos): SolicitudDeDiagnostico
    {
        $solicitud = SolicitudDeDiagnostico::desdeAsistenteVirtual(
            Solicitante::crear($datos->nombre, CorreoElectronico::desdeCadena($datos->correo)),
            ProcesoAMejorar::crear($datos->procesoAMejorar),
            $datos->aceptaPrivacidad,
        );

        return $this->registrar($solicitud);
    }

    /**
     * Guardar primero y avisar después: si el aviso falla, la solicitud ya está
     * a salvo y el equipo puede recuperarla del repositorio. Perder un lead por
     * un SMTP caído sería peor que un aviso perdido.
     */
    private function registrar(SolicitudDeDiagnostico $solicitud): SolicitudDeDiagnostico
    {
        $this->repositorio->guardar($solicitud);

        try {
            $this->notificador->avisarDeNuevaSolicitud($solicitud);
        } catch (FalloAlNotificar $fallo) {
            $this->bitacora->registrar('Solicitud guardada pero sin avisar al equipo', [
                'solicitud' => $solicitud->id->valor,
                'canal' => $solicitud->canal->value,
                'motivo' => $fallo->getMessage(),
            ]);
        }

        return $solicitud;
    }
}
