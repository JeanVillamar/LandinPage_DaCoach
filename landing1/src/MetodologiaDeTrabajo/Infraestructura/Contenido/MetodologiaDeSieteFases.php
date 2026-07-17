<?php

declare(strict_types=1);

namespace DaCoach\MetodologiaDeTrabajo\Infraestructura\Contenido;

use DaCoach\MetodologiaDeTrabajo\Dominio\FaseDeTrabajo;
use DaCoach\MetodologiaDeTrabajo\Dominio\Metodologia;
use DaCoach\MetodologiaDeTrabajo\Dominio\PrincipioDeColaboracion;

/**
 * La metodología que DaCoach aplica en todos sus proyectos. Equivale al antiguo
 * src/data/methodology.ts.
 */
final class MetodologiaDeSieteFases implements Metodologia
{
    public function fases(): array
    {
        return [
            new FaseDeTrabajo(1, 'Descubrimiento', 'Comprendemos la empresa, sus objetivos, procesos y desafíos de negocio.'),
            new FaseDeTrabajo(2, 'Diagnóstico', 'Identificamos oportunidades de mejora, automatización e integración tecnológica.'),
            new FaseDeTrabajo(3, 'Diseño', 'Definimos la arquitectura, las herramientas, los flujos y los resultados esperados.'),
            new FaseDeTrabajo(4, 'Implementación', 'Configuramos, integramos o desarrollamos la solución y realizamos pruebas.'),
            new FaseDeTrabajo(5, 'Validación', 'Revisamos la solución junto con el cliente antes de su uso operativo formal.'),
            new FaseDeTrabajo(6, 'Capacitación', 'Preparamos a los usuarios y responsables de supervisar y operar la solución.'),
            new FaseDeTrabajo(7, 'Optimización', 'Medimos el desempeño, detectamos mejoras y aplicamos ajustes cuando sea necesario.'),
        ];
    }

    public function primeraFase(): FaseDeTrabajo
    {
        return $this->fases()[0];
    }

    /**
     * @return list<PrincipioDeColaboracion>
     */
    public function principiosDeColaboracion(): array
    {
        return [
            new PrincipioDeColaboracion(
                'Cocreación',
                'Las personas que conocen el proceso participan activamente en el diseño de la solución final.',
                'users',
            ),
            new PrincipioDeColaboracion(
                'Capacitación',
                'Preparamos al equipo completo para utilizar, comprender y supervisar la tecnología con confianza.',
                'graduation-cap',
            ),
            new PrincipioDeColaboracion(
                'Supervisión humana',
                'Definimos límites claros: cuándo el sistema puede actuar y en qué momentos debe intervenir una persona.',
                'eye',
            ),
            new PrincipioDeColaboracion(
                'Adopción progresiva',
                'Implementamos cambios de forma comprensible, responsable y alineada con la realidad del negocio.',
                'compass',
            ),
        ];
    }
}
