<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Web;

/**
 * Respuesta HTTP. Los controladores la devuelven en vez de escribir directamente
 * en la salida, para que el enrutador decida cuándo emitirla.
 */
final class Respuesta
{
    /**
     * @param array<string, string> $cabeceras
     */
    private function __construct(
        public readonly string $cuerpo,
        public readonly int $codigo,
        public readonly array $cabeceras,
    ) {
    }

    public static function html(string $cuerpo, int $codigo = 200): self
    {
        return new self($cuerpo, $codigo, ['Content-Type' => 'text/html; charset=utf-8']);
    }

    /**
     * @param array<string, mixed> $datos
     */
    public static function json(array $datos, int $codigo = 200): self
    {
        $codificado = json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return new self(
            $codificado === false ? '{}' : $codificado,
            $codigo,
            ['Content-Type' => 'application/json; charset=utf-8'],
        );
    }

    public static function redireccion(string $destino, int $codigo = 303): self
    {
        return new self('', $codigo, ['Location' => $destino]);
    }

    public function emitir(): void
    {
        if (!headers_sent()) {
            http_response_code($this->codigo);

            foreach ($this->cabeceras as $nombre => $valor) {
                header($nombre . ': ' . $valor);
            }
        }

        echo $this->cuerpo;
    }
}
