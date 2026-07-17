<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\DatosDeSolicitudInvalidos;

/**
 * Tramo de plantilla de la empresa. Condiciona el alcance que un consultor
 * propone en el diagnóstico, por eso es un tipo del dominio y no texto libre.
 */
enum TamanoDeEmpresa: string
{
    case Microempresa = '1-9';
    case Pequena = '10-49';
    case Mediana = '50-249';
    case Grande = '250+';

    public static function desdeCadena(string $valor): self
    {
        $tamano = self::tryFrom(trim($valor));

        if ($tamano === null) {
            throw DatosDeSolicitudInvalidos::porFormato('tamaño de empresa');
        }

        return $tamano;
    }

    public function etiqueta(): string
    {
        return match ($this) {
            self::Microempresa => '1 - 9 empleados',
            self::Pequena => '10 - 49 empleados',
            self::Mediana => '50 - 249 empleados',
            self::Grande => '250+ empleados',
        };
    }
}
