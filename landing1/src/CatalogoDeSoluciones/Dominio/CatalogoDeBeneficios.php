<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

interface CatalogoDeBeneficios
{
    /**
     * @return list<Beneficio>
     */
    public function todos(): array;
}
