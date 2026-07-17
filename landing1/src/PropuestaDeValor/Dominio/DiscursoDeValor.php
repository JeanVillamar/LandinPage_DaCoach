<?php

declare(strict_types=1);

namespace DaCoach\PropuestaDeValor\Dominio;

/**
 * Puerto con el argumentario comercial de DaCoach.
 */
interface DiscursoDeValor
{
    /**
     * @return list<PasoDelFlujoInteligente>
     */
    public function flujoInteligente(): array;

    /**
     * @return list<AreaDeImpacto>
     */
    public function areasDeImpacto(): array;

    /**
     * @return list<ProblemaOperativo>
     */
    public function problemasOperativos(): array;

    /**
     * @return list<RasgoDeLaOperacion>
     */
    public function operacionManual(): array;

    /**
     * @return list<RasgoDeLaOperacion>
     */
    public function operacionInteligente(): array;
}
