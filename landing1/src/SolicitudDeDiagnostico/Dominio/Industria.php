<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * Sectores en los que DaCoach presta servicio. Es la lista que el visitante ve
 * en el desplegable del formulario, pero aquí es un tipo cerrado del dominio.
 */
enum Industria: string
{
    case SaludYBienestar = 'salud-y-bienestar';
    case InvestigacionClinica = 'investigacion-clinica';
    case ServiciosProfesionales = 'servicios-profesionales';
    case Consultorias = 'consultorias';
    case ComercioYVentas = 'comercio-y-ventas';
    case AtencionAlCliente = 'atencion-al-cliente';
    case Educacion = 'educacion';
    case Otra = 'otra';

    public static function desdeCadena(string $valor): self
    {
        $industria = self::tryFrom(trim($valor));

        if ($industria === null) {
            throw DatosDeSolicitudInvalidos::porFormato('industria');
        }

        return $industria;
    }

    public function etiqueta(): string
    {
        return match ($this) {
            self::SaludYBienestar => 'Salud y Bienestar',
            self::InvestigacionClinica => 'Investigación Clínica',
            self::ServiciosProfesionales => 'Servicios Profesionales',
            self::Consultorias => 'Consultorías',
            self::ComercioYVentas => 'Comercio y Ventas',
            self::AtencionAlCliente => 'Atención al Cliente',
            self::Educacion => 'Educación',
            self::Otra => 'Otro',
        };
    }
}
