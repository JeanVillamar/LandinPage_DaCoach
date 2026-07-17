<?php

declare(strict_types=1);

namespace DaCoach\CasosDeExito\Infraestructura\Contenido;

use DaCoach\CasosDeExito\Dominio\CasoDeExito;
use DaCoach\CasosDeExito\Dominio\CatalogoDeCasos;

/**
 * Casos que DaCoach publica en el sitio. Equivale al antiguo
 * src/data/caseStudies.ts.
 */
final class CasosPublicados implements CatalogoDeCasos
{
    public function todos(): array
    {
        return [
            new CasoDeExito(
                'eminat-clinical-research',
                'Eminat Clinical Research',
                'Investigación clínica',
                'Optimización de procesos operativos, automatización de comunicaciones, organización de información y aplicación de inteligencia artificial en actividades de soporte.',
                'Dificultad en la gestión y clasificación manual de las consultas operativas, lo que generaba retrasos en la comunicación con el equipo y falta de trazabilidad en las solicitudes de soporte.',
                'Centralización de canales de entrada, diseño de un motor de clasificación automatizada y flujo de alertas inmediatas para el equipo clínico responsable.',
                ['Consulta o solicitud', 'Clasificación', 'Registro', 'Notificación', 'Seguimiento del equipo'],
                ['Formularios web', 'Bases de datos de soporte', 'WhatsApp corporativo', 'Gestor de tareas interno'],
                [
                    'Mejor organización interna',
                    'Mayor continuidad del proceso',
                    'Menos tareas manuales',
                    'Mayor trazabilidad de solicitudes',
                ],
            ),
            new CasoDeExito(
                'eminat-medical-center',
                'Eminat Medical Center',
                'Servicios médicos',
                'Mejora de procesos digitales, coordinación operativa, atención automatizada y conexión de herramientas utilizadas por el equipo.',
                'Falta de conexión entre las herramientas utilizadas por el personal médico y administrativo, resultando en datos fragmentados y tiempos de respuesta lentos para la orientación inicial.',
                'Integración de sistemas de registro de datos del paciente con flujos automatizados de notificación, manteniendo siempre la supervisión humana como control final del servicio médico.',
                ['Solicitud del paciente', 'Orientación', 'Registro de información', 'Coordinación', 'Atención humana'],
                ['Sistemas de registro', 'Google Workspace', 'Servicio de notificaciones', 'Panel de coordinación interna'],
                [
                    'Respuestas más rápidas',
                    'Mejor experiencia de atención',
                    'Mejor coordinación entre áreas',
                    'Mayor seguridad en el flujo de información',
                ],
            ),
            new CasoDeExito(
                'alejandro-magno-astral',
                'Alejandro Magno Astral',
                'Servicios de orientación y consultas',
                'Bot conversacional para reservación y cobro de citas, integrando atención 24/7 y pasarela de cobros simulada.',
                'Pérdida de oportunidades de reserva fuera del horario comercial debido a que la atención y coordinación de horarios se hacía 100% de forma manual por chat.',
                'Creación de un bot inteligente capaz de guiar al usuario desde el saludo inicial hasta la confirmación de la cita, conectándose dinámicamente con calendarios y pasarelas de pago.',
                [
                    'Mensaje inicial',
                    'Identificación de la necesidad',
                    'Presentación de servicios',
                    'Selección del servicio',
                    'Consulta de disponibilidad',
                    'Reservación',
                    'Enlace de pago',
                    'Confirmación',
                    'Notificación al equipo',
                    'Escalamiento humano',
                ],
                ['Bot conversacional', 'Google Calendar', 'Simulador de pasarela de pago', 'Notificaciones de Telegram/Email'],
                [
                    'Respuestas instantáneas 24/7',
                    'Menos tareas administrativas de coordinación',
                    'Proceso de reserva y confirmación sin fricciones',
                    'Mayor disponibilidad de atención',
                ],
                'Diseño de un asistente conversacional capaz de orientar al cliente, presentar los servicios disponibles, responder preguntas iniciales, seleccionar una modalidad de consulta, reservar una cita y facilitar el proceso de pago.',
                [
                    'Atención inicial automatizada.',
                    'Presentación de servicios.',
                    'Selección de modalidad.',
                    'Consulta de horarios.',
                    'Reservación de citas.',
                    'Envío de enlace de pago.',
                    'Confirmación automática.',
                    'Notificación interna.',
                    'Escalamiento a una persona.',
                    'Disponibilidad fuera del horario habitual.',
                ],
            ),
        ];
    }

    public function porId(string $id): ?CasoDeExito
    {
        foreach ($this->todos() as $caso) {
            if ($caso->id === $id) {
                return $caso;
            }
        }

        return null;
    }
}
