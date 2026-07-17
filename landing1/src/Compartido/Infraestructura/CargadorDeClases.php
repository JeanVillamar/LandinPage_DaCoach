<?php

declare(strict_types=1);

namespace DaCoach\Compartido\Infraestructura;

/**
 * Autoload PSR-4 equivalente al que genera Composer.
 *
 * El proyecto no tiene dependencias de terceros en tiempo de ejecución, así que
 * arranca sin `composer install`. Si vendor/autoload.php existe, tiene prioridad.
 */
final class CargadorDeClases
{
    private const PREFIJO = 'DaCoach\\';

    public function __construct(private readonly string $directorioBase)
    {
    }

    public static function registrar(string $directorioBase): void
    {
        $autoloadDeComposer = \dirname($directorioBase) . '/vendor/autoload.php';

        if (is_file($autoloadDeComposer)) {
            require_once $autoloadDeComposer;

            return;
        }

        $cargador = new self($directorioBase);
        spl_autoload_register([$cargador, 'cargar']);
    }

    public function cargar(string $claseCompleta): void
    {
        if (!str_starts_with($claseCompleta, self::PREFIJO)) {
            return;
        }

        $rutaRelativa = str_replace('\\', '/', substr($claseCompleta, \strlen(self::PREFIJO)));
        $archivo = $this->directorioBase . '/' . $rutaRelativa . '.php';

        if (is_file($archivo)) {
            require_once $archivo;
        }
    }
}
