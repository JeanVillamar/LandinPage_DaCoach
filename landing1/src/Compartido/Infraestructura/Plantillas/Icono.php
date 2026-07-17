<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Plantillas;

/**
 * Referencia iconos del sprite que genera `npm run build:iconos` a partir de
 * lucide-static. Sustituye a los componentes de lucide-react.
 */
final class Icono
{
    private const SPRITE = '/assets/iconos.svg';

    public static function pintar(string $nombre, string $clases = 'w-5 h-5'): string
    {
        return sprintf(
            '<svg class="%s" aria-hidden="true" focusable="false"><use href="%s#%s"></use></svg>',
            Plantilla::escapar($clases),
            self::SPRITE,
            Plantilla::escapar($nombre),
        );
    }
}
