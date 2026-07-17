<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio;

use DaCoach\AsistenteVirtual\Dominio\Excepcion\ConsultaVacia;

/**
 * Lo que el visitante le pregunta al asistente.
 */
final class Consulta
{
    private const LARGO_MAXIMO = 1000;

    private function __construct(public readonly string $texto)
    {
    }

    public static function desdeCadena(string $texto): self
    {
        $limpio = trim($texto);

        if ($limpio === '') {
            throw ConsultaVacia::sinTexto();
        }

        if (mb_strlen($limpio) > self::LARGO_MAXIMO) {
            $limpio = mb_substr($limpio, 0, self::LARGO_MAXIMO);
        }

        return new self($limpio);
    }

    /**
     * Texto normalizado para comparar: sin mayúsculas ni acentos, de modo que
     * "diagnóstico" y "diagnostico" se traten igual.
     */
    public function normalizado(): string
    {
        $minusculas = mb_strtolower($this->texto, 'UTF-8');

        return strtr($minusculas, [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'ü' => 'u', 'ñ' => 'n',
        ]);
    }

    public function mencionaAlguna(string ...$palabras): bool
    {
        $texto = $this->normalizado();

        foreach ($palabras as $palabra) {
            if (str_contains($texto, $palabra)) {
                return true;
            }
        }

        return false;
    }
}
