<?php

declare(strict_types=1);

namespace DaCoach\SitioPublico\Dominio;

/**
 * Cada bloque anclable de la página única.
 *
 * Centraliza los anclajes para que un enlace del menú y el id de la sección no
 * puedan desincronizarse: en la versión React eran cadenas sueltas repartidas
 * entre Navbar, Footer, App y varios componentes.
 */
enum SeccionDelSitio: string
{
    case Inicio = 'inicio';
    case InteligenciaArtificial = 'ia';
    case AntesYDespues = 'antes-despues';
    case Problemas = 'problemas';
    case Soluciones = 'soluciones';
    case Casos = 'casos';
    case EnfoqueHumano = 'enfoque-humano';
    case Metodologia = 'metodologia';
    case Beneficios = 'beneficios';
    case Industrias = 'industrias';
    case AsistenteDemo = 'asistente-demo';
    case Responsabilidad = 'responsabilidad';
    case Nosotros = 'nosotros';
    case Contacto = 'contacto';

    public function ancla(): string
    {
        return '#' . $this->value;
    }
}
