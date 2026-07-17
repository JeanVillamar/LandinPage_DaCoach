<?php

declare(strict_types=1);

namespace DaCoach\AsistenteVirtual\Dominio;

/**
 * Puerto que resuelve qué dice el asistente sobre un tema.
 *
 * Hoy detrás hay un guion escrito a mano (GuionDeRespuestas). Enchufar un modelo
 * de lenguaje real es implementar esta interfaz: ni el dominio ni el caso de uso
 * se enteran.
 */
interface BaseDeConocimiento
{
    public function responderSobre(Tema $tema, Consulta $consulta): Respuesta;
}
