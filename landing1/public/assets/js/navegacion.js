// Barra de navegación: fondo al desplazarse, enlace activo y menú móvil.
//
// Los anclajes funcionan sin esto (son enlaces reales); aquí sólo se añade el
// estado visual.

export function activarNavegacion() {
  const barra = document.querySelector('[data-barra-de-navegacion]');

  if (!barra) {
    return;
  }

  const menu = document.querySelector('[data-menu-movil]');
  const enlaces = [...document.querySelectorAll('[data-enlace-de-navegacion]')];
  const secciones = new Map();

  for (const enlace of enlaces) {
    const id = enlace.dataset.enlaceDeNavegacion;

    if (!secciones.has(id)) {
      secciones.set(id, document.getElementById(id));
    }
  }

  function marcarActivo() {
    const posicion = window.scrollY + 200;
    let activo = null;

    for (const [id, seccion] of secciones) {
      if (seccion && seccion.offsetTop <= posicion) {
        activo = id;
      }
    }

    for (const enlace of enlaces) {
      enlace.dataset.activo = String(enlace.dataset.enlaceDeNavegacion === activo);
    }
  }

  function alDesplazarse() {
    barra.dataset.scrolled = String(window.scrollY > 20);
    marcarActivo();
  }

  function abrirMenu(abierto) {
    if (!menu) {
      return;
    }

    menu.dataset.abierto = String(abierto);
    document.querySelector('[data-abrir-menu]')?.setAttribute('aria-expanded', String(abierto));
    document.body.style.overflow = abierto ? 'hidden' : '';
  }

  document.querySelector('[data-abrir-menu]')?.addEventListener('click', () => {
    abrirMenu(menu?.dataset.abierto !== 'true');
  });

  document.querySelector('[data-cerrar-menu]')?.addEventListener('click', () => abrirMenu(false));

  menu?.querySelectorAll('a').forEach((enlace) => {
    enlace.addEventListener('click', () => abrirMenu(false));
  });

  document.addEventListener('keydown', (evento) => {
    if (evento.key === 'Escape') {
      abrirMenu(false);
    }
  });

  window.addEventListener('scroll', alDesplazarse, { passive: true });
  alDesplazarse();
}
