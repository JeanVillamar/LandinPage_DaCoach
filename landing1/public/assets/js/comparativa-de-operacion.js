// Conmutador antes/después. Los dos paneles ya vienen en el HTML; aquí sólo se
// alterna cuál está visible.

export function activarComparativaDeOperacion() {
  const conmutadores = [...document.querySelectorAll('[data-conmutador-operacion]')];
  const paneles = [...document.querySelectorAll('[data-panel-operacion]')];

  if (conmutadores.length === 0) {
    return;
  }

  function mostrar(estado) {
    for (const conmutador of conmutadores) {
      conmutador.setAttribute('aria-selected', String(conmutador.dataset.conmutadorOperacion === estado));
    }

    for (const panel of paneles) {
      panel.dataset.oculto = String(panel.dataset.panelOperacion !== estado);
    }
  }

  for (const conmutador of conmutadores) {
    conmutador.addEventListener('click', () => mostrar(conmutador.dataset.conmutadorOperacion));
  }
}
