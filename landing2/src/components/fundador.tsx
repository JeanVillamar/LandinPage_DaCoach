import { ClipRevealText } from "./titulo";

export function Fundador() {
  return (
    <section className="section founder-section" id="nosotros">
      <div className="container founder-grid">
        <div className="founder-portrait-wrap">
          <div className="founder-portrait" aria-hidden="true">
            <span>DC</span>
          </div>
          <p className="founder-portrait__caption">Foto próximamente</p>
        </div>

        <div className="founder-copy">
          <p className="eyebrow">
            <i /> Quién está detrás
          </p>
          <ClipRevealText
            as="h2"
            lines={[
              "No empezamos por la herramienta.",
              "Empezamos entendiendo cómo",
              "trabaja tu empresa.",
            ]}
          />
          <p className="lead">
            Fundador y consultor principal de DaCoach. Antes de proponer una
            automatización, se sienta con tu equipo a entender qué se repite,
            dónde se traba el proceso y qué depende del criterio de una
            persona — porque esa mirada de negocio, y no la tecnología, es el
            punto de partida de cada proyecto.
          </p>
        </div>
      </div>
    </section>
  );
}
