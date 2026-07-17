// Mejora el formulario de diagnóstico: lo envía sin recargar la página.
//
// Sin JavaScript el formulario sigue funcionando con un POST normal, y el
// servidor responde con POST-Redirect-GET y un aviso de sesión. Aquí sólo se
// evita el salto de página.

export function activarFormularioDeDiagnostico() {
  const formulario = document.querySelector('[data-formulario-de-diagnostico]');

  if (!formulario) {
    return;
  }

  const seccion = formulario.closest('section');
  const panelDeExito = seccion.querySelector('[data-panel-exito]');
  const mensajeDeExito = seccion.querySelector('[data-mensaje-exito]');
  const error = formulario.querySelector('[data-error-del-formulario]');
  const envio = formulario.querySelector('button[type="submit"]');
  const textoDelBoton = formulario.querySelector('[data-texto-del-boton]');

  formulario.addEventListener('submit', async (evento) => {
    evento.preventDefault();
    error.hidden = true;
    envio.disabled = true;
    textoDelBoton.textContent = 'Enviando...';

    try {
      const respuesta = await fetch(formulario.action, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(new FormData(formulario))),
      });

      const datos = await respuesta.json();

      if (!respuesta.ok || !datos.exito) {
        throw new Error(datos.mensaje ?? 'Hubo un error al enviar el formulario. Por favor, inténtalo de nuevo.');
      }

      formulario.reset();
      formulario.hidden = true;
      mensajeDeExito.textContent = datos.mensaje;
      panelDeExito.hidden = false;
    } catch (fallo) {
      error.textContent = fallo.message;
      error.hidden = false;
    } finally {
      envio.disabled = false;
      textoDelBoton.textContent = 'Solicitar diagnóstico';
    }
  });

  seccion.querySelector('[data-reiniciar-formulario]')?.addEventListener('click', () => {
    panelDeExito.hidden = true;
    formulario.hidden = false;
  });
}
