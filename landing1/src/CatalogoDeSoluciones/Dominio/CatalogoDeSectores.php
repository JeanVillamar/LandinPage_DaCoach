<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

interface CatalogoDeSectores
{
    /**
     * @return list<Sector>
     */
    public function todos(): array;
}
