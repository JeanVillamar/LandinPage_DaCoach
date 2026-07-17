<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Infraestructura\Web;

use DaCoach\Compartido\Infraestructura\Web\Peticion;
use DaCoach\Compartido\Infraestructura\Web\Respuesta;
use DaCoach\Compartido\Infraestructura\Web\Sesion;
use DaCoach\SolicitudDeDiagnostico\Aplicacion\DatosDelAsistenteVirtual;
use DaCoach\SolicitudDeDiagnostico\Aplicacion\DatosDelFormularioDeContacto;
use DaCoach\SolicitudDeDiagnostico\Aplicacion\RegistrarSolicitudDeDiagnostico;
use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\ConsentimientoNoOtorgado;
use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;
use DaCoach\SolicitudDeDiagnostico\Dominio\SolicitudDeDiagnostico;

/**
 * Entrada HTTP de las solicitudes de diagnóstico.
 *
 * El formulario funciona sin JavaScript: se envía, se guarda y se redirige
 * (POST-Redirect-GET), y el resultado viaja como aviso de sesión. Si la petición
 * llega en JSON —el asistente— se responde en JSON.
 */
final class ControladorDeSolicitudes
{
    public const AVISO = 'solicitud-de-diagnostico';

    public function __construct(
        private readonly RegistrarSolicitudDeDiagnostico $registrar,
        private readonly Sesion $sesion,
    ) {
    }

    public function desdeFormulario(Peticion $peticion): Respuesta
    {
        try {
            $solicitud = $this->registrar->desdeFormulario(new DatosDelFormularioDeContacto(
                $peticion->texto('nombre'),
                $peticion->texto('empresa'),
                $peticion->texto('correo'),
                $peticion->texto('telefono'),
                $peticion->texto('industria'),
                $peticion->texto('tamanoDeEmpresa'),
                $peticion->texto('procesoAMejorar'),
                $peticion->texto('herramientasActuales'),
                $peticion->texto('mensaje'),
                $peticion->booleano('aceptaPrivacidad'),
            ));

            return $this->exito($peticion, $solicitud);
        } catch (DatosDeSolicitudInvalidos | ConsentimientoNoOtorgado $error) {
            return $this->fallo($peticion, $error->getMessage());
        }
    }

    public function desdeAsistente(Peticion $peticion): Respuesta
    {
        try {
            $solicitud = $this->registrar->desdeAsistente(new DatosDelAsistenteVirtual(
                $peticion->texto('nombre'),
                $peticion->texto('correo'),
                $peticion->texto('procesoAMejorar'),
                $peticion->booleano('aceptaPrivacidad'),
            ));

            return $this->exito($peticion, $solicitud);
        } catch (DatosDeSolicitudInvalidos | ConsentimientoNoOtorgado $error) {
            return $this->fallo($peticion, $error->getMessage());
        }
    }

    private function exito(Peticion $peticion, SolicitudDeDiagnostico $solicitud): Respuesta
    {
        $mensaje = sprintf(
            '¡Gracias %s! Hemos registrado tu solicitud. Un consultor de DaCoach revisará la descripción de tus procesos y se pondrá en contacto contigo en breve.',
            $solicitud->solicitante->nombreDePila(),
        );

        if ($peticion->esJson()) {
            return Respuesta::json([
                'exito' => true,
                'mensaje' => $mensaje,
                'solicitud' => $solicitud->id->valor,
            ]);
        }

        $this->sesion->guardarAviso(self::AVISO, ['exito' => true, 'mensaje' => $mensaje]);

        return Respuesta::redireccion('/#contacto');
    }

    private function fallo(Peticion $peticion, string $mensaje): Respuesta
    {
        if ($peticion->esJson()) {
            return Respuesta::json(['exito' => false, 'mensaje' => $mensaje], 422);
        }

        $this->sesion->guardarAviso(self::AVISO, ['exito' => false, 'mensaje' => $mensaje]);

        return Respuesta::redireccion('/#contacto');
    }
}
