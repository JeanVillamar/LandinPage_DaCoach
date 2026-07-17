<?php

declare(strict_types=1);

namespace DaCoach\CatalogoDeSoluciones\Dominio;

/**
 * Puerto de lectura del catálogo. Hoy el contenido está escrito en código; si
 * pasa a un gestor de contenidos, sólo cambia el adaptador.
 */
interface CatalogoDeServicios
{
    /**
     * @return list<Servicio>
     */
    public function todos(): array;
}
