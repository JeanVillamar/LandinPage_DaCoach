<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Infraestructura\Web;

use DaCoach\AsistenteVirtual\Aplicacion\ResponderConsulta;
use DaCoach\AsistenteVirtual\Dominio\AccionSugerida;
use DaCoach\AsistenteVirtual\Dominio\Excepcion\ConsultaVacia;
use DaCoach\Compartido\Infraestructura\Web\Peticion;
use DaCoach\Compartido\Infraestructura\Web\Respuesta;

/**
 * Endpoint del asistente. Responde siempre en JSON: es la única parte del sitio
 * que necesita JavaScript por naturaleza.
 */
final class ControladorDelAsistente
{
    public function __construct(private readonly ResponderConsulta $responder)
    {
    }

    public function __invoke(Peticion $peticion): Respuesta
    {
        try {
            $respuesta = ($this->responder)($peticion->texto('mensaje'));
        } catch (ConsultaVacia $error) {
            return Respuesta::json(['error' => $error->getMessage()], 422);
        }

        return Respuesta::json([
            'tema' => $respuesta->tema->value,
            'respuesta' => $respuesta->texto,
            'accionesSugeridas' => array_map(
                static fn (AccionSugerida $accion): string => $accion->texto,
                $respuesta->accionesSugeridas,
            ),
            'abreSolicitudDeDiagnostico' => $respuesta->abreSolicitudDeDiagnostico(),
        ]);
    }
}
