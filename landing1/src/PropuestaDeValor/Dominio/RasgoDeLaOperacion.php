<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Dominio;

/**
 * Cómo se comporta una operación antes o después de intervenirla. Alimenta la
 * comparativa "de lo manual a lo inteligente".
 */
final class RasgoDeLaOperacion
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $detalle,
    ) {
    }
}
