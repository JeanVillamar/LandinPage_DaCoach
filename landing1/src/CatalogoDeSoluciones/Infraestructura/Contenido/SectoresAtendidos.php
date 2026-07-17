<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido;

use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeSectores;
use DaCoach\CatalogoDeSoluciones\Dominio\Sector;

final class SectoresAtendidos implements CatalogoDeSectores
{
    public function todos(): array
    {
        return [
            new Sector(
                'Salud y bienestar',
                ['Registro de solicitudes', 'Coordinación de pacientes', 'Recordatorios automáticos'],
                'stethoscope',
            ),
            new Sector(
                'Investigación clínica',
                ['Seguimiento operativo', 'Organización de información', 'Notificaciones de protocolo'],
                'flask-conical',
            ),
            new Sector(
                'Servicios profesionales',
                ['Gestión de expedientes', 'Asignación de tareas', 'Control de plazos'],
                'scale',
            ),
            new Sector(
                'Consultorías',
                ['Recopilación de requisitos', 'Generación de informes', 'Coordinación interna'],
                'file-text',
            ),
            new Sector(
                'Comercio y ventas',
                ['Atención posventa', 'Registro de leads', 'Seguimiento de compras'],
                'shopping-bag',
            ),
            new Sector(
                'Atención al cliente',
                ['Respuestas rápidas 24/7', 'Clasificación de reclamos', 'Escalamiento de soporte'],
                'headphones',
            ),
            new Sector(
                'Educación y capacitación',
                ['Inscripciones automatizadas', 'Envío de materiales', 'Alertas de cursos'],
                'book-open',
            ),
            new Sector(
                'Citas y reservaciones',
                ['Consulta de horarios', 'Reserva de cupos', 'Recordatorios y enlaces de pago'],
                'calendar',
            ),
            new Sector(
                'Equipos distribuidos',
                ['Coordinación remota', 'Sincronización de tareas', 'Reportes de avance'],
                'users',
            ),
            new Sector(
                'Pequeñas y medianas empresas',
                ['Optimización de recursos', 'Bandejas unificadas', 'Escalabilidad del negocio'],
                'building',
            ),
        ];
    }
}
