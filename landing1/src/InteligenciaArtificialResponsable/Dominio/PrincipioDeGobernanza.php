<?php

declare(strict_types=1);

namespace DaCoach\InteligenciaArtificialResponsable\Dominio;

/**
 * Una regla que DaCoach se impone al automatizar. Es lo que hace que la
 * automatización sea predecible, segura y reversible.
 */
final class PrincipioDeGobernanza
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly string $icono,
    ) {
    }
}
