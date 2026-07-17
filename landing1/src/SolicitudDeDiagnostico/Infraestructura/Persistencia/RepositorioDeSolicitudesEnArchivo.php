<?php

declare(strict_types=1);

namespace DaCoach\SolicitudDeDiagnostico\Infraestructura\Persistencia;

use DaCoach\SolicitudDeDiagnostico\Dominio\CanalDeOrigen;
use DaCoach\SolicitudDeDiagnostico\Dominio\CorreoElectronico;
use DaCoach\SolicitudDeDiagnostico\Dominio\IdDeSolicitud;
use DaCoach\SolicitudDeDiagnostico\Dominio\Industria;
use DaCoach\SolicitudDeDiagnostico\Dominio\PerfilDeEmpresa;
use DaCoach\SolicitudDeDiagnostico\Dominio\ProcesoAMejorar;
use DaCoach\SolicitudDeDiagnostico\Dominio\RepositorioDeSolicitudes;
use DaCoach\SolicitudDeDiagnostico\Dominio\SolicitudDeDiagnostico;
use DaCoach\SolicitudDeDiagnostico\Dominio\Solicitante;
use DaCoach\SolicitudDeDiagnostico\Dominio\TamanoDeEmpresa;
use DaCoach\SolicitudDeDiagnostico\Dominio\Telefono;

/**
 * Guarda cada solicitud como una línea JSON.
 *
 * Adaptador provisional mientras no se decide el destino real de los leads
 * (base de datos o CRM). Al estar detrás del puerto RepositorioDeSolicitudes,
 * sustituirlo no toca ni el dominio ni el caso de uso.
 *
 * No sirve para volúmenes altos: recibidasPorCanal() lee el archivo entero.
 */
final class RepositorioDeSolicitudesEnArchivo implements RepositorioDeSolicitudes
{
    public function __construct(private readonly string $archivo)
    {
    }

    public function guardar(SolicitudDeDiagnostico $solicitud): void
    {
        $directorio = \dirname($this->archivo);

        if (!is_dir($directorio) && !mkdir($directorio, 0o775, true) && !is_dir($directorio)) {
            throw new \RuntimeException(sprintf('No se pudo crear el directorio de solicitudes "%s".', $directorio));
        }

        $linea = json_encode($this->aArreglo($solicitud), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($linea === false) {
            throw new \RuntimeException('No se pudo serializar la solicitud de diagnóstico.');
        }

        if (file_put_contents($this->archivo, $linea . PHP_EOL, FILE_APPEND | LOCK_EX) === false) {
            throw new \RuntimeException(sprintf('No se pudo guardar la solicitud en "%s".', $this->archivo));
        }
    }

    public function recibidasPorCanal(CanalDeOrigen $canal): array
    {
        if (!is_file($this->archivo)) {
            return [];
        }

        $lineas = file($this->archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lineas === false) {
            return [];
        }

        $solicitudes = [];

        foreach ($lineas as $linea) {
            $datos = json_decode($linea, true);

            if (!\is_array($datos) || ($datos['canal'] ?? null) !== $canal->value) {
                continue;
            }

            $solicitudes[] = $this->desdeArreglo($datos);
        }

        return $solicitudes;
    }

    /**
     * @return array<string, mixed>
     */
    private function aArreglo(SolicitudDeDiagnostico $solicitud): array
    {
        return [
            'id' => $solicitud->id->valor,
            'canal' => $solicitud->canal->value,
            'recibidaEn' => $solicitud->recibidaEn->format(\DATE_ATOM),
            'solicitante' => [
                'nombre' => $solicitud->solicitante->nombre,
                'correo' => $solicitud->solicitante->correo->valor,
                'telefono' => $solicitud->solicitante->telefono?->valor,
            ],
            'empresa' => $solicitud->empresa === null ? null : [
                'nombre' => $solicitud->empresa->nombre,
                'industria' => $solicitud->empresa->industria->value,
                'tamano' => $solicitud->empresa->tamano->value,
            ],
            'proceso' => [
                'descripcion' => $solicitud->proceso->descripcion,
                'herramientasActuales' => $solicitud->proceso->herramientasActuales,
                'mensajeAdicional' => $solicitud->proceso->mensajeAdicional,
            ],
        ];
    }

    /**
     * @param array<string, mixed> $datos
     */
    private function desdeArreglo(array $datos): SolicitudDeDiagnostico
    {
        /** @var array{nombre: string, correo: string, telefono: ?string} $solicitante */
        $solicitante = $datos['solicitante'];
        /** @var array{descripcion: string, herramientasActuales: string, mensajeAdicional: string} $proceso */
        $proceso = $datos['proceso'];
        /** @var array{nombre: string, industria: string, tamano: string}|null $empresa */
        $empresa = $datos['empresa'] ?? null;

        return SolicitudDeDiagnostico::reconstituir(
            IdDeSolicitud::desdeCadena((string) $datos['id']),
            Solicitante::crear(
                $solicitante['nombre'],
                CorreoElectronico::desdeCadena($solicitante['correo']),
                $solicitante['telefono'] === null ? null : Telefono::desdeCadena($solicitante['telefono']),
            ),
            $empresa === null ? null : PerfilDeEmpresa::crear(
                $empresa['nombre'],
                Industria::desdeCadena($empresa['industria']),
                TamanoDeEmpresa::desdeCadena($empresa['tamano']),
            ),
            ProcesoAMejorar::crear(
                $proceso['descripcion'],
                $proceso['herramientasActuales'],
                $proceso['mensajeAdicional'],
            ),
            CanalDeOrigen::from((string) $datos['canal']),
            new \DateTimeImmutable((string) $datos['recibidaEn']),
        );
    }
}
