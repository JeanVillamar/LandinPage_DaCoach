<?php

declare(strict_types=1);

/**
 * Logotipo de DaCoach.
 *
 * Los colores salen de variables CSS (ver assets/css/entrada.css): sobre fondo
 * oscuro se pinta claro, y cuando un ancestro marca data-scrolled="true" pasa a
 * la versión de marca. Así el mismo SVG sirve al menú y al pie sin duplicarse.
 *
 * El nodo central ámbar representa la supervisión humana dentro del flujo
 * automatizado, que es el argumento central de la empresa.
 */
?>
<div class="logotipo flex items-center gap-2.5">
    <svg viewBox="0 0 45 45" class="h-10 w-10 flex-shrink-0" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="DaCoach Integral Services">
        <circle cx="22.5" cy="10" r="4.5" fill="var(--logo-secundario)"/>
        <circle cx="34" cy="22.5" r="5.5" fill="var(--logo-primario)"/>
        <circle cx="22.5" cy="35" r="4.5" fill="var(--logo-secundario)"/>
        <circle cx="11" cy="22.5" r="3.5" fill="var(--logo-primario)"/>
        <path d="M22.5 10L34 22.5L22.5 35L11 22.5Z" stroke="var(--logo-primario)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M11 22.5H34" stroke="var(--logo-secundario)" stroke-width="1.5" stroke-dasharray="3 3"/>
        <circle cx="22.5" cy="22.5" r="2.5" fill="#FFB547"/>
    </svg>
    <div class="flex flex-col">
        <span class="font-sora text-lg font-bold leading-none tracking-tight" style="color: var(--logo-texto)">
            DaCoach
        </span>
        <span class="font-inter text-[9px] font-semibold tracking-[1.5px] mt-0.5" style="color: var(--logo-subtexto)">
            INTEGRAL SERVICES
        </span>
    </div>
</div>
