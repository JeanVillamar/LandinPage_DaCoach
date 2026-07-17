<?php

declare(strict_types=1);

namespace DaCoach\IdentidadCorporativa\Dominio;

/**
 * Uno de los valores con los que DaCoach se compromete ante un cliente.
 */
final class ValorCorporativo
{
    public function __construct(
        public readonly string $numero,
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly string $icono,
    ) {
    }
}
