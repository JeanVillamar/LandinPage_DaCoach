<?php

declare(strict_types=1);

namespace DaCoach\MetodologiaDeTrabajo\Dominio;

/**
 * Cómo trabaja DaCoach con las personas que conocen el proceso. Es el
 * compromiso que sostiene "tecnología integrada, personas al mando".
 */
final class PrincipioDeColaboracion
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly string $icono,
    ) {
    }
}
