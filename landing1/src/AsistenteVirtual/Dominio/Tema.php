<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio;

/**
 * De qué habla el visitante.
 *
 * Clasificar la consulta es la única decisión de negocio del asistente: de ella
 * depende qué se responde y si hay que ofrecerle el formulario de diagnóstico.
 *
 * El orden de los casos es el orden de prioridad al detectar, y no es
 * arbitrario: una consulta como "quiero automatizar y solicitar un diagnóstico"
 * menciona dos temas, y Diagnostico gana porque es la que tiene intención de
 * compra.
 */
enum Tema: string
{
    case Diagnostico = 'diagnostico';
    case Integraciones = 'integraciones';
    case TamanoDeEmpresa = 'tamano-de-empresa';
    case Metodologia = 'metodologia';
    case Diferenciador = 'diferenciador';
    case Automatizacion = 'automatizacion';
    case BeneficiosDeLaIa = 'beneficios-de-la-ia';
    case Presentacion = 'presentacion';

    public static function detectarEn(Consulta $consulta): self
    {
        foreach (self::cases() as $tema) {
            if ($tema !== self::Presentacion && $consulta->mencionaAlguna(...$tema->palabrasClave())) {
                return $tema;
            }
        }

        return self::Presentacion;
    }

    /**
     * Palabras ya normalizadas (minúsculas, sin acentos): Consulta::normalizado()
     * deja el texto en esa forma antes de comparar.
     *
     * @return list<string>
     */
    public function palabrasClave(): array
    {
        return match ($this) {
            self::Diagnostico => ['diagnostico', 'solicitar', 'asesoria', 'cotizar', 'contactar'],
            self::Integraciones => ['whatsapp', 'telegram', 'calendario', 'integrar', 'integracion', 'crm', 'conectar'],
            self::TamanoDeEmpresa => ['pequena', 'pequenas', 'pyme', 'pymes', 'tamano', 'startup'],
            self::Metodologia => ['comienza', 'comenzar', 'empezar', 'proyecto', 'metodologia', 'proceso de trabajo'],
            self::Diferenciador => ['diferencia', 'dacoach', 'por que ustedes', 'competencia'],
            self::Automatizacion => ['automatizar', 'automatizacion', 'procesos', 'tareas repetitivas'],
            self::BeneficiosDeLaIa => ['mejorar', 'empresa', 'inteligencia artificial', 'beneficio', 'ayuda la ia', 'sirve la ia'],
            self::Presentacion => [],
        };
    }

    /**
     * El visitante quiere que le estudien su operación: hay que pedirle los
     * datos en vez de seguir conversando.
     */
    public function pideDiagnostico(): bool
    {
        return $this === self::Diagnostico;
    }
}
