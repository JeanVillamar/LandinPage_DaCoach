<?php

declare(strict_types=1);

namespace DaCoach\CasosDeExito\Dominio;

/**
 * Un proyecto real ya entregado por DaCoach.
 *
 * Los resultados son cualitativos a propósito: la empresa no publica métricas
 * que no pueda sostener.
 */
final class CasoDeExito
{
    /**
     * @param list<string> $flujoOperativo         Pasos del proceso implementado.
     * @param list<string> $herramientasConectadas Sistemas que se integraron.
     * @param list<string> $resultados             Impacto cualitativo observado.
     * @param list<string> $capacidades            Sólo en casos con demostración detallada.
     */
    public function __construct(
        public readonly string $id,
        public readonly string $cliente,
        public readonly string $categoria,
        public readonly string $alcance,
        public readonly string $reto,
        public readonly string $solucion,
        public readonly array $flujoOperativo,
        public readonly array $herramientasConectadas,
        public readonly array $resultados,
        public readonly ?string $descripcion = null,
        public readonly array $capacidades = [],
    ) {
    }

    /**
     * Pasos que caben en la tarjeta resumen; el resto se anuncia como "+N".
     *
     * @return list<string>
     */
    public function primerosPasos(int $cuantos = 4): array
    {
        return \array_slice($this->flujoOperativo, 0, $cuantos);
    }

    public function pasosRestantes(int $mostrados = 4): int
    {
        return max(0, \count($this->flujoOperativo) - $mostrados);
    }
}
