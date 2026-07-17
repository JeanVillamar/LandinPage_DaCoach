import { ChevronDown } from "lucide-react";
import ClaudeChatInput from "@/components/ui/claude-style-chat-input";

const SUGGESTIONS = [
  "¿Qué soluciones ofrecen?",
  "Quiero automatizar un proceso",
  "¿Cómo aplican inteligencia artificial?",
  "Solicitar una demostración",
  "Hablar con un asesor",
];

export default function Hero() {
  const handleSendMessage: React.ComponentProps<typeof ClaudeChatInput>["onSendMessage"] = (data) => {
    console.log("Mensaje enviado desde el hero:", data);
  };

  return (
    <section id="top" className="bg-bg-0 px-6 pb-16 pt-20 text-center">
      <div className="mx-auto max-w-3xl">
        <div className="mx-auto mb-8 flex h-16 w-16 items-center justify-center rounded-2xl bg-accent" />

        <h1 className="text-balance font-serif text-4xl font-bold leading-tight text-text-100 sm:text-5xl">
          Buenos días, ¿en qué podemos ayudarte hoy?
        </h1>

        <p className="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-text-300">
          Soluciones digitales e inteligencia artificial para optimizar procesos, mejorar la experiencia del
          cliente y escalar tu operación.
        </p>

        <div className="mx-auto mt-10 max-w-2xl">
          <div className="mb-2 flex items-center gap-1.5 px-2">
            <span className="h-2 w-2 rounded-full bg-[var(--online-dot)]" />
            <span className="text-[11px] font-bold uppercase tracking-wide text-text-400">En línea</span>
          </div>
          <ClaudeChatInput onSendMessage={handleSendMessage} placeholder="Escribe tu pregunta aquí..." />
        </div>

        <div className="mx-auto mt-6 flex max-w-2xl flex-wrap justify-center gap-2.5">
          {SUGGESTIONS.map((text) => (
            <button
              key={text}
              type="button"
              className="rounded-full border border-bg-300 bg-bg-100 px-4 py-2 text-sm text-text-300 shadow-sm transition-colors hover:border-accent/40 hover:text-text-100"
            >
              {text}
            </button>
          ))}
        </div>

        <div className="mt-16 flex flex-col items-center gap-2 text-[11px] font-bold uppercase tracking-wide text-text-400">
          <span>Descubre cómo transformamos tu atención</span>
          <ChevronDown className="h-4 w-4 animate-bounce" />
        </div>
      </div>
    </section>
  );
}
