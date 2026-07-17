<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio;

/**
 * Siguiente pregunta que el asistente propone al visitante. Son los botones que
 * mantienen viva la conversación y la empujan hacia el diagnóstico.
 */
final class AccionSugerida
{
    private function __construct(public readonly string $texto)
    {
    }

    public static function desdeCadena(string $texto): self
    {
        $limpio = trim($texto);

        if ($limpio === '') {
            throw new \InvalidArgumentException('Una acción sugerida no puede estar vacía.');
        }

        return new self($limpio);
    }

    public function __toString(): string
    {
        return $this->texto;
    }
}
