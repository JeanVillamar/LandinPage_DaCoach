// Animación del flujo de la portada: recorre los pasos en bucle y se detiene
// mientras el visitante señala uno.

const INTERVALO = 2800;

export function activarFlujoInteligente() {
  const contenedor = document.querySelector('[data-flujo-inteligente]');

  if (!contenedor) {
    return;
  }

  const pasos = [...contenedor.querySelectorAll('[data-paso-del-flujo]')];
  const detalle = contenedor.querySelector('[data-detalle-del-flujo]');
  const textoPorDefecto = detalle?.textContent ?? '';

  if (pasos.length === 0) {
    return;
  }

  let actual = 0;
  let fijado = null;
  let temporizador;

  function pintar() {
    const activo = fijado ?? actual;

    pasos.forEach((paso, indice) => {
      paso.dataset.activo = String(indice === activo);
    });

    if (!detalle) {
      return;
    }

    if (fijado === null) {
      detalle.textContent = textoPorDefecto;

      return;
    }

    const paso = pasos[fijado];
    const etiqueta = paso.querySelector('h3')?.textContent.trim() ?? '';
    const descripcion = paso.querySelector('p')?.textContent.trim() ?? '';
    detalle.textContent = `👉 ${etiqueta}: ${descripcion}`;
  }

  function avanzar() {
    actual = (actual + 1) % pasos.length;
    pintar();
  }

  function reanudar() {
    clearInterval(temporizador);
    temporizador = setInterval(avanzar, INTERVALO);
  }

  pasos.forEach((paso, indice) => {
    const fijar = () => {
      fijado = indice;
      clearInterval(temporizador);
      pintar();
    };

    const soltar = () => {
      fijado = null;
      pintar();
      reanudar();
    };

    paso.addEventListener('mouseenter', fijar);
    paso.addEventListener('mouseleave', soltar);
    paso.addEventListener('focusin', fijar);
    paso.addEventListener('focusout', soltar);
  });

  pintar();
  reanudar();
}
