<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Dominio;

use DaCoach\SolicitudDeDiagnostico\Dominio\Excepcion\ConsentimientoNoOtorgado;

/**
 * Una empresa pide que DaCoach estudie su operación.
 *
 * Es el agregado que da nombre al contexto. Existe en dos formas según por dónde
 * entró el visitante, y ambas comparten la misma invariante: sin consentimiento
 * explícito no hay solicitud.
 */
final class SolicitudDeDiagnostico
{
    private function __construct(
        public readonly IdDeSolicitud $id,
        public readonly Solicitante $solicitante,
        public readonly ?PerfilDeEmpresa $empresa,
        public readonly ProcesoAMejorar $proceso,
        public readonly CanalDeOrigen $canal,
        public readonly \DateTimeImmutable $recibidaEn,
    ) {
    }

    /**
     * Solicitud completa: el visitante rellenó el formulario de la sección de
     * contacto, con el perfil de su empresa.
     */
    public static function desdeFormularioDeContacto(
        Solicitante $solicitante,
        PerfilDeEmpresa $empresa,
        ProcesoAMejorar $proceso,
        bool $consentimientoOtorgado,
        ?\DateTimeImmutable $recibidaEn = null,
    ): self {
        self::garantizarConsentimiento($consentimientoOtorgado);

        return new self(
            IdDeSolicitud::nuevo(),
            $solicitante,
            $empresa,
            $proceso,
            CanalDeOrigen::FormularioDeContacto,
            $recibidaEn ?? new \DateTimeImmutable(),
        );
    }

    /**
     * Solicitud breve: el visitante la pidió conversando con el asistente, que
     * sólo recoge nombre, correo y proceso.
     */
    public static function desdeAsistenteVirtual(
        Solicitante $solicitante,
        ProcesoAMejorar $proceso,
        bool $consentimientoOtorgado,
        ?\DateTimeImmutable $recibidaEn = null,
    ): self {
        self::garantizarConsentimiento($consentimientoOtorgado);

        return new self(
            IdDeSolicitud::nuevo(),
            $solicitante,
            null,
            $proceso,
            CanalDeOrigen::AsistenteVirtual,
            $recibidaEn ?? new \DateTimeImmutable(),
        );
    }

    /**
     * Rehidrata una solicitud ya validada que vuelve del almacenamiento.
     *
     * No comprueba el consentimiento: si la solicitud llegó a guardarse, esa
     * invariante se cumplió al crearla. Reservado a los adaptadores de
     * persistencia; para crear una solicitud nueva usa los constructores por
     * canal de arriba.
     */
    public static function reconstituir(
        IdDeSolicitud $id,
        Solicitante $solicitante,
        ?PerfilDeEmpresa $empresa,
        ProcesoAMejorar $proceso,
        CanalDeOrigen $canal,
        \DateTimeImmutable $recibidaEn,
    ): self {
        return new self($id, $solicitante, $empresa, $proceso, $canal, $recibidaEn);
    }

    /**
     * Una solicitud está lista para el diagnóstico cuando un consultor puede
     * prepararlo sin volver a pedir datos. Las que llegan por el asistente nunca
     * lo están: falta el perfil de la empresa.
     */
    public function estaListaParaDiagnostico(): bool
    {
        return $this->empresa !== null;
    }

    public function requiereContactoPrevio(): bool
    {
        return !$this->estaListaParaDiagnostico();
    }

    public function resumenParaElEquipo(): string
    {
        $empresa = $this->empresa?->nombre ?? 'empresa sin identificar';

        return sprintf(
            '%s (%s) quiere mejorar: %s',
            $empresa,
            $this->solicitante->correo->valor,
            $this->proceso->descripcion,
        );
    }

    private static function garantizarConsentimiento(bool $otorgado): void
    {
        if (!$otorgado) {
            throw ConsentimientoNoOtorgado::paraTratarLosDatos();
        }
    }
}
