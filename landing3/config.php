<?php
declare(strict_types=1);

/**
 * Único archivo que necesitas tocar para poner la landing en producción.
 */
return [
    // ------------------------------------------------------------------
    // MODO BORRADOR
    // El caso de éxito, los precios y el equipo llevan datos INVENTADOS.
    // Con esto en true, esos bloques muestran un aviso visible de "ejemplo".
    // Cambia los datos por los reales y pon esto en false antes de publicar.
    // ------------------------------------------------------------------
    'borrador' => true,

    'empresa' => [
        'nombre'    => 'DaCoach Integral Services',
        'marca'     => 'DaCoach',
        'tagline'   => 'Tecnología con propósito',
        'url'       => 'https://dacoach.example',
        'descripcion' => 'Consultoría, automatización e implementación de inteligencia artificial para pequeñas y medianas empresas.',
    ],

    'contacto' => [
        // A dónde llegan los leads del formulario.
        'email_destino'   => 'raul@eminat.net',
        // Debe ser una dirección del dominio desde donde se envía, o el correo cae en spam.
        'email_remitente' => 'no-reply@dacoach.example',
        // Solo dígitos, con código de país, sin + ni espacios.
        'whatsapp'         => '50700000000',
        'whatsapp_visible' => '+507 0000-0000',
        'whatsapp_mensaje' => 'Hola, vengo del sitio web y quiero conocer cómo pueden ayudarnos con inteligencia artificial.',
        'email_publico'    => 'hola@dacoach.example',
    ],

    // Social proof. Guarda cada logo en assets/logos/ con el nombre de 'archivo' y la
    // extensión que sea (svg, png, webp, jpg): se detecta sola.
    // Si el archivo no existe, se muestra el nombre en texto y la landing no se rompe.
    'clientes' => [
        ['nombre' => 'Eminat Medical Center',    'archivo' => 'eminat-medical-center'],
        ['nombre' => 'Alejandro Magno',          'archivo' => 'alejandro-magno'],
        ['nombre' => 'Eminat Clinical Research', 'archivo' => 'eminat-clinical-research'],
    ],

    // ---- DATOS INVENTADOS. Reemplazar. Ver 'borrador' arriba. ----------
    // Va anonimizado a propósito: atribuirle cifras inventadas a un cliente
    // con nombre y logo en esta misma página sería afirmar algo falso sobre
    // una empresa real. Cuando tengas cifras reales y permiso, pon el nombre.
    'caso' => [
        'cliente'  => 'Centro médico privado · 24 personas',
        'reto'     => 'Recepción respondía las mismas preguntas por WhatsApp todo el día. Las citas se confirmaban a mano y los pedidos de historia clínica se perdían entre correos.',
        'solucion' => 'Asistente en WhatsApp conectado a su agenda y a su sistema de pacientes. Resuelve lo repetitivo, y escala a recepción lo que necesita criterio.',
        'cifras'   => [
            ['valor' => 68, 'sufijo' => '%',  'label' => 'de las consultas las resuelve el asistente sin intervención'],
            ['valor' => 12, 'sufijo' => ' h', 'label' => 'que recupera recepción cada semana'],
            ['valor' => 4,  'sufijo' => ' min', 'label' => 'de respuesta media, antes de hasta 2 días'],
        ],
        'cita'  => 'Dejamos de vivir apagando incendios en el WhatsApp. Lo que llega ahora al equipo es lo que de verdad necesita una persona.',
        'firma' => 'Dirección de operaciones',
    ],

    // ---- DATOS INVENTADOS. Reemplazar. --------------------------------
    'arranque' => [
        ['paso' => 'Diagnóstico',     'precio' => 'Sin costo',          'plazo' => '30 minutos'],
        ['paso' => 'Primer proyecto', 'precio' => 'Desde US$ 1.500',    'plazo' => '4 a 6 semanas'],
        ['paso' => 'Acompañamiento',  'precio' => 'Mensual, cancelable', 'plazo' => 'Mientras te sirva'],
    ],

    // ---- DATOS INVENTADOS. Reemplazar (y añade foto). -----------------
    'equipo' => [
        [
            'nombre'  => 'Nombre Apellido',
            'rol'     => 'Fundador y consultor principal',
            'bio'     => 'Quince años conectando sistemas en empresas que no tenían equipo técnico propio. Antes de recomendar una herramienta, se sienta a ver cómo trabaja tu gente.',
            'foto'    => null, // 'assets/equipo/nombre.jpg' — si no hay, se dibujan las iniciales.
        ],
    ],

    'sectores_form' => [
        'Servicios profesionales y consultoría',
        'Salud, bienestar e investigación clínica',
        'Comercio, ventas y atención al cliente',
        'Educación y capacitación',
        'Citas o reservaciones',
        'Otro',
    ],
];
