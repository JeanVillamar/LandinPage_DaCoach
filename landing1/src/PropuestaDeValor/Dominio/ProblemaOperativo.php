<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Dominio;

/**
 * Un dolor concreto de la operación junto con la solución que DaCoach le opone.
 *
 * Problema y solución viven juntos a propósito: DaCoach no vende tecnología
 * suelta, sólo la respuesta a una fricción identificada.
 */
final class ProblemaOperativo
{
    public function __construct(
        public readonly string $problema,
        public readonly string $sintoma,
        public readonly string $solucion,
        public readonly string $comoSeResuelve,
    ) {
    }
}
