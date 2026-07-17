<?php

declare(strict_types=1);

/**
 * Único punto de entrada del sitio y raíz de composición.
 *
 * Aquí se decide qué implementación concreta recibe cada puerto. Es el único
 * archivo que hay que tocar para cambiar dónde acaban los leads o quién
 * responde en el asistente: ni el dominio ni los casos de uso se enteran.
 */

use DaCoach\AsistenteVirtual\Aplicacion\ResponderConsulta;
use DaCoach\AsistenteVirtual\Infraestructura\Conocimiento\GuionDeRespuestas;
use DaCoach\AsistenteVirtual\Infraestructura\Web\ControladorDelAsistente;
use DaCoach\CasosDeExito\Infraestructura\Contenido\CasosPublicados;
use DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido\BeneficiosOperativos;
use DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido\SectoresAtendidos;
use DaCoach\CatalogoDeSoluciones\Infraestructura\Contenido\ServiciosDeDaCoach;
use DaCoach\Compartido\Infraestructura\Bitacora\BitacoraEnArchivo;
use DaCoach\Compartido\Infraestructura\CargadorDeClases;
use DaCoach\Compartido\Infraestructura\Plantillas\Plantilla;
use DaCoach\Compartido\Infraestructura\Web\Enrutador;
use DaCoach\Compartido\Infraestructura\Web\Peticion;
use DaCoach\Compartido\Infraestructura\Web\Sesion;
use DaCoach\IdentidadCorporativa\Infraestructura\Contenido\IdentidadDeDaCoach;
use DaCoach\InteligenciaArtificialResponsable\Infraestructura\Contenido\MarcoDeGobernanzaDeDaCoach;
use DaCoach\MetodologiaDeTrabajo\Infraestructura\Contenido\MetodologiaDeSieteFases;
use DaCoach\PropuestaDeValor\Infraestructura\Contenido\ArgumentarioDeDaCoach;
use DaCoach\SitioPublico\Dominio\DatosDeContacto;
use DaCoach\SitioPublico\Infraestructura\Web\ControladorDeLaPaginaDeAterrizaje;
use DaCoach\SolicitudDeDiagnostico\Aplicacion\RegistrarSolicitudDeDiagnostico;
use DaCoach\SolicitudDeDiagnostico\Infraestructura\Notificacion\NotificadorEnBitacora;
use DaCoach\SolicitudDeDiagnostico\Infraestructura\Persistencia\RepositorioDeSolicitudesEnArchivo;
use DaCoach\SolicitudDeDiagnostico\Infraestructura\Web\ControladorDeSolicitudes;

$raiz = \dirname(__DIR__);

require $raiz . '/src/Compartido/Infraestructura/CargadorDeClases.php';
CargadorDeClases::registrar($raiz . '/src');

$plantilla = new Plantilla($raiz . '/src');
$sesion = new Sesion();
$bitacora = new BitacoraEnArchivo($raiz . '/var/bitacora/dacoach.log');

// Adaptadores provisionales: los leads se guardan en un archivo y el aviso al
// equipo se deja en la bitácora. Cuando se decida el destino real (base de datos,
// correo o CRM), se implementan RepositorioDeSolicitudes y NotificadorDeSolicitudes
// y se cambian estas dos líneas.
$registrarSolicitud = new RegistrarSolicitudDeDiagnostico(
    new RepositorioDeSolicitudesEnArchivo($raiz . '/var/solicitudes/solicitudes.jsonl'),
    new NotificadorEnBitacora($bitacora),
    $bitacora,
);

$paginaDeAterrizaje = new ControladorDeLaPaginaDeAterrizaje(
    $plantilla,
    new ArgumentarioDeDaCoach(),
    new ServiciosDeDaCoach(),
    new SectoresAtendidos(),
    new BeneficiosOperativos(),
    new CasosPublicados(),
    new MetodologiaDeSieteFases(),
    new MarcoDeGobernanzaDeDaCoach(),
    new IdentidadDeDaCoach(),
    new DatosDeContacto(),
    $sesion,
);

$solicitudes = new ControladorDeSolicitudes($registrarSolicitud, $sesion);
$asistente = new ControladorDelAsistente(new ResponderConsulta(new GuionDeRespuestas()));

$enrutador = new Enrutador();
$enrutador->registrar('GET', '/', $paginaDeAterrizaje(...));
$enrutador->registrar('POST', '/solicitudes/diagnostico', $solicitudes->desdeFormulario(...));
$enrutador->registrar('POST', '/asistente/solicitudes', $solicitudes->desdeAsistente(...));
$enrutador->registrar('POST', '/api/asistente/consultas', $asistente(...));

$enrutador->despachar(Peticion::desdeGlobales())->emitir();
