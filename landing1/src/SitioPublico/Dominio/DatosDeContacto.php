<?php

declare(strict_types=1);

namespace DaCoach\SitioPublico\Dominio;

/**
 * Datos de contacto públicos de DaCoach.
 *
 * Siguen siendo los marcadores de posición que traía la versión React; se
 * concentran aquí para que reemplazarlos por los reales sea un solo cambio y no
 * una búsqueda por toda la maqueta.
 */
final class DatosDeContacto
{
    public function __construct(
        public readonly string $correo = 'contacto@dacoach.com (Placeholder)',
        public readonly string $telefono = '+1 000 000 0000 (Placeholder)',
        public readonly string $direccion = 'Dirección Comercial (Placeholder)',
    ) {
    }
}
