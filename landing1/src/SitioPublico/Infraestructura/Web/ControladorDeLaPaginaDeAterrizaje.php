<?php

declare(strict_types=1);

namespace DaCoach\SitioPublico\Infraestructura\Web;

use DaCoach\CasosDeExito\Dominio\CatalogoDeCasos;
use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeBeneficios;
use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeSectores;
use DaCoach\CatalogoDeSoluciones\Dominio\CatalogoDeServicios;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\Compartido\Infraestructura\Web\Peticion;
use DaCoach\Compartido\Infraestructura\Web\Respuesta;
use DaCoach\Compartido\Infraestructura\Web\Sesion;
use DaCoach\IdentidadCorporativa\Dominio\Identidad;
use DaCoach\InteligenciaArtificialResponsable\Dominio\MarcoDeGobernanza;
use DaCoach\MetodologiaDeTrabajo\Dominio\Metodologia;
use DaCoach\PropuestaDeValor\Dominio\DiscursoDeValor;
use DaCoach\SitioPublico\Dominio\DatosDeContacto;
use DaCoach\SitioPublico\Dominio\MetadatosSeo;
use DaCoach\SolicitudDeDiagnostico\Infraestructura\Web\ControladorDeSolicitudes;

/**
 * Compone la página única a partir de lo que aporta cada contexto.
 *
 * Este controlador no sabe nada del negocio: sólo pide a cada catálogo su
 * contenido y deja que cada contexto pinte su propia sección.
 */
final class ControladorDeLaPaginaDeAterrizaje
{
    public function __construct(
        private readonly Plantilla $plantilla,
        private readonly DiscursoDeValor $discurso,
        private readonly CatalogoDeServicios $servicios,
        private readonly CatalogoDeSectores $sectores,
        private readonly CatalogoDeBeneficios $beneficios,
        private readonly CatalogoDeCasos $casos,
        private readonly Metodologia $metodologia,
        private readonly MarcoDeGobernanza $gobernanza,
        private readonly Identidad $identidad,
        private readonly DatosDeContacto $contacto,
        private readonly Sesion $sesion,
    ) {
    }

    public function __invoke(Peticion $peticion): Respuesta
    {
        $seo = MetadatosSeo::deLaPaginaPrincipal($this->urlBase());

        $contenido = $this->plantilla->pintar('SitioPublico:pagina-de-aterrizaje', [
            'discurso' => $this->discurso,
            'servicios' => $this->servicios->todos(),
            'sectores' => $this->sectores->todos(),
            'beneficios' => $this->beneficios->todos(),
            'casos' => $this->casos->todos(),
            'metodologia' => $this->metodologia,
            'gobernanza' => $this->gobernanza->principios(),
            'identidad' => $this->identidad,
            'contacto' => $this->contacto,
            'aviso' => $this->sesion->tomarAviso(ControladorDeSolicitudes::AVISO),
        ]);

        return Respuesta::html($this->plantilla->pintar('SitioPublico:documento', [
            'seo' => $seo,
            'jsonLd' => $seo->comoOrganizacionJsonLd($this->contacto),
            'contenido' => $contenido,
        ]));
    }

    private function urlBase(): string
    {
        $esquema = ($_SERVER['HTTPS'] ?? '') !== '' ? 'https' : 'http';
        $anfitrion = (string) ($_SERVER['HTTP_HOST'] ?? 'localhost');

        return $esquema . '://' . $anfitrion;
    }
}
