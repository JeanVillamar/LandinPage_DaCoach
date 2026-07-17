// Metodología: línea de tiempo en escritorio y acordeón en móvil.
//
// Las descripciones de todas las fases están en el HTML; esto sólo decide cuál
// se ve y pinta el progreso.

export function activarMetodologia() {
  activarLineaDeTiempo();
  activarAcordeon();
}

function activarLineaDeTiempo() {
  const botones = [...document.querySelectorAll('[data-fase]')];

  if (botones.length === 0) {
    return;
  }

  const detalles = [...document.querySelectorAll('[data-detalle-de-fase]')];
  const progreso = document.querySelector('[data-progreso-metodologia]');
  const total = botones.length;

  function seleccionar(numero) {
    for (const boton of botones) {
      const suyo = Number(boton.dataset.fase);
      boton.dataset.estado = suyo === numero ? 'activa' : suyo < numero ? 'completada' : 'pendiente';
    }

    for (const detalle of detalles) {
      detalle.hidden = Number(detalle.dataset.detalleDeFase) !== numero;
    }

    if (progreso) {
      progreso.style.width = `${((numero - 1) / (total - 1)) * 100}%`;
    }
  }

  for (const boton of botones) {
    boton.addEventListener('click', () => seleccionar(Number(boton.dataset.fase)));
  }

  seleccionar(1);
}

function activarAcordeon() {
  const botones = [...document.querySelectorAll('[data-acordeon-de-fase]')];

  for (const boton of botones) {
    boton.addEventListener('click', () => {
      const panel = document.getElementById(boton.getAttribute('aria-controls'));
      const abierto = boton.getAttribute('aria-expanded') === 'true';

      boton.setAttribute('aria-expanded', String(!abierto));

      if (panel) {
        panel.hidden = abierto;
      }
    });
  }
}
