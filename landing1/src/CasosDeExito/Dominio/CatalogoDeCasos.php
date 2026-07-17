<?php

declare(strict_types=1);

namespace DaCoach\CasosDeExito\Dominio;

interface CatalogoDeCasos
{
    /**
     * @return list<CasoDeExito>
     */
    public function todos(): array;

    public function porId(string $id): ?CasoDeExito;
}
