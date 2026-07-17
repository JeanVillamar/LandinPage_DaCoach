// Abre y cierra la ficha de cada caso.
//
// El diálogo es un <dialog> nativo: showModal() ya atrapa el foco, cierra con
// Escape y vuelve el fondo inerte.

export function activarCasos() {
  for (const boton of document.querySelectorAll('[data-abrir-caso]')) {
    boton.addEventListener('click', () => {
      document.querySelector(`dialog[data-caso="${boton.dataset.abrirCaso}"]`)?.showModal();
    });
  }

  for (const dialogo of document.querySelectorAll('dialog[data-caso]')) {
    for (const cierre of dialogo.querySelectorAll('[data-cerrar-caso]')) {
      cierre.addEventListener('click', () => dialogo.close());
    }

    // Clic fuera de la tarjeta: el <dialog> ocupa toda la pantalla, así que se
    // compara contra el propio diálogo y no contra su contenido.
    dialogo.addEventListener('click', (evento) => {
      if (evento.target === dialogo) {
        dialogo.close();
      }
    });
  }
}
