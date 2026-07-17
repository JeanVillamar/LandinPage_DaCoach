<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

/**
 * Resultado operativo que nota el cliente. Sin métricas inventadas: DaCoach
 * comunica el impacto en cualitativo.
 */
final class Beneficio
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $palabraClave,
        public readonly string $icono,
    ) {
    }
}
