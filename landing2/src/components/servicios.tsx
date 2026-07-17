import { ClipRevealText } from "./titulo";

const services = [
  {
    title: "Diagnóstico de procesos",
    body: "Entendemos cómo trabaja tu equipo hoy y dónde se pierde tiempo, antes de proponer nada.",
  },
  {
    title: "Automatización operativa",
    body: "Tareas repetitivas que hoy hace una persona, resueltas por un flujo confiable.",
  },
  {
    title: "Agentes de IA",
    body: "Conversaciones y solicitudes que hoy esperan una respuesta, atendidas al momento.",
  },
  {
    title: "Integración de sistemas",
    body: "Tus herramientas actuales hablando entre sí, sin más copiar y pegar.",
  },
  {
    title: "Dashboards y reportes",
    body: "La información que necesitas para decidir, en un solo lugar y siempre al día.",
  },
  {
    title: "Acompañamiento y mejora continua",
    body: "Ajustamos el proceso con el tiempo, a medida que tu negocio cambia.",
  },
];

export function Servicios() {
  return (
    <section className="section services-section" id="servicios">
      <div className="container">
        <p className="eyebrow">
          <i /> Servicios
        </p>
        <ClipRevealText as="h2" lines={["Lo que resolvemos,", "explicado en resultados."]} />

        <div className="services-grid">
          {services.map((service, index) => (
            <div className="service-card" key={service.title}>
              <span className="service-card__index" aria-hidden="true">
                {String(index + 1).padStart(2, "0")}
              </span>
              <h3>{service.title}</h3>
              <p>{service.body}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
