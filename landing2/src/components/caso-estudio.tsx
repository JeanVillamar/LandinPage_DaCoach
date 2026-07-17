import { ClipRevealText } from "./titulo";

const stats = [
  { value: "18 h", label: "ahorradas por semana" },
  { value: "70%", label: "menos tareas manuales" },
  { value: "Minutos", label: "de respuesta al cliente, no horas" },
];

export function CasoEstudio() {
  return (
    <section className="section case-study" id="caso-estudio">
      <div className="container">
        <p className="eyebrow">
          <i /> Caso de estudio
        </p>
        <ClipRevealText as="h2" lines={["Un proceso real,", "con resultados medibles."]} />

        <div className="case-study__grid">
          <div className="case-study__narrative">
            <div>
              <h3>Problema</h3>
              <p>
                Una empresa de servicios recibía solicitudes de clientes por
                WhatsApp, correo y formularios web. Cada una se registraba a
                mano en el CRM, y el equipo perdía horas por semana solo
                copiando información.
              </p>
            </div>
            <div>
              <h3>Solución</h3>
              <p>
                Mapeamos el proceso completo, identificamos dónde se perdía
                más tiempo y construimos un flujo que centraliza cada
                solicitud, valida los datos y avisa al equipo
                automáticamente.
              </p>
            </div>
            <div>
              <h3>Resultado</h3>
              <p>
                El equipo dejó de hacer trabajo repetitivo y ahora dedica ese
                tiempo a atender los casos que sí requieren su criterio.
              </p>
            </div>
          </div>

          <div className="case-study__stats">
            {stats.map((stat, index) => (
              <div className="stat-card" key={stat.label}>
                <ClipRevealText
                  as="p"
                  className="stat-card__value"
                  lines={[stat.value]}
                  delay={index * 0.1}
                />
                <p className="stat-card__label">{stat.label}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
