<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio\Excepcion;

final class ConsultaVacia extends \DomainException
{
    public static function sinTexto(): self
    {
        return new self('Escribe una pregunta para que el asistente pueda responderte.');
    }
}
