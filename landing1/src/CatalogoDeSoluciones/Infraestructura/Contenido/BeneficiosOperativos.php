<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido;

use DaCoach\CatalogoDeSoluciones\Dominio\Beneficio;
use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeBeneficios;

final class BeneficiosOperativos implements CatalogoDeBeneficios
{
    public function todos(): array
    {
        return [
            new Beneficio('Menos tareas repetitivas', 'Liberación de tiempo', 'zap'),
            new Beneficio('Respuestas más rápidas', 'Atención instantánea', 'clock'),
            new Beneficio('Mayor organización', 'Información centralizada', 'folder-git'),
            new Beneficio('Mejor trazabilidad', 'Control del proceso', 'eye'),
            new Beneficio('Menos errores operativos', 'Precisión de datos', 'circle-check-big'),
            new Beneficio('Mejor coordinación interna', 'Equipos conectados', 'git-pull-request'),
            new Beneficio('Mayor disponibilidad de atención', 'Atención 24/7', 'clock'),
            new Beneficio('Procesos consistentes', 'Estandarización', 'shield-check'),
            new Beneficio('Operaciones más escalables', 'Crecimiento estructurado', 'scaling'),
            new Beneficio('Mejor experiencia de usuario', 'Satisfacción garantizada', 'heart-handshake'),
        ];
    }
}
