<?php

declare(strict_types=1);

namespace DaCoach\MetodologiaDeTrabajo\Dominio;

/**
 * Una de las fases por las que pasa todo proyecto de DaCoach.
 */
final class FaseDeTrabajo
{
    public function __construct(
        public readonly int $numero,
        public readonly string $titulo,
        public readonly string $descripcion,
    ) {
    }

    public function numeroConCero(): string
    {
        return str_pad((string) $this->numero, 2, '0', STR_PAD_LEFT);
    }
}
