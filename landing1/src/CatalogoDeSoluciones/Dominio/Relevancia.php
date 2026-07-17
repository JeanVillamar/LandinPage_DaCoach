<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

/**
 * Peso comercial de un servicio dentro del catálogo.
 *
 * Es una decisión de negocio (qué queremos que vea primero un visitante), no un
 * detalle de maquetación: la vista traduce cada valor a un tamaño de tarjeta,
 * pero si mañana el catálogo se pinta en una tabla la relevancia sigue valiendo.
 */
enum Relevancia: string
{
    /** Servicio insignia: se muestra en grande. */
    case Principal = 'principal';

    /** Servicio con muchas capacidades que merecen leerse juntas. */
    case Ampliada = 'ampliada';

    case Estandar = 'estandar';
}
