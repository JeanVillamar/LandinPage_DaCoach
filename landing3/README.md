# Landing — DaCoach Integral Services

PHP plano, sin dependencias ni build. Subir la carpeta a cualquier hosting con PHP 7.4+ y funciona.

## ⚠️ Modo borrador — leer antes que nada

`config.php` tiene `'borrador' => true`. Tres bloques llevan **datos inventados**:

- **El caso de éxito** (`'caso'`): las cifras 68% / 12h / 4min son ficticias.
- **Los precios** (`'arranque'`): US$ 1.500 y los plazos son ficticios.
- **El equipo** (`'equipo'`): "Nombre Apellido" y su biografía son ficticios.

Con la bandera en `true`, esos tres bloques muestran un aviso rojo de "ejemplo". **Cambia los datos por los reales y pon la bandera en `false`.** Si publicas con datos inventados sin el aviso, estás afirmando cosas falsas ante clientes reales.

El caso va **anonimizado** ("Centro médico privado · 24 personas") a propósito: atribuirle cifras inventadas a Eminat o a Alejandro Magno —que salen con nombre y logo en esta misma página— sería poner resultados falsos en boca de una empresa real. Cuando tengas cifras reales **y permiso por escrito**, pon el nombre.

## Antes de publicar

Todo lo editable está en **`config.php`**. Hay cuatro valores de relleno que debes cambiar:

| Clave | Actualmente | Nota |
|---|---|---|
| `contacto.whatsapp` | `50700000000` | Solo dígitos con código de país, sin `+` ni espacios. |
| `contacto.whatsapp_visible` | `+507 0000-0000` | Como se muestra en el pie. |
| `contacto.email_publico` | `hola@dacoach.example` | El que ve el visitante. |
| `contacto.email_remitente` | `no-reply@dacoach.example` | **Debe ser del mismo dominio que envía**, o los correos caen en spam. |
| `empresa.url` | `https://dacoach.example` | Para el canonical y Open Graph. |

`contacto.email_destino` ya está en `raul@eminat.net` — ahí llegan los leads.

## Logo de DaCoach

Un monograma: la **D** con la contraforma circular, que recupera el punto verde de la marca.

| Archivo | Uso |
|---|---|
| `assets/logos/dacoach-isotipo.svg` | Verde sobre fondo claro. |
| `assets/logos/dacoach-isotipo-blanco.svg` | Sobre fondos oscuros o fotos. |
| `assets/logos/dacoach-ficha.svg` | Cuadrado verde con la D calada. Favicon, avatar de redes, imagen de perfil. |

La contraforma es un **agujero real** (`fill-rule="evenodd"`), no un círculo del color del fondo: el logo se puede poner sobre cualquier color sin retocarlo.

En la cabecera y el pie el isotipo va **en línea** (función `isotipo()` de `index.php`) para que herede el color del contexto con `currentColor` — verde en claro, blanco en oscuro. Un `<img>` no permite eso.

Se probó a 16, 24, 32 y 64px antes de elegirlo; se descartaron una marca de convergencia (a 16px se leía como el botón "saltar al final", `>|`) y un arco con punto (se leía como "C·").

El wordmark "DaCoach Integral Services" es **texto vivo**, no una imagen. Si necesitas el lockup en un archivo para imprenta, hay que convertir el texto a curvas con Illustrator o Inkscape.

## Logos de clientes

Coloca los archivos en `assets/logos/` con estos nombres base:

- `eminat-medical-center`
- `alejandro-magno`
- `eminat-clinical-research`

**La extensión da igual** (`.svg`, `.png`, `.webp`, `.jpg`): la función `logo_de()` de `index.php` la detecta sola. **Si el archivo no está, se muestra solo el nombre en texto** y la landing no se rompe.

### Por qué van como ficha y no como wordmark

Los tres logos actuales traen fondo sólido incrustado (negro, turquesa y gris pizarra). El tratamiento clásico de tira de logos —transparente, en escala de grises sobre el fondo hueso— los convertiría en tres cuadrados grises apagados. Por eso se recortan como ficha redondeada de 52px con el nombre al lado.

Si consigues **versiones con fondo transparente** (pídeselas a cada empresa: SVG o PNG), la tira puede pasar al tratamiento de wordmark, más ligero y elegante. Con fondo incrustado, la ficha es la mejor opción.

