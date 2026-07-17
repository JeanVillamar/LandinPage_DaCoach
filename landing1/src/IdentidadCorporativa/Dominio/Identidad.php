<?php

declare(strict_types=1);

namespace DaCoach\IdentidadCorporativa\Dominio;

interface Identidad
{
    /**
     * @return list<ValorCorporativo>
     */
    public function valores(): array;

    public function compromiso(): string;

    public function lema(): string;
}
