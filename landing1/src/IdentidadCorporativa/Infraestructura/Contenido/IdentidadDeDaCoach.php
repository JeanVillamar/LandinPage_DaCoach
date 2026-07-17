<?php

declare(strict_types=1);

namespace DaCoach\IdentidadCorporativa\Infraestructura\Contenido;

use DaCoach\IdentidadCorporativa\Dominio\Identidad;
use DaCoach\IdentidadCorporativa\Dominio\ValorCorporativo;

final class IdentidadDeDaCoach implements Identidad
{
    public function valores(): array
    {
        return [
            new ValorCorporativo(
                '01',
                'Enfoque humano',
                'Diseñamos soluciones tecnológicas pensando siempre en facilitar el trabajo diario de las personas.',
                'heart',
            ),
            new ValorCorporativo(
                '02',
                'Utilidad real',
                'Evitamos implementar tendencias innecesarias; nos enfocamos exclusivamente en resolver ineficiencias concretas.',
                'compass',
            ),
            new ValorCorporativo(
                '03',
                'Integración práctica',
                'Conectamos tus sistemas actuales en lugar de obligar a tu equipo a adaptarse a interfaces nuevas y complejas.',
                'cpu',
            ),
            new ValorCorporativo(
                '04',
                'Acompañamiento',
                'Apoyamos a tu equipo en cada etapa de la adopción tecnológica para asegurar un dominio y continuidad exitosa.',
                'handshake',
            ),
            new ValorCorporativo(
                '05',
                'Escalabilidad',
                'Estructuramos flujos de información robustos que soportan y aceleran el ritmo de crecimiento de tu empresa.',
                'trending-up',
            ),
        ];
    }

    public function compromiso(): string
    {
        return '“La tecnología genera valor real cuando mejora una operación, apoya a las personas y produce resultados concretos.”';
    }

    public function lema(): string
    {
        return 'Tecnología con estrategia, propósito y acompañamiento humano.';
    }
}
