<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

/**
 * Sector de actividad al que DaCoach presta servicio, con los procesos típicos
 * que suele optimizar en él.
 *
 * `icono` es una etiqueta semántica del contenido (qué representa el sector); el
 * color con el que se pinta lo decide la vista.
 */
final class Sector
{
    /**
     * @param list<string> $procesosAOptimizar
     */
    public function __construct(
        public readonly string $titulo,
        public readonly array $procesosAOptimizar,
        public readonly string $icono,
    ) {
    }
}
