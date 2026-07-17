<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio;

/**
 * Lo que el asistente contesta: un texto, unas acciones sugeridas y el tema que
 * detectó.
 *
 * Conservar el tema es lo que permite a la interfaz reaccionar (abrir el
 * formulario de diagnóstico) sin volver a inspeccionar el texto por su cuenta.
 */
final class Respuesta
{
    /**
     * @param list<AccionSugerida> $accionesSugeridas
     */
    private function __construct(
        public readonly Tema $tema,
        public readonly string $texto,
        public readonly array $accionesSugeridas,
    ) {
    }

    /**
     * @param list<string> $accionesSugeridas
     */
    public static function sobre(Tema $tema, string $texto, array $accionesSugeridas = []): self
    {
        $limpio = trim($texto);

        if ($limpio === '') {
            throw new \InvalidArgumentException('El asistente no puede responder con un texto vacío.');
        }

        return new self(
            $tema,
            $limpio,
            array_values(array_map(AccionSugerida::desdeCadena(...), $accionesSugeridas)),
        );
    }

    /**
     * La conversación llegó al punto de pedir los datos del visitante.
     */
    public function abreSolicitudDeDiagnostico(): bool
    {
        return $this->tema->pideDiagnostico();
    }
}
