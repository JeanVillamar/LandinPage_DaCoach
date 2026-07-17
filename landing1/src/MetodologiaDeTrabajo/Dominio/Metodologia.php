<?php

declare(strict_types=1);

namespace DaCoach\MetodologiaDeTrabajo\Dominio;

interface Metodologia
{
    /**
     * @return list<FaseDeTrabajo> En orden de ejecución.
     */
    public function fases(): array;

    public function primeraFase(): FaseDeTrabajo;

    /**
     * @return list<PrincipioDeColaboracion>
     */
    public function principiosDeColaboracion(): array;
}
