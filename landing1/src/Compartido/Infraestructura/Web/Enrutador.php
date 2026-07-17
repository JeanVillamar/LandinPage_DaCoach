<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Web;

/**
 * Enrutador mínimo de rutas exactas. El sitio expone una página y dos endpoints,
 * así que no hace falta soportar parámetros ni expresiones regulares.
 */
final class Enrutador
{
    /** @var array<string, callable(Peticion): Respuesta> */
    private array $rutas = [];

    /**
     * @param callable(Peticion): Respuesta $manejador
     */
    public function registrar(string $metodo, string $ruta, callable $manejador): void
    {
        $this->rutas[strtoupper($metodo) . ' ' . $ruta] = $manejador;
    }

    public function despachar(Peticion $peticion): Respuesta
    {
        $manejador = $this->rutas[$peticion->metodo . ' ' . $peticion->ruta] ?? null;

        if ($manejador === null) {
            return Respuesta::html('<h1>404</h1><p>La página solicitada no existe.</p>', 404);
        }

        return $manejador($peticion);
    }
}
