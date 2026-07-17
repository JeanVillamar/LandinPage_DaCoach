// Raíz de composición del JavaScript del sitio.
//
// Cada módulo mejora una sección ya renderizada por el servidor y se desactiva
// solo si su marcado no está presente. Salvo el asistente, que es conversacional
// por naturaleza, todo el contenido funciona sin JavaScript.

import { activarNavegacion } from './navegacion.js';
import { activarFlujoInteligente } from './flujo-inteligente.js';
import { activarComparativaDeOperacion } from './comparativa-de-operacion.js';
import { activarMetodologia } from './metodologia.js';
import { activarCasos } from './casos.js';
import { activarDemostracionDeReservas } from './demostracion-de-reservas.js';
import { activarAsistente } from './asistente.js';
import { activarFormularioDeDiagnostico } from './formulario-de-diagnostico.js';

activarNavegacion();
activarFlujoInteligente();
activarComparativaDeOperacion();
activarMetodologia();
activarCasos();
activarDemostracionDeReservas();
activarAsistente();
activarFormularioDeDiagnostico();
