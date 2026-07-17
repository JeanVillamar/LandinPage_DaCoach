import type React from "react";
import { Mail, CheckCircle2 } from "lucide-react";

// lucide-react ya no incluye iconos de marcas; se define el glifo de LinkedIn en línea.
function LinkedinIcon(props: React.SVGProps<SVGSVGElement>) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" {...props}>
      <path d="M20.45 20.45h-3.55v-5.57c0-1.33-.02-3.03-1.85-3.03-1.86 0-2.15 1.45-2.15 2.94v5.66H9.35V9h3.41v1.56h.05c.47-.9 1.63-1.85 3.36-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z" />
    </svg>
  );
}

export default function TeamSection() {
  return (
    <section id="nosotros" className="bg-bg-0 px-6 py-24">
      <div className="mx-auto max-w-5xl">
        <h2 className="text-center font-serif text-3xl font-bold text-text-100">Conoce a quien lidera la visión</h2>

        <div className="mt-14 grid items-center gap-12 md:grid-cols-2">
          <img
            src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=700&q=80"
            alt="Director ejecutivo de DaCoach"
            className="aspect-[4/5] w-full rounded-3xl object-cover"
          />

          <div>
            <h3 className="font-serif text-2xl text-text-100">Nombre del director</h3>
            <p className="mt-1 font-medium text-accent">Director Ejecutivo de DaCoach</p>

            <p className="mt-5 leading-relaxed text-text-300">
              Profesional con amplia experiencia en transformación digital, estrategia tecnológica,
              inteligencia artificial, automatización de procesos y desarrollo de negocios.
            </p>

            <ul className="mt-6 space-y-3">
              <li className="flex items-center gap-2 text-text-200">
                <CheckCircle2 className="h-5 w-5 text-accent" />
                Más de 15 años de experiencia
              </li>
              <li className="flex items-center gap-2 text-text-200">
                <CheckCircle2 className="h-5 w-5 text-accent" />
                Experiencia liderando la evolución digital corporativa
              </li>
            </ul>

            <div className="mt-6 flex gap-3">
              <a
                href="#"
                aria-label="LinkedIn"
                className="flex h-9 w-9 items-center justify-center rounded-full bg-bg-200 text-text-300 transition-colors hover:bg-accent hover:text-white"
              >
                <LinkedinIcon className="h-4 w-4" />
              </a>
              <a
                href="#"
                aria-label="Correo"
                className="flex h-9 w-9 items-center justify-center rounded-full bg-bg-200 text-text-300 transition-colors hover:bg-accent hover:text-white"
              >
                <Mail className="h-4 w-4" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
