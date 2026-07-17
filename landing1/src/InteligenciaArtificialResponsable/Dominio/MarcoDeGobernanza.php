<?php

declare(strict_types=1);

namespace DaCoach\InteligenciaArtificialResponsable\Dominio;

interface MarcoDeGobernanza
{
    /**
     * @return list<PrincipioDeGobernanza>
     */
    public function principios(): array;
}
