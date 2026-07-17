<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion;

/**
 * Sin consentimiento no existe la solicitud: DaCoach no puede tratar los datos
 * comerciales del visitante, así que el agregado se niega a construirse.
 */
final class ConsentimientoNoOtorgado extends \DomainException
{
    public static function paraTratarLosDatos(): self
    {
        return new self('Debes aceptar la política de privacidad para continuar.');
    }
}
