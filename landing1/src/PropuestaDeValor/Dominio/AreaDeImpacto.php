<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Dominio;

/**
 * Dimensión en la que la inteligencia artificial cambia la operación de una
 * empresa.
 */
final class AreaDeImpacto
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly string $icono,
    ) {
    }
}
