<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido;

use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeServicios;
use DaCoach\CatalogoDeSoluciones\Dominio\Relevancia;
use DaCoach\CatalogoDeSoluciones\Dominio\Servicio;

/**
 * Catálogo escrito en código: lo edita el equipo de DaCoach, no un usuario.
 * Equivale al antiguo src/data/services.ts.
 */
final class ServiciosDeDaCoach implements CatalogoDeServicios
{
    public function todos(): array
    {
        return [
            new Servicio(
                'consultoria',
                'Consultoría Estratégica en Inteligencia Artificial',
                'Analizamos los procesos, objetivos y necesidades de la empresa para identificar oportunidades concretas de implementación.',
                [
                    'Evaluación de procesos actuales.',
                    'Identificación de tareas repetitivas.',
                    'Priorización según impacto y viabilidad.',
                    'Diseño de una ruta de adopción tecnológica.',
                ],
                Relevancia::Principal,
                'brain',
            ),
            new Servicio(
                'automatizacion',
                'Automatización de Procesos',
                'Diseñamos flujos de trabajo que reducen tareas manuales, errores y tiempos de respuesta.',
                [
                    'Registro y clasificación de solicitudes.',
                    'Notificaciones y recordatorios.',
                    'Actualización de bases de datos.',
                    'Generación de reportes.',
                    'Coordinación interna.',
                ],
                Relevancia::Ampliada,
                'refresh-cw',
            ),
            new Servicio(
                'bots',
                'Bots y Asistentes Inteligentes',
                'Creamos asistentes conversacionales para atención, orientación, captación y soporte de procesos internos o externos.',
                [
                    'Preguntas frecuentes.',
                    'Captación de prospectos.',
                    'Clasificación de solicitudes.',
                    'Atención fuera del horario laboral.',
                    'Escalamiento a personal humano.',
                ],
                Relevancia::Estandar,
                'message-square',
            ),
            new Servicio(
                'integracion',
                'Integración de Canales y Sistemas',
                'Conectamos los canales de comunicación con las herramientas operativas del negocio.',
                [
                    'WhatsApp y Telegram.',
                    'Correo electrónico.',
                    'Calendarios y formularios.',
                    'Hojas de cálculo y bases de datos.',
                    'CRMs y Google Workspace.',
                ],
                Relevancia::Principal,
                'cable',
            ),
            new Servicio(
                'atencion-247',
                'Atención Automatizada 24/7',
                'Implementamos soluciones para recibir, orientar, clasificar y registrar solicitudes en cualquier momento.',
                [
                    'Respuesta inicial inmediata.',
                    'Registro de información autorizada.',
                    'Clasificación de consultas.',
                    'Notificación al equipo responsable.',
                ],
                Relevancia::Estandar,
                'clock',
            ),
            new Servicio(
                'optimizacion',
                'Optimización Operativa Interna',
                'Mejoramos la coordinación, el seguimiento y la organización entre áreas.',
                [
                    'Estandarización de procesos.',
                    'Centralización de información.',
                    'Seguimiento de tareas.',
                    'Indicadores operativos.',
                    'Reportes y alertas.',
                ],
                Relevancia::Estandar,
                'trending-up',
            ),
            new Servicio(
                'personalizadas',
                'Soluciones Personalizadas',
                'Desarrollamos soluciones adaptadas a objetivos y necesidades específicas de tu sector.',
                [
                    'Agentes inteligentes.',
                    'Aplicaciones internas.',
                    'Paneles de control.',
                    'Sistemas de alertas.',
                    'Flujos de aprobación.',
                    'Integraciones sectoriales.',
                ],
                Relevancia::Principal,
                'settings-2',
            ),
        ];
    }
}
