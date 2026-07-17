<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Dominio;

/**
 * Identificador opaco (UUID v4) para las entidades del dominio.
 */
class Identificador
{
    final private function __construct(public readonly string $valor)
    {
    }

    public static function nuevo(): static
    {
        $bytes = random_bytes(16);
        $bytes[6] = \chr((\ord($bytes[6]) & 0x0F) | 0x40);
        $bytes[8] = \chr((\ord($bytes[8]) & 0x3F) | 0x80);

        return new static(vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4)));
    }

    public static function desdeCadena(string $valor): static
    {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $valor) !== 1) {
            throw new \InvalidArgumentException(sprintf('"%s" no es un identificador válido.', $valor));
        }

        return new static(strtolower($valor));
    }

    public function esIgualA(self $otro): bool
    {
        return $this->valor === $otro->valor && static::class === $otro::class;
    }

    public function __toString(): string
    {
        return $this->valor;
    }
}
