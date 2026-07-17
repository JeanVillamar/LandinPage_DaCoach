// Chat del asistente virtual.
//
// Es la única parte del sitio que necesita JavaScript. La clasificación de la
// consulta la hace el servidor: aquí no se inspecciona el texto del visitante,
// sólo se obedece a `abreSolicitudDeDiagnostico`.

const SALUDO =
  '¡Hola! Soy el asistente virtual de DaCoach. Puedo responder preguntas sobre cómo la IA ayuda a tu empresa o ayudarte a agendar un diagnóstico. ¿De qué te gustaría hablar?';

export function activarAsistente() {
  const seccion = document.querySelector('[data-asistente]');

  if (!seccion) {
    return;
  }

  const historial = seccion.querySelector('[data-historial-del-asistente]');
  const formulario = seccion.querySelector('[data-formulario-del-asistente]');
  const entrada = formulario.querySelector('input[name="mensaje"]');
  const error = seccion.querySelector('[data-error-del-asistente]');
  const formularioDeLead = seccion.querySelector('[data-formulario-de-lead]');
  const errorDelLead = seccion.querySelector('[data-error-del-lead]');
  const paneles = [...seccion.querySelectorAll('[data-panel-asistente]')];

  let esperando = false;

  function mostrarPanel(cual) {
    for (const panel of paneles) {
      panel.hidden = panel.dataset.panelAsistente !== cual;
    }
  }

  function hora() {
    return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  }

  function burbuja(emisor, texto) {
    const fila = document.createElement('div');
    fila.className = `flex gap-3 max-w-[85%] ${emisor === 'visitante' ? 'self-end flex-row-reverse' : 'self-start'}`;

    const avatar = document.createElement('div');
    avatar.className = `w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 ${
      emisor === 'visitante' ? 'bg-cyan-accent text-deep-navy' : 'bg-white/15 text-white'
    }`;
    avatar.innerHTML = `<svg class="w-4 h-4" aria-hidden="true"><use href="/assets/iconos.svg#${
      emisor === 'visitante' ? 'user' : 'bot'
    }"></use></svg>`;

    const columna = document.createElement('div');

    const globo = document.createElement('div');
    globo.className = `p-3.5 rounded-2xl leading-relaxed ${
      emisor === 'visitante'
        ? 'bg-brand-blue text-white rounded-tr-none'
        : 'bg-white/[0.04] border border-white/10 text-slate-100 rounded-tl-none'
    }`;
    globo.textContent = texto;

    const marca = document.createElement('span');
    marca.className = 'text-[9px] text-slate-500 mt-1 block px-1';
    marca.textContent = hora();

    columna.append(globo, marca);
    fila.append(avatar, columna);
    historial.append(fila);
    historial.scrollTop = historial.scrollHeight;
  }

  function mostrarSugerencias(acciones) {
    if (acciones.length === 0) {
      return;
    }

    const grupo = document.createElement('div');
    grupo.className = 'flex flex-wrap gap-2 self-start';

    for (const accion of acciones) {
      const boton = document.createElement('button');
      boton.type = 'button';
      boton.textContent = accion;
      boton.className =
        'bg-white/5 hover:bg-cyan-accent hover:text-deep-navy text-white text-xs py-1.5 px-3 rounded-full transition-all border border-white/10 cursor-pointer';
      boton.addEventListener('click', () => {
        grupo.remove();
        preguntar(accion);
      });
      grupo.append(boton);
    }

    historial.append(grupo);
    historial.scrollTop = historial.scrollHeight;
  }

  function escribiendo() {
    const fila = document.createElement('div');
    fila.className = 'flex gap-3 self-start max-w-[85%]';
    fila.innerHTML = `
      <div class="w-8 h-8 rounded-full bg-white/15 text-white flex items-center justify-center">
        <svg class="w-4 h-4" aria-hidden="true"><use href="/assets/iconos.svg#bot"></use></svg>
      </div>
      <div class="bg-white/[0.04] border border-white/10 p-3.5 rounded-2xl rounded-tl-none flex items-center gap-1.5">
        <span class="w-2 h-2 rounded-full bg-cyan-accent animate-bounce"></span>
        <span class="w-2 h-2 rounded-full bg-cyan-accent animate-bounce" style="animation-delay: 150ms"></span>
        <span class="w-2 h-2 rounded-full bg-cyan-accent animate-bounce" style="animation-delay: 300ms"></span>
      </div>`;

    historial.append(fila);
    historial.scrollTop = historial.scrollHeight;

    return fila;
  }

  async function preguntar(texto) {
    if (esperando || texto.trim() === '') {
      return;
    }

    esperando = true;
    error.hidden = true;
    burbuja('visitante', texto);
    entrada.value = '';

    const indicador = escribiendo();

    try {
      const respuesta = await fetch('/api/asistente/consultas', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ mensaje: texto }),
      });

      const datos = await respuesta.json();
      indicador.remove();

      if (!respuesta.ok) {
        throw new Error(datos.error ?? 'El asistente no pudo responder.');
      }

      burbuja('bot', datos.respuesta);
      mostrarSugerencias(datos.accionesSugeridas ?? []);

      if (datos.abreSolicitudDeDiagnostico) {
        mostrarPanel('formulario');
      }
    } catch (fallo) {
      indicador.remove();
      error.textContent = 'No se pudo establecer conexión. Por favor, vuelve a intentarlo.';
      error.hidden = false;
      console.error(fallo);
    } finally {
      esperando = false;
    }
  }

  formulario.addEventListener('submit', (evento) => {
    evento.preventDefault();
    preguntar(entrada.value);
  });

  for (const boton of seccion.querySelectorAll('[data-pregunta-sugerida]')) {
    boton.addEventListener('click', () => preguntar(boton.dataset.preguntaSugerida));
  }

  formularioDeLead?.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    errorDelLead.hidden = true;

    const envio = formularioDeLead.querySelector('button[type="submit"]');
    envio.disabled = true;

    try {
      const respuesta = await fetch(formularioDeLead.action, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(new FormData(formularioDeLead))),
      });

      const datos = await respuesta.json();

      if (!respuesta.ok || !datos.exito) {
        throw new Error(datos.mensaje ?? 'No se pudo registrar la solicitud.');
      }

      formularioDeLead.reset();
      mostrarPanel('exito');
      burbuja('bot', datos.mensaje);
    } catch (fallo) {
      errorDelLead.textContent = fallo.message;
      errorDelLead.hidden = false;
    } finally {
      envio.disabled = false;
    }
  });

  for (const volver of seccion.querySelectorAll('[data-volver-del-lead]')) {
    volver.addEventListener('click', () => mostrarPanel('informacion'));
  }

  seccion.querySelector('[data-reiniciar-asistente]')?.addEventListener('click', () => {
    historial.replaceChildren();
    error.hidden = true;
    formularioDeLead?.reset();
    mostrarPanel('informacion');
    burbuja('bot', SALUDO);
  });

  mostrarPanel('informacion');
  burbuja('bot', SALUDO);
}
