<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Aplicacion;

use DaCoach\AsistenteVirtual\Dominio\BaseDeConocimiento;
use DaCoach\AsistenteVirtual\Dominio\Consulta;
use DaCoach\AsistenteVirtual\Dominio\Respuesta;
use DaCoach\AsistenteVirtual\Dominio\Tema;

/**
 * Atiende una pregunta del visitante: clasifica de qué habla y busca qué
 * contestar sobre ese tema.
 */
final class ResponderConsulta
{
    public function __construct(private readonly BaseDeConocimiento $conocimiento)
    {
    }

    /**
     * @throws \DaCoach\AsistenteVirtual\Dominio\Excepcion\ConsultaVacia
     */
    public function __invoke(string $textoDelVisitante): Respuesta
    {
        $consulta = Consulta::desdeCadena($textoDelVisitante);

        return $this->conocimiento->responderSobre(Tema::detectarEn($consulta), $consulta);
    }
}
