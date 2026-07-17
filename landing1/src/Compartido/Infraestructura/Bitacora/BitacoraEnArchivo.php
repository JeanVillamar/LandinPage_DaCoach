<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Bitacora;

use DaCoach\Compartido\Dominio\Bitacora;

final class BitacoraEnArchivo implements Bitacora
{
    public function __construct(private readonly string $archivo)
    {
    }

    public function registrar(string $mensaje, array $contexto = []): void
    {
        $directorio = \dirname($this->archivo);

        if (!is_dir($directorio) && !mkdir($directorio, 0o775, true) && !is_dir($directorio)) {
            return;
        }

        $linea = sprintf(
            '[%s] %s%s%s',
            (new \DateTimeImmutable())->format(\DATE_ATOM),
            $mensaje,
            $contexto === [] ? '' : ' ' . (json_encode($contexto, JSON_UNESCAPED_UNICODE) ?: ''),
            PHP_EOL,
        );

        @file_put_contents($this->archivo, $linea, FILE_APPEND | LOCK_EX);
    }
}
