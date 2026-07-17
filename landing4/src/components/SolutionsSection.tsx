import {
  Bot,
  MessageCircle,
  Share2,
  Code2,
  Smile,
  BarChart3,
  UserPlus,
  MessagesSquare,
  type LucideIcon,
} from "lucide-react";

const MAIN_SOLUTIONS: { icon: LucideIcon; title: string; description: string }[] = [
  {
    icon: Bot,
    title: "Automatización de procesos",
    description:
      "Optimiza flujos de trabajo repetitivos mediante tecnología avanzada, reduciendo errores y liberando a tu equipo para tareas de mayor valor.",
  },
  {
    icon: MessageCircle,
    title: "Agentes inteligentes",
    description:
      "Despliega asistentes virtuales impulsados por IA que interactúan de forma natural con usuarios y clientes 24/7 en múltiples canales.",
  },
];

const MINI_SOLUTIONS: { icon: LucideIcon; title: string }[] = [
  { icon: Share2, title: "Integración de sistemas" },
  { icon: Code2, title: "Desarrollo de soluciones digitales" },
  { icon: Smile, title: "Experiencia del cliente" },
  { icon: BarChart3, title: "Analítica y seguimiento" },
  { icon: UserPlus, title: "Captación y gestión de oportunidades" },
  { icon: MessagesSquare, title: "Canales digitales (incl. WhatsApp)" },
];

export default function SolutionsSection() {
  return (
    <section id="soluciones" className="bg-bg-0 px-6 py-24">
      <div className="mx-auto max-w-5xl">
        <h2 className="text-center font-serif text-3xl font-bold text-text-100">
          Soluciones que transforman tu operación
        </h2>

        <div className="mt-14 grid gap-6 md:grid-cols-2">
          {MAIN_SOLUTIONS.map(({ icon: Icon, title, description }) => (
            <div key={title} className="rounded-3xl bg-bg-200 p-8">
              <div className="flex items-center gap-3">
                <span className="flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent">
                  <Icon className="h-5 w-5" />
                </span>
                <h3 className="font-serif text-xl text-text-100">{title}</h3>
              </div>
              <p className="mt-4 text-sm leading-relaxed text-text-300">{description}</p>
            </div>
          ))}
        </div>

        <div className="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
          {MINI_SOLUTIONS.map(({ icon: Icon, title }) => (
            <div key={title} className="flex items-center gap-3 rounded-2xl bg-bg-200 p-5">
              <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-bg-100 text-accent">
                <Icon className="h-4.5 w-4.5" />
              </span>
              <span className="text-sm text-text-200">{title}</span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
