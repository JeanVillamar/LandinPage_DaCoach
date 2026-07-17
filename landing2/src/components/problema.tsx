import { ClipRevealText } from "./titulo";

const symptoms = [
  {
    title: "Tareas manuales",
    body: "Alguien copia y pega la misma información todos los días.",
  },
  {
    title: "Información dispersa",
    body: "Cada área guarda sus datos en un lugar distinto.",
  },
  {
    title: "Errores que se repiten",
    body: "Se corrige lo mismo una y otra vez, sin resolver la causa.",
  },
  {
    title: "Trabajo duplicado",
    body: "Dos personas terminan haciendo lo mismo, sin saberlo.",
  },
];

export function Problema() {
  return (
    <section className="section problem-section" id="problema">
      <div className="container">
        <p className="eyebrow">
          <i /> El problema
        </p>
        <ClipRevealText
          as="h2"
          lines={["Todos creen que necesitan IA.", "Muchas veces solo tienen procesos rotos."]}
        />

        <div className="problem-grid">
          {symptoms.map((item) => (
            <div className="problem-card" key={item.title}>
              <h3>{item.title}</h3>
              <p>{item.body}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
