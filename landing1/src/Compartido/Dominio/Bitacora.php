<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Dominio;

/**
 * Puerto de registro de eventos. Deliberadamente mínimo: si el proyecto adopta
 * PSR-3, este puerto se implementa sobre un LoggerInterface sin tocar los casos
 * de uso.
 */
interface Bitacora
{
    /**
     * @param array<string, scalar|null> $contexto
     */
    public function registrar(string $mensaje, array $contexto = []): void;
}