Las imágenes se recortan con `object-fit: cover`, que asume logos cuadrados. Si alguno llega apaisado, cambia esa propiedad a `contain` en `.prueba__ficha`.

## Cómo llegan los leads

Cada envío hace dos cosas, en este orden:

1. **Se guarda en `data/leads.csv`** (el directorio se crea solo en el primer envío).
2. **Se envía por correo** a `email_destino` con `mail()`.

El CSV se escribe *antes* del correo a propósito: si `mail()` falla en el servidor, el lead no se pierde y el fallo queda en el log de errores de PHP. Revisa el CSV de vez en cuando para confirmar que ningún correo se está perdiendo.

`data/` se protege con un `.htaccess` (`Require all denied`) generado automáticamente. **Eso solo funciona en Apache.** Si usas Nginx, bloquea la ruta en tu configuración:

```nginx
location ^~ /data/ { deny all; }
```

Si `mail()` no está disponible en tu hosting (pasa a menudo), cambia esa llamada en `includes/formulario.php` por SMTP con PHPMailer.

## Protecciones del formulario

- **Token CSRF** por sesión.
- **Honeypot**: campo `sitio_web` oculto; si viene lleno se responde "éxito" y se descarta en silencio.
- **Validación en servidor** de nombre, correo y longitud del mensaje. El `sector` se valida contra la lista blanca de `config.php`.
- **Anti-inyección de cabeceras**: se eliminan saltos de línea de todos los campos.
- **POST/Redirect/GET**: refrescar el navegador no reenvía el lead.

Todo escapado con `htmlspecialchars` en la salida.

## El check animado (Lottie) de la confirmación

Es la única dependencia externa de todo el proyecto — el resto es cero-dependencias a propósito. Por eso está acotada al máximo:

- **El JSON de la animación es de autoría propia** (`assets/lottie/exito.json`): un círculo y un check que se dibujan por trazo, en el verde de marca. No se descargó de ningún banco de animaciones de terceros.
- **La librería `lottie-web` solo se carga en la pantalla de éxito** (`?enviado=1`), nunca en una visita normal. Mira `index.php`: el `<script>` del CDN está dentro de `<?php if ($enviado): ?>`.
- **El SVG estático de siempre sigue en el DOM como respaldo.** Si el CDN falla —red, bloqueador de anuncios, lo que sea— `window.lottie` nunca existe, `app.js` no hace nada, y lo único que se ve es el mismo check estático que había antes. Cero riesgo de romper la pantalla de confirmación de un lead.

Si más adelante quieres una animación distinta (o una descargada de LottieFiles), reemplaza `assets/lottie/exito.json` por el nuevo archivo — el resto del cableado no cambia.

## El módulo Antes / Después

Vive en `#transformacion`. Los textos están en los arrays `$antes` y `$despues` de `index.php`, **emparejados por índice**: la tarjeta 3 de `$antes` es la cara opuesta de la 3 de `$despues`. Si añades una a un array, añade su pareja al otro.

No son dos listas que se cruzan: es **una sola rejilla de 7 tarjetas de dos caras** que giran sobre su eje Y, escalonadas 80ms cada una. La misma operación transformándose.

Tres cosas que parecen decorativas pero **son el mensaje**, y conviene no "arreglarlas":

1. **Las tarjetas del "antes" están torcidas** (`--r`, entre -1.4° y +1.3°) y **se van apagando** (`--o`, de 1 a 0.55). El desorden y el desvanecido dicen "la información se pierde por el camino". Al pasar el cursor por la rejilla, todas vuelven al 100%.
2. **El suelo de opacidad es 0.55 a propósito.** Por debajo el texto deja de leerse.
3. **Al girar, la rotación va a 0.** El caos se endereza. Por eso `.cambio.es-despues .cambio__giro` lleva `rotate(0deg)` además del `rotateY(180deg)`.

Las dos caras están siempre en el DOM y ocupan la misma celda de grid, así que la tarjeta mide lo que la cara más alta. `app.js` cambia el `aria-hidden` de cada cara para que un lector de pantalla no lea la que está de espaldas.

## Movimiento

