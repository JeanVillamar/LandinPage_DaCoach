<?php

declare(strict_types=1);

use DaCoach\CasosDeExito\Dominio\CasoDeExito;
use DaCoach\CatalogoDeSoluciones\Dominio\Beneficio;
use DaCoach\CatalogoDeSoluciones\Dominio\Sector;
use DaCoach\CatalogoDeSoluciones\Dominio\Servicio;
use DaCoach\IdentidadCorporativa\Dominio\Identidad;
use DaCoach\InteligenciaArtificialResponsable\Dominio\PrincipioDeGobernanza;
use DaCoach\MetodologiaDeTrabajo\Dominio\Metodologia;
use DaCoach\PropuestaDeValor\Dominio\DiscursoDeValor;
use DaCoach\SitioPublico\Dominio\DatosDeContacto;

/**
 * Orden de lectura de la página. Cada línea delega en el contexto dueño de esa
 * sección: aquí no hay contenido, sólo composición.
 *
 * @var DiscursoDeValor              $discurso
 * @var list<Servicio>               $servicios
 * @var list<Sector>                 $sectores
 * @var list<Beneficio>              $beneficios
 * @var list<CasoDeExito>            $casos
 * @var Metodologia                  $metodologia
 * @var list<PrincipioDeGobernanza>  $gobernanza
 * @var Identidad                    $identidad
 * @var DatosDeContacto              $contacto
 * @var array<string, mixed>|null    $aviso
 */
?>
<a href="#contenido-principal" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[60] focus:bg-white focus:text-brand-blue focus:px-4 focus:py-2 focus:rounded-lg focus:shadow-lg focus:font-semibold">
    Saltar al contenido principal
</a>

<header>
    <?= $this->pintar('SitioPublico:parciales/barra-de-navegacion') ?>
</header>

<main id="contenido-principal" class="flex-grow">
    <?= $this->pintar('PropuestaDeValor:portada', [
        'pasos' => $discurso->flujoInteligente(),
        'lema' => $identidad->lema(),
    ]) ?>

    <?= $this->pintar('PropuestaDeValor:importancia-de-la-ia', [
        'areas' => $discurso->areasDeImpacto(),
    ]) ?>

    <?= $this->pintar('PropuestaDeValor:antes-y-despues', [
        'manual' => $discurso->operacionManual(),
        'inteligente' => $discurso->operacionInteligente(),
    ]) ?>

    <?= $this->pintar('PropuestaDeValor:problemas-operativos', [
        'problemas' => $discurso->problemasOperativos(),
    ]) ?>

    <?= $this->pintar('CatalogoDeSoluciones:rejilla-de-servicios', [
        'servicios' => $servicios,
    ]) ?>

    <?= $this->pintar('CasosDeExito:casos-publicados', [
        'casos' => $casos,
    ]) ?>

    <?= $this->pintar('MetodologiaDeTrabajo:enfoque-humano', [
        'principios' => $metodologia->principiosDeColaboracion(),
    ]) ?>

    <?= $this->pintar('MetodologiaDeTrabajo:fases-de-trabajo', [
        'fases' => $metodologia->fases(),
    ]) ?>

    <?= $this->pintar('CatalogoDeSoluciones:beneficios', [
        'beneficios' => $beneficios,
    ]) ?>

    <?= $this->pintar('CatalogoDeSoluciones:sectores', [
        'sectores' => $sectores,
    ]) ?>

    <?= $this->pintar('AsistenteVirtual:demostracion') ?>

    <?= $this->pintar('InteligenciaArtificialResponsable:principios', [
        'principios' => $gobernanza,
    ]) ?>

    <?= $this->pintar('IdentidadCorporativa:quienes-somos', [
        'identidad' => $identidad,
    ]) ?>

    <?= $this->pintar('SolicitudDeDiagnostico:formulario-de-contacto', [
        'contacto' => $contacto,
        'aviso' => $aviso,
    ]) ?>

    <?= $this->pintar('PropuestaDeValor:llamada-final') ?>
</main>

<?= $this->pintar('SitioPublico:parciales/pie-de-pagina', [
    'contacto' => $contacto,
]) ?>
