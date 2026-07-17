import { Clock, RefreshCw, Link2, Users, LineChart, History, type LucideIcon } from "lucide-react";

const BENEFITS: { icon: LucideIcon; title: string; description: string }[] = [
  { icon: Clock, title: "Reducción de tareas manuales", description: "Libera tiempo operativo." },
  { icon: RefreshCw, title: "Procesos más rápidos y consistentes", description: "Calidad uniforme siempre." },
  { icon: Link2, title: "Mejor integración de información", description: "Datos conectados." },
  { icon: Users, title: "Mayor capacidad de atención", description: "Escala sin límites." },
  { icon: LineChart, title: "Decisiones basadas en datos", description: "Analítica en tiempo real." },
  { icon: History, title: "Escalabilidad operativa", description: "Crece con tu negocio." },
];

export default function EfficiencySection() {
  return (
    <section className="bg-bg-200 px-6 py-24">
      <div className="mx-auto grid max-w-6xl items-center gap-12 md:grid-cols-2">
        <img
          src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80"
          alt="Equipo colaborando en una sala de reuniones"
          className="h-full max-h-[420px] w-full rounded-3xl object-cover"
        />

        <div>
          <h2 className="font-serif text-3xl font-bold leading-snug text-text-100">
            Más eficiencia para tu equipo. Mejores experiencias para tus clientes.
          </h2>
          <p className="mt-4 text-text-300">Transforma tu operación de servicio al cliente con una solución diseñada para escalar.</p>

          <div className="mt-8 grid gap-6 sm:grid-cols-2">
            {BENEFITS.map(({ icon: Icon, title, description }) => (
              <div key={title} className="flex items-start gap-3">
                <span className="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-accent/10 text-accent">
                  <Icon className="h-5 w-5" />
                </span>
                <div>
                  <p className="text-sm font-semibold text-text-100">{title}</p>
                  <p className="text-sm text-text-400">{description}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
