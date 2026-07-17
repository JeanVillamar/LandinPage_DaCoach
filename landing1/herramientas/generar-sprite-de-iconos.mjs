// Genera public/assets/iconos.svg a partir de lucide-static.
//
// Sustituye a lucide-react: en vez de un componente por icono, el sitio sirve un
// único sprite y las vistas lo referencian con <use href="/assets/iconos.svg#nombre">
// (ver Compartido\Infraestructura\Plantillas\Icono).

import { readFile, writeFile, mkdir } from 'node:fs/promises';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const raiz = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const origenDeIconos = resolve(raiz, 'node_modules/lucide-static/icons');
const destino = resolve(raiz, 'public/assets/iconos.svg');

/** Extrae el contenido interior de un <svg>, descartando la etiqueta externa. */
function interiorDelSvg(svg) {
  const apertura = svg.indexOf('>', svg.indexOf('<svg'));
  const cierre = svg.lastIndexOf('</svg>');

  if (apertura === -1 || cierre === -1) {
    throw new Error('El archivo no parece un SVG válido.');
  }

  return svg.slice(apertura + 1, cierre).trim();
}

const { iconos } = JSON.parse(await readFile(resolve(raiz, 'herramientas/iconos.json'), 'utf8'));
const faltantes = [];
const simbolos = [];

for (const nombre of iconos) {
  let svg;

  try {
    svg = await readFile(resolve(origenDeIconos, `${nombre}.svg`), 'utf8');
  } catch {
    faltantes.push(nombre);
    continue;
  }

  // Los atributos de trazo van en el <symbol> para que <use> los herede;
  // stroke="currentColor" es lo que permite colorear el icono con clases.
  simbolos.push(
    `<symbol id="${nombre}" viewBox="0 0 24 24" fill="none" stroke="currentColor" ` +
      `stroke-width="2" stroke-linecap="round" stroke-linejoin="round">${interiorDelSvg(svg)}</symbol>`,
  );
}

if (faltantes.length > 0) {
  console.error(
    `\nNo existen en lucide-static: ${faltantes.join(', ')}.\n` +
      `Revisa el nombre en herramientas/iconos.json (lucide renombra iconos entre versiones mayores).\n`,
  );
  process.exit(1);
}

await mkdir(dirname(destino), { recursive: true });
await writeFile(destino, `<svg xmlns="http://www.w3.org/2000/svg">${simbolos.join('')}</svg>\n`);

console.log(`Sprite generado con ${simbolos.length} iconos en public/assets/iconos.svg`);
