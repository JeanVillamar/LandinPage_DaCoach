<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Web;

/**
 * Lectura de la petición HTTP entrante. Aísla a los controladores de las
 * superglobales para que puedan construirse en pruebas sin tocar $_SERVER.
 */
final class Peticion
{
    /**
     * @param array<string, mixed> $parametros
     */
    private function __construct(
        public readonly string $metodo,
        public readonly string $ruta,
        private readonly array $parametros,
        private readonly string $cuerpoCrudo,
    ) {
    }

    public static function desdeGlobales(): self
    {
        $metodo = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
        $ruta = parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);

        return new self(
            $metodo,
            \is_string($ruta) && $ruta !== '' ? rtrim($ruta, '/') ?: '/' : '/',
            $_POST,
            (string) file_get_contents('php://input'),
        );
    }

    /**
     * @param array<string, mixed> $parametros
     */
    public static function simulada(string $metodo, string $ruta, array $parametros = [], string $cuerpoCrudo = ''): self
    {
        return new self(strtoupper($metodo), $ruta, $parametros, $cuerpoCrudo);
    }

    public function esJson(): bool
    {
        $tipo = (string) ($_SERVER['CONTENT_TYPE'] ?? $_SERVER['HTTP_CONTENT_TYPE'] ?? '');

        return str_contains(strtolower($tipo), 'application/json');
    }

    /**
     * Parámetros del cuerpo, vengan de un formulario clásico o de un JSON.
     *
     * @return array<string, mixed>
     */
    public function parametros(): array
    {
        if ($this->cuerpoCrudo !== '' && $this->esJson()) {
            $decodificado = json_decode($this->cuerpoCrudo, true);

            if (\is_array($decodificado)) {
                return $decodificado;
            }
        }

        return $this->parametros;
    }

    public function texto(string $clave): string
    {
        $valor = $this->parametros()[$clave] ?? '';

        return \is_scalar($valor) ? trim((string) $valor) : '';
    }

    public function booleano(string $clave): bool
    {
        $valor = $this->parametros()[$clave] ?? false;

        if (\is_bool($valor)) {
            return $valor;
        }

        return \in_array(strtolower((string) $valor), ['1', 'true', 'on', 'si', 'sí'], true);
    }
}
