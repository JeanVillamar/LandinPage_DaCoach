<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Infraestructura\Conocimiento;

use DaCoach\AsistenteVirtual\Dominio\BaseDeConocimiento;
use DaCoach\AsistenteVirtual\Dominio\Consulta;
use DaCoach\AsistenteVirtual\Dominio\Respuesta;
use DaCoach\AsistenteVirtual\Dominio\Tema;

/**
 * Guion escrito por el equipo de DaCoach: una respuesta fija por tema.
 *
 * Es contenido editorial, no lógica, y por eso vive en infraestructura. La
 * conversación es una demostración: no hay modelo de lenguaje detrás y las
 * respuestas no dependen de lo que se dijo antes.
 */
final class GuionDeRespuestas implements BaseDeConocimiento
{
    public function responderSobre(Tema $tema, Consulta $consulta): Respuesta
    {
        return match ($tema) {
            Tema::Automatizacion => Respuesta::sobre(
                $tema,
                'En DaCoach podemos automatizar tareas administrativas, clasificación y registro de solicitudes, sincronización de información entre sistemas (como CRMs y hojas de cálculo), y recordatorios automáticos de seguimiento.',
                ['¿Pueden integrar WhatsApp?', '¿Cómo comienza un proyecto?'],
            ),
            Tema::BeneficiosDeLaIa => Respuesta::sobre(
                $tema,
                'La IA ayuda a tu empresa al reducir errores manuales, acelerar los tiempos de respuesta al cliente, centralizar datos que antes estaban dispersos y liberar a tu equipo de tareas repetitivas para que se enfoquen en lo estratégico.',
                ['¿Qué procesos puedo automatizar?', 'Quiero solicitar un diagnóstico'],
            ),
            Tema::TamanoDeEmpresa => Respuesta::sobre(
                $tema,
                '¡Por supuesto! Trabajamos con pequeñas, medianas y grandes empresas. Adaptamos la tecnología y el alcance del proyecto al tamaño actual de tu operación y a tus metas de crecimiento.',
                ['¿Cómo comienza un proyecto?', 'Quiero solicitar un diagnóstico'],
            ),
            Tema::Integraciones => Respuesta::sobre(
                $tema,
                'Sí, conectamos canales de comunicación como WhatsApp, Telegram y correo electrónico con tus herramientas de negocio diarias, incluyendo Google Calendar, CRMs, hojas de cálculo y bases de datos.',
                ['¿Cómo comienza un proyecto?', 'Quiero solicitar un diagnóstico'],
            ),
            Tema::Metodologia => Respuesta::sobre(
                $tema,
                'Comenzamos con una fase de Descubrimiento para entender tu negocio, seguido por un Diagnóstico detallado donde identificamos las oportunidades específicas de optimización antes de escribir código.',
                ['¿Qué diferencia a DaCoach?', 'Quiero solicitar un diagnóstico'],
            ),
            Tema::Diferenciador => Respuesta::sobre(
                $tema,
                'Nos diferencia nuestro enfoque estratégico, humano y responsable. No imponemos herramientas; primero analizamos tu proceso y luego diseñamos la solución, asegurando capacitación y acompañamiento al equipo.',
                ['¿Qué procesos puedo automatizar?', 'Quiero solicitar un diagnóstico'],
            ),
            Tema::Diagnostico => Respuesta::sobre(
                $tema,
                'Perfecto. Para solicitar tu diagnóstico personalizado, completa el breve formulario que ha aparecido en el panel lateral. Un consultor humano revisará tu operación y se pondrá en contacto contigo.',
                ['¿Cómo comienza un proyecto?'],
            ),
            Tema::Presentacion => Respuesta::sobre(
                $tema,
                'Hola. Soy el asistente inteligente de DaCoach. Ayudo a las empresas a optimizar operaciones y conectar sistemas mediante inteligencia artificial. ¿En qué puedo orientarte hoy?',
                [
                    '¿Qué procesos puedo automatizar?',
                    '¿Pueden integrar WhatsApp y calendarios?',
                    'Quiero solicitar un diagnóstico',
                ],
            ),
        };
    }
}
