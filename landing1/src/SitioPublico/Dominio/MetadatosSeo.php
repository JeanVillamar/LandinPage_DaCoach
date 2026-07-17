<?php

declare(strict_types=1);

namespace DaCoach\SitioPublico\Dominio;

/**
 * Metadatos de la página.
 *
 * En la versión React se inyectaban desde un useEffect, es decir, después de
 * pintar y sólo si el cliente ejecutaba JavaScript: los rastreadores que no lo
 * hacen veían el <title> vacío de la plantilla de Vite. Al renderizar en el
 * servidor viajan ya en el HTML.
 */
final class MetadatosSeo
{
    public function __construct(
        public readonly string $titulo,
        public readonly string $descripcion,
        public readonly string $imagenParaCompartir,
        public readonly string $urlBase,
    ) {
    }

    public static function deLaPaginaPrincipal(string $urlBase): self
    {
        return new self(
            'DaCoach Integral Services | Consultoría e Inteligencia Artificial',
            'Consultoría, automatización e implementación de inteligencia artificial para empresas. Mejoramos procesos manuales y creamos soluciones inteligentes, conectadas y escalables.',
            '/og-sharing-image.jpg',
            rtrim($urlBase, '/'),
        );
    }

    /**
     * Datos estructurados de la organización para los buscadores.
     *
     * @return array<string, mixed>
     */
    public function comoOrganizacionJsonLd(DatosDeContacto $contacto): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'DaCoach Integral Services',
            'alternateName' => 'DaCoach',
            'url' => $this->urlBase,
            'logo' => $this->urlBase . '/logo.png',
            'description' => $this->descripcion,
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'MX',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $contacto->telefono,
                'contactType' => 'Sales & Consultations',
                'availableLanguage' => 'Spanish',
            ],
        ];
    }
}
