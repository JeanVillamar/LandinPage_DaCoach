<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Dominio;

/**
 * Un paso del flujo que DaCoach muestra animado en la portada, desde que entra
 * una solicitud hasta que se resuelve.
 *
 * La supervisión humana es un paso más y se marca como tal: es el argumento
 * central del discurso de la empresa, no un adorno del final.
 */
final class PasoDelFlujoInteligente
{
    public function __construct(
        public readonly string $etiqueta,
        public readonly string $descripcion,
        public readonly string $icono,
        public readonly bool $esSupervisionHumana = false,
    ) {
    }
}
