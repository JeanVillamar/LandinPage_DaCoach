import { Check, Play } from "lucide-react";

const POINTS = [
  "Automatización de procesos",
  "Soluciones adaptadas al negocio",
  "Integración con sistemas existentes",
  "Inteligencia artificial aplicada",
  "Acompañamiento durante la implementación",
];

export default function ShowcaseSection() {
  return (
    <section id="beneficios" className="bg-bg-0 px-6 py-24">
      <div className="mx-auto grid max-w-6xl items-center gap-14 md:grid-cols-2">
        <div>
          <h2 className="font-serif text-3xl font-bold leading-snug text-text-100">
            Así transformamos procesos en soluciones digitales
          </h2>
          <p className="mt-4 text-text-300">
            Nuestra plataforma te permite automatizar procesos repetitivos y brindar soporte
            inmediato, superando la satisfacción del cliente y liberando tiempo para tu equipo.
          </p>

          <ul className="mt-8 space-y-4">
            {POINTS.map((point) => (
              <li key={point} className="flex items-center gap-3 text-text-200">
                <span className="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-accent/10 text-accent">
                  <Check className="h-3.5 w-3.5" />
                </span>
                {point}
              </li>
            ))}
          </ul>
        </div>

        <div className="relative overflow-hidden rounded-3xl">
          <img
            src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=900&q=80"
            alt="Equipo revisando una solución de automatización con inteligencia artificial"
            className="h-full w-full object-cover"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent" />
          <span className="absolute left-6 top-6 rounded-md bg-white/90 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-text-100">
            AI Automation Solutions
          </span>
          <button
            type="button"
            aria-label="Reproducir video"
            className="absolute left-1/2 top-1/2 flex h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white text-accent shadow-lg transition-transform hover:scale-105"
          >
            <Play className="h-5 w-5 fill-current" />
          </button>
        </div>
      </div>
    </section>
  );
}
