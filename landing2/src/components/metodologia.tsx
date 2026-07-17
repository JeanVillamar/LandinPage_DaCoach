import { Check } from "lucide-react";
import { ClipRevealText } from "./titulo";

const steps = [
  {
    title: "Conversación inicial",
    body: "Escuchamos qué te está costando tiempo o dinero, sin asumir que la respuesta es automatizar.",
  },
  {
    title: "Mapeo del proceso",
    body: "Documentamos cómo funciona el proceso hoy, paso a paso, con quienes lo ejecutan.",
  },
  {
    title: "Identificación del cuello de botella",
    body: "Señalamos exactamente dónde se pierde tiempo o se generan errores.",
  },
  {
    title: "Evaluación de viabilidad",
    body: "Definimos si automatizar tiene sentido — y si no, te lo decimos.",
  },
  {
    title: "Prototipo",
    body: "Construimos una primera versión funcional sobre un caso real, antes de comprometer todo el alcance.",
  },
  {
    title: "Implementación",
    body: "Llevamos el prototipo a producción, conectado a las herramientas que ya usas.",
  },
  {
    title: "Medición y mejora",
    body: "Revisamos resultados con datos reales y ajustamos el proceso con el tiempo.",
  },
];

export function Metodologia() {
  return (
    <section className="section methodology-section" id="metodologia">
      <div className="container">
        <p className="eyebrow">
          <i /> Método
        </p>
        <ClipRevealText
          as="h2"
          lines={["Una manera consultiva", "de decidir si conviene automatizar."]}
        />

        <ol className="methodology-list">
          {steps.map((step, index) => (
            <li className="methodology-list__item" key={step.title}>
              <span className="methodology-list__number" aria-hidden="true">
                {String(index + 1).padStart(2, "0")}
              </span>
              <div>
                <h3>{step.title}</h3>
                <p>{step.body}</p>
              </div>
            </li>
          ))}
        </ol>
      </div>
    </section>
  );
}

const guarantees = [
  "Te decimos si no vale la pena automatizar.",
  "Alcance claro antes de desarrollar.",
  "Entregas por etapas.",
  "Medición de resultados.",
  "Documentación del proceso.",
];

export function Garantias() {
  return (
    <section className="section guarantees-section" id="garantias">
      <div className="container guarantees-grid">
        <div className="guarantees-copy">
          <p className="eyebrow">
            <i /> Forma de trabajo
          </p>
          <ClipRevealText as="h2" lines={["Claridad antes que", "cualquier desarrollo."]} />
          <p className="lead">
            No manejamos tarifas cerradas de catálogo: cada proyecto depende
            del proceso y del alcance que definamos juntos.
          </p>
        </div>

        <ul className="guarantees-list">
          {guarantees.map((item) => (
            <li key={item}>
              <Check aria-hidden="true" />
              <span>{item}</span>
            </li>
          ))}
        </ul>
      </div>
    </section>
  );
}
