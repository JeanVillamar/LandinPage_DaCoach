// Maqueta del bot de reservas de Alejandro Magno Astral.
//
// Es un guion cerrado que ilustra un proyecto ya entregado: no llama a ningún
// servidor y el pago es simulado. Por eso vive en el contexto CasosDeExito y no
// en AsistenteVirtual.

const SERVICIOS = ['Consulta online', 'Consulta presencial', 'Carta natal', 'Limpieza', 'Atención especial'];
const HORARIOS = ['Lunes - 10:00 AM', 'Lunes - 3:00 PM', 'Martes - 11:30 AM', 'Miércoles - 4:00 PM'];
const SALUDO = 'Bienvenido. ¿En qué tipo de consulta estás interesado?';

export function activarDemostracionDeReservas() {
  const contenedor = document.querySelector('[data-demostracion-de-reservas]');

  if (!contenedor) {
    return;
  }

  const historial = contenedor.querySelector('[data-historial-de-reservas]');
  let servicio = '';

  function burbuja(emisor, texto) {
    const fila = document.createElement('div');
    fila.className = `flex flex-col max-w-[85%] ${emisor === 'visitante' ? 'self-end items-end' : 'self-start items-start'}`;

    const globo = document.createElement('div');
    globo.className = `p-3 rounded-2xl leading-relaxed ${
      emisor === 'visitante'
        ? 'bg-brand-blue text-white rounded-tr-none'
        : 'bg-white/5 border border-white/10 text-slate-100 rounded-tl-none'
    }`;
    globo.textContent = texto;

    fila.append(globo);
    historial.append(fila);
    historial.scrollTop = historial.scrollHeight;

    return fila;
  }

  function opciones(etiquetas, alElegir, clases) {
    const grupo = document.createElement('div');
    grupo.className = clases;

    for (const etiqueta of etiquetas) {
      const boton = document.createElement('button');
      boton.type = 'button';
      boton.textContent = etiqueta;
      boton.className =
        'bg-white/10 hover:bg-cyan-accent hover:text-deep-navy text-white text-[11px] font-medium py-1 px-2.5 rounded-full transition-all border border-white/10 cursor-pointer';
      boton.addEventListener('click', () => {
        grupo.remove();
        alElegir(etiqueta);
      });
      grupo.append(boton);
    }

    historial.append(grupo);
    historial.scrollTop = historial.scrollHeight;
  }

  function elegirServicio(elegido) {
    servicio = elegido;
    burbuja('visitante', elegido);
    burbuja('bot', 'Excelente. Selecciona el día y horario disponible.');
    opciones(HORARIOS, elegirHorario, 'grid grid-cols-2 gap-1.5 w-[85%] self-start mt-1');
  }

  function elegirHorario(horario) {
    burbuja('visitante', horario);
    burbuja('bot', 'Tu cita está casi lista. Continúa con el pago para confirmar la reservación.');
    mostrarPago(horario);
  }

  function mostrarPago(horario) {
    const bloque = document.createElement('div');
    bloque.className = 'self-start w-[85%] mt-2 flex flex-col gap-2';

    const boton = document.createElement('button');
    boton.type = 'button';
    boton.textContent = '💳 Pagar Consulta Simulado';
    boton.className =
      'w-full bg-warm-accent hover:bg-white text-deep-navy font-sora font-bold py-2.5 px-4 rounded-xl shadow-lg transition-all cursor-pointer';

    const nota = document.createElement('p');
    nota.className = 'text-[9px] text-slate-400 text-center italic';
    nota.textContent = 'Demostración visual únicamente. No se realizan cobros reales.';

    boton.addEventListener('click', () => {
      bloque.remove();
      burbuja('bot', '💳 Procesando confirmación de reserva simulada...');
      burbuja(
        'bot',
        `✅ ¡Confirmado! Tu cita para "${servicio}" el día ${horario} ha sido agendada con éxito. Recibirás un correo con el enlace de acceso.`,
      );
    });

    bloque.append(boton, nota);
    historial.append(bloque);
    historial.scrollTop = historial.scrollHeight;
  }

  function reiniciar() {
    historial.replaceChildren();
    servicio = '';
    burbuja('bot', SALUDO);
    opciones(SERVICIOS, elegirServicio, 'flex flex-wrap gap-1.5 mt-2 w-[85%] self-start');
  }

  contenedor.querySelector('[data-reiniciar-demostracion]')?.addEventListener('click', reiniciar);
  reiniciar();
}