- Las secciones entran con `.aparece` (un `IntersectionObserver` les pone `.es-visible`).
- Dentro de una sección, los hijos con `.revela` y un `--i` entran escalonados a 55ms. **`.revela` solo funciona dentro de un `.aparece`** — si lo pones fuera, el elemento se queda invisible para siempre.
- **El lienzo de la portada** dibuja nodos que se enlazan al acercarse, y el cursor los atrae. Se detiene solo al salir de pantalla o al cambiar de pestaña, para no gastar batería.
- Todo se apaga con `prefers-reduced-motion`, menos la rotación del "antes", que es información.

### Las secciones "frase" (`#caso` en adelante, `.frase`)

Las dos bandas a pantalla completa con una sola frase grande son las más elaboradas de la página. Cada una tiene, de atrás hacia adelante:

1. **`.frase__media`** — la foto de fondo (`imagen1.webp` / `imagen2.webp`), con `filter: blur(9px)` **estático** (no animado — un blur que no cambia frame a frame no cuesta nada extra) y parallax: se mueve más lento que el scroll vía `--frase-media-y`, que `app.js` recalcula en cada scroll.
   **El blur está para disolver el logo y el texto que traía la foto original ("TECNOLOGÍA CON PROPÓSITO", un isotipo distinto al de DaCoach).** Sin él, ese texto compite visualmente con el titular real de la sección. Si cambias la foto por una sin texto encima, puedes bajar el blur o quitarlo.
2. **`.frase::after`** — un degradado oscuro sobre la foto para que el texto blanco tenga contraste garantizado.
3. **`.frase__trama`** — una retícula técnica casi invisible (opacity .16), solo textura.
4. **`.frase__contenido`** — el número ("01 · Nuestro principio"), la frase en sí, y la firma. Tienen su propio parallax, más sutil, vía `--frase-contenido-y`.

**Por qué el texto no usa `filter: blur()` para su entrada** (aunque a primera vista sería la forma obvia de lograr un efecto "cinematográfico"): animar blur en las 10-14 palabras de una frase, a la vez, es caro — cada palabra fuerza su propia capa de composición y el navegador tiene que recalcularlas todas en cada frame de la transición. Eso es lo que hacía sentir el movimiento pesado. En su lugar, cada palabra vive dentro de un `<span>` con `overflow: clip` (barato) y solo se mueve con `transform` + `opacity` — el mismo efecto de "revelado premium" sin el coste. Al salir de pantalla, la salida es más rápida y sin escalonar (`.frase:not(.es-visible) ...`): una salida decidida, no la misma coreografía lenta hacia atrás.

Después de que el titular se asienta, un barrido de luz diagonal lo cruza una sola vez (`.frase__texto::after`, animación `barrido-frase`) — puro `transform`+`opacity` sobre un pseudo-elemento.

**No pude ver el movimiento de nada de esto en el navegador de esta herramienta** — su `requestAnimationFrame` se congela tras un solo fotograma, así que ni el lienzo de la portada ni el conteo de cifras del caso avanzan ahí dentro. Verifiqué la lógica leyendo los valores computados (con las transiciones desactivadas, para leer el estado final), pero el *tacto* real — si el ritmo se siente bien, si algo se siente lento — solo se puede juzgar en un navegador de verdad. Si algo no convence, dime qué exactamente (¿muy lento? ¿muy brusco? ¿en qué sección?) y ajusto los números.

## Estructura

```
landing/
├── index.php                 marcado y contenido
├── config.php                ← lo único que necesitas tocar
├── includes/formulario.php   validación y envío
├── assets/css/estilos.css    estilos (tokens de color arriba del archivo)
├── assets/js/app.js          cabecera y aparición al hacer scroll (opcional)
└── data/leads.csv            se genera solo
```

Sin JavaScript la landing funciona completa: solo pierde la animación de entrada.

## Probar en local

```bash
cd landing && php -S 127.0.0.1:8123
```

`mail()` no funciona con el servidor embebido, pero el lead sí se escribe en `data/leads.csv`.

## Cambiar la paleta

Los colores están como variables CSS al inicio de `assets/css/estilos.css`. El verde de acento es `--accent: #0e6b57`; cambiándolo (y `--accent-strong` / `--accent-tint`) se recolorea toda la página.
