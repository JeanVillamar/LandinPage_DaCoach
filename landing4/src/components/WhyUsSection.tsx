import { Target, Share2, Puzzle, ShieldCheck, TrendingUp, HeartHandshake, type LucideIcon } from "lucide-react";

const FEATURES: { icon: LucideIcon; title: string; iconClass: string }[] = [
  { icon: Target, title: "Soluciones adaptadas a cada negocio", iconClass: "bg-blue-50 text-blue-700" },
  { icon: Share2, title: "Integración con sistemas existentes", iconClass: "bg-sky-50 text-sky-600" },
  {
    icon: Puzzle,
    title: "Experiencia en automatización e inteligencia artificial",
    iconClass: "bg-amber-100 text-amber-800",
  },
  { icon: ShieldCheck, title: "Enfoque en resultados medibles", iconClass: "bg-emerald-50 text-emerald-600" },
  { icon: TrendingUp, title: "Acompañamiento estratégico", iconClass: "bg-violet-50 text-violet-600" },
  { icon: HeartHandshake, title: "Desarrollo de soluciones a medida", iconClass: "bg-orange-50 text-orange-600" },
];

export default function WhyUsSection() {
  return (
    <section className="bg-bg-200 px-6 py-24">
      <div className="mx-auto max-w-5xl">
        <div className="mx-auto max-w-2xl text-center">
          <h2 className="font-serif text-3xl font-bold text-text-100">¿Por qué DaCoach?</h2>
          <p className="mt-4 text-text-300">
            No implementamos tecnología por moda. Diseñamos soluciones que responden a necesidades reales de
            tu operación.
          </p>
        </div>

        <div className="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          {FEATURES.map(({ icon: Icon, title, iconClass }) => (
            <div key={title} className="rounded-3xl bg-bg-100 p-7">
              <div className={`flex h-12 w-12 items-center justify-center rounded-xl ${iconClass}`}>
                <Icon className="h-5 w-5" />
              </div>
              <p className="mt-5 font-serif text-lg leading-snug text-text-100">{title}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
