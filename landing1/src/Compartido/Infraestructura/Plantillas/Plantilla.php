<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura\Plantillas;

/**
 * Render de vistas PHP planas.
 *
 * Cada contexto guarda sus vistas dentro de su propia carpeta
 * (src/<Contexto>/Infraestructura/Web/vistas), de modo que la plantilla se
 * resuelve con la notación "Contexto:nombre-de-vista".
 */
final class Plantilla
{
    public function __construct(private readonly string $directorioDeContextos)
    {
    }

    /**
     * Pinta una vista y devuelve su HTML.
     *
     * La vista se ejecuta dentro de un closure de esta clase, así que dispone de
     * `$this` y puede anidar otras vistas con `$this->pintar(...)`. Cada clave de
     * $datos llega como una variable con ese nombre.
     *
     * @param array<string, mixed> $datos
     */
    public function pintar(string $referencia, array $datos = []): string
    {
        $archivo = $this->resolver($referencia);

        $render = function () use ($archivo, $datos): string {
            extract($datos, EXTR_SKIP);
            ob_start();

            try {
                require $archivo;
            } catch (\Throwable $error) {
                ob_end_clean();

                throw $error;
            }

            return (string) ob_get_clean();
        };

        return $render();
    }

    /**
     * Escapa texto para incrustarlo en HTML. Las vistas la usan en todo valor
     * que provenga del visitante.
     */
    public static function escapar(?string $valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private function resolver(string $referencia): string
    {
        if (!str_contains($referencia, ':')) {
            throw new \InvalidArgumentException(
                sprintf('La referencia de plantilla "%s" debe tener la forma "Contexto:vista".', $referencia)
            );
        }

        [$contexto, $vista] = explode(':', $referencia, 2);

        if (str_contains($vista, '..') || str_contains($contexto, '..')) {
            throw new \InvalidArgumentException(sprintf('Referencia de plantilla no permitida: "%s".', $referencia));
        }

        $archivo = sprintf('%s/%s/Infraestructura/Web/vistas/%s.php', $this->directorioDeContextos, $contexto, $vista);

        if (!is_file($archivo)) {
            throw new \RuntimeException(sprintf('No existe la plantilla "%s" (buscada en %s).', $referencia, $archivo));
        }

        return $archivo;
    }
}
