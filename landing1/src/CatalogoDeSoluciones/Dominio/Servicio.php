<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

/**
 * Un servicio que DaCoach vende.
 */
final class Servicio
{
    /**
     * @param list<string> $capacidades Lo que el servicio hace en concreto.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly array $capacidades,
        public readonly Relevancia $relevancia,
        public readonly string $icono,
    ) {
    }
}
