<?php

declare(strict_types=1);

namespace DaCoach\SitioPublico\Dominio;

final class EnlaceDeNavegacion
{
    public function __construct(
        public readonly string $nombre,
        public readonly SeccionDelSitio $seccion,
    ) {
    }

    /**
     * Enlaces del menú principal, en el orden en que se recorre la página.
     *
     * @return list<self>
     */
    public static function menuPrincipal(): array
    {
        return [
            new self('Inicio', SeccionDelSitio::Inicio),
            new self('Inteligencia Artificial', SeccionDelSitio::InteligenciaArtificial),
            new self('Soluciones', SeccionDelSitio::Soluciones),
            new self('Casos Reales', SeccionDelSitio::Casos),
            new self('Metodología', SeccionDelSitio::Metodologia),
            new self('Nosotros', SeccionDelSitio::Nosotros),
            new self('Contacto', SeccionDelSitio::Contacto),
        ];
    }
}
