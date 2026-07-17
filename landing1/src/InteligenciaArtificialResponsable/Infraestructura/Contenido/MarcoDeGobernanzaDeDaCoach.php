<?php

declare(strict_types=1);

namespace DaCoach\InteligenciaArtificialResponsable\Infraestructura\Contenido;

use DaCoach\InteligenciaArtificialResponsable\Dominio\MarcoDeGobernanza;
use DaCoach\InteligenciaArtificialResponsable\Dominio\PrincipioDeGobernanza;

final class MarcoDeGobernanzaDeDaCoach implements MarcoDeGobernanza
{
    public function principios(): array
    {
        return [
            new PrincipioDeGobernanza(
                'Alcance claramente definido',
                'Acotamos la acción del sistema para que opere exclusivamente dentro de los límites e instrucciones aprobados.',
                'shield',
            ),
            new PrincipioDeGobernanza(
                'Permisos según responsabilidades',
                'El acceso a la información se asigna bajo políticas estrictas, limitando el uso a los roles autorizados.',
                'key',
            ),
            new PrincipioDeGobernanza(
                'Supervisión humana',
                'Definimos flujos de validación donde un miembro del equipo supervisa y aprueba el resultado final de la tarea.',
                'eye',
            ),
            new PrincipioDeGobernanza(
                'Manejo de excepciones',
                'Cuando el sistema encuentra un caso complejo o fuera del estándar, detiene la acción y alerta al responsable.',
                'circle-alert',
            ),
            new PrincipioDeGobernanza(
                'Protección de datos',
                'Implementamos cifrado y buenas prácticas de seguridad de la información en todas las integraciones.',
                'database',
            ),
            new PrincipioDeGobernanza(
                'Registro de acciones',
                'Cada flujo ejecutado por la inteligencia artificial genera un log auditable con detalles de la operación.',
                'file-spreadsheet',
            ),
            new PrincipioDeGobernanza(
                'Escalamiento de casos sensibles',
                'Las solicitudes que requieren criterio, confidencialidad o empatía se derivan de inmediato a un agente humano.',
                'heart-handshake',
            ),
            new PrincipioDeGobernanza(
                'Validación antes de la operación',
                'Sometemos cada sistema a fases rigurosas de pruebas conjuntas en entornos controlados antes de ponerlo en producción.',
                'file-search',
            ),
        ];
    }
}
