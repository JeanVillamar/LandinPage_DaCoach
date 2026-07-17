<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Infraestructura\Contenido;

use DaCoach\PropuestaDeValor\Dominio\AreaDeImpacto;
use DaCoach\PropuestaDeValor\Dominio\DiscursoDeValor;
use DaCoach\PropuestaDeValor\Dominio\PasoDelFlujoInteligente;
use DaCoach\PropuestaDeValor\Dominio\ProblemaOperativo;
use DaCoach\PropuestaDeValor\Dominio\RasgoDeLaOperacion;

final class ArgumentarioDeDaCoach implements DiscursoDeValor
{
    public function flujoInteligente(): array
    {
        return [
            new PasoDelFlujoInteligente(
                'Entrada de solicitud',
                'Se reciben correos, chats o formularios automáticamente.',
                'message-square',
            ),
            new PasoDelFlujoInteligente(
                'Análisis inteligente',
                'La IA analiza el contenido y detecta la intención.',
                'cpu',
            ),
            new PasoDelFlujoInteligente(
                'Clasificación',
                'Se categoriza y asigna al departamento correcto.',
                'filter',
            ),
            new PasoDelFlujoInteligente(
                'Automatización',
                'Se ejecutan reglas y flujos de trabajo programados.',
                'sparkles',
            ),
            new PasoDelFlujoInteligente(
                'Acción del sistema',
                'Se actualiza el CRM, se crean citas o envían correos.',
                'database',
            ),
            new PasoDelFlujoInteligente(
                'Resultado',
                'La tarea se completa de inmediato sin retrasos.',
                'circle-check-big',
            ),
            new PasoDelFlujoInteligente(
                'Supervisión humana',
                'Un supervisor aprueba los casos excepcionales o sensibles.',
                'user-check',
                esSupervisionHumana: true,
            ),
        ];
    }

    public function areasDeImpacto(): array
    {
        return [
            new AreaDeImpacto(
                'Velocidad',
                'Automatiza respuestas, clasificaciones, notificaciones y tareas que antes dependían de procesos manuales lentos.',
                'zap',
            ),
            new AreaDeImpacto(
                'Productividad',
                'Reduce cargas administrativas pesadas para que los equipos puedan concentrarse en actividades que de verdad aporten valor.',
                'target',
            ),
            new AreaDeImpacto(
                'Organización',
                'Conecta información dispersa entre múltiples plataformas y crea procesos con una trazabilidad completa.',
                'folder-git',
            ),
            new AreaDeImpacto(
                'Disponibilidad',
                'Permite atender, orientar y registrar solicitudes fuera del horario comercial habitual de forma ininterrumpida.',
                'clock',
            ),
            new AreaDeImpacto(
                'Escalabilidad',
                'Diseña procesos eficientes que pueden crecer de volumen sin aumentar innecesariamente la complejidad o coste operativo.',
                'chart-line',
            ),
        ];
    }

    public function problemasOperativos(): array
    {
        return [
            new ProblemaOperativo(
                'Tareas manuales y repetitivas',
                'Tu equipo pasa horas copiando datos, enviando recordatorios o rellenando hojas de cálculo.',
                'Automatización de flujos de trabajo',
                'Eliminamos la intervención humana en tareas de bajo valor mediante automatizaciones en segundo plano.',
            ),
            new ProblemaOperativo(
                'Información dispersa entre plataformas',
                'Los datos de clientes están divididos en diferentes correos, WhatsApp y CRMs inconexos.',
                'Integración centralizada de sistemas',
                'Conectamos todas tus herramientas para que la información fluya automáticamente de un sistema a otro.',
            ),
            new ProblemaOperativo(
                'Respuestas lentas a clientes',
                'Los clientes esperan horas o días para recibir una cotización o respuesta básica sobre tu servicio.',
                'Asistentes conversacionales inteligentes',
                'Implementamos bots capaces de responder consultas recurrentes y captar prospectos al instante.',
            ),
            new ProblemaOperativo(
                'Falta de seguimiento de leads',
                'Las solicitudes entrantes se pierden en bandejas de entrada sin asignar y sin alertas de retraso.',
                'Asignación y notificación automática',
                'La IA clasifica la solicitud, la registra en tu CRM y notifica inmediatamente al responsable.',
            ),
            new ProblemaOperativo(
                'Errores por procesos manuales',
                'La transcripción manual de datos genera equivocaciones en facturas, citas o registros de clientes.',
                'Validación e inserción directa',
                'El sistema valida y registra los datos de forma exacta e integrada directamente en tus bases de datos.',
            ),
            new ProblemaOperativo(
                'Dificultad para medir o escalar',
                'No hay informes fiables ni visibilidad del rendimiento porque los reportes se preparan a mano.',
                'Reportes y paneles automatizados',
                'Creamos paneles interactivos en tiempo real para evaluar el desempeño de la operación al instante.',
            ),
        ];
    }

    public function operacionManual(): array
    {
        return [
            new RasgoDeLaOperacion('Mensajes recibidos en diferentes canales dispersos.', 'Emails, chats y llamadas sin control central.'),
            new RasgoDeLaOperacion('Información copiada manualmente a mano.', 'Errores al transcribir datos de una app a otra.'),
            new RasgoDeLaOperacion('Solicitudes sin clasificar por prioridad.', 'Bandejas llenas sin saber qué es urgente.'),
            new RasgoDeLaOperacion('Seguimientos de clientes olvidados.', 'Oportunidades que se pierden por falta de respuesta.'),
            new RasgoDeLaOperacion('Reportes preparados manualmente a fin de mes.', 'Horas perdidas buscando datos en Excel.'),
            new RasgoDeLaOperacion('Respuestas lentas de varios días.', 'Clientes frustrados por la demora.'),
            new RasgoDeLaOperacion('Dificultad absoluta para medir resultados.', 'Sin métricas reales del rendimiento del equipo.'),
        ];
    }

    public function operacionInteligente(): array
    {
        return [
            new RasgoDeLaOperacion('Solicitudes centralizadas en una sola bandeja.', 'Toda la comunicación unificada automáticamente.'),
            new RasgoDeLaOperacion('Clasificación automática mediante IA.', 'El sistema clasifica el motivo e importancia al instante.'),
            new RasgoDeLaOperacion('Información registrada de inmediato.', 'Sincronización en tiempo real sin intervención humana.'),
            new RasgoDeLaOperacion('Notificaciones inmediatas al equipo.', 'Alertas en canales internos en segundos.'),
            new RasgoDeLaOperacion('Seguimiento organizado paso a paso.', 'Flujos claros con responsables asignados.'),
            new RasgoDeLaOperacion('Reportes automáticos y en tiempo real.', 'Paneles de control accesibles en un clic.'),
            new RasgoDeLaOperacion('Escalamiento a una persona cuando se requiere.', 'El equipo interviene solo en los casos complejos.'),
        ];
    }
}
