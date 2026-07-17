import { useState } from "react";
import { ChevronDown } from "lucide-react";

const FAQS = [
  {
    question: "¿Qué tipo de soluciones desarrolla DaCoach?",
    answer:
      "Diseñamos automatizaciones de procesos, agentes inteligentes, integraciones de sistemas y canales digitales, siempre a la medida de la operación de cada cliente.",
  },
  {
    question: "¿Las soluciones se adaptan a cada empresa?",
    answer:
      "Sí. Partimos de un diagnóstico de tus procesos y objetivos antes de diseñar cualquier solución, para que responda a tu realidad operativa.",
  },
  {
    question: "¿Pueden integrarse con nuestros sistemas actuales?",
    answer:
      "Sí, nuestras soluciones se integran con los sistemas, CRMs y canales digitales que ya utiliza tu empresa, sin interrumpir tu operación.",
  },
  {
    question: "¿Cuánto demora una implementación?",
    answer:
      "El tiempo varía según el alcance del proyecto. Tras el diagnóstico inicial te compartimos un cronograma claro con etapas y entregables.",
  },
  {
    question: "¿Cómo protegen la información?",
    answer:
      "Aplicamos buenas prácticas de seguridad y confidencialidad en cada etapa del proyecto, protegiendo los datos de tu operación y tus clientes.",
  },
  {
    question: "¿Ofrecen acompañamiento después de la implementación?",
    answer:
      "Sí, brindamos acompañamiento continuo para monitorear resultados, ajustar la solución y seguir mejorando el desempeño en el tiempo.",
  },
];

export default function FaqAccordion() {
  const [openIndex, setOpenIndex] = useState<number | null>(null);

  return (
    <section className="bg-bg-0 px-6 py-24">
      <div className="mx-auto max-w-3xl">
        <h2 className="text-center font-serif text-3xl font-bold text-text-100">Preguntas Frecuentes</h2>

        <div className="mt-12 space-y-3">
          {FAQS.map((faq, index) => {
            const isOpen = openIndex === index;
            return (
              <div key={faq.question} className="overflow-hidden rounded-2xl bg-bg-100 shadow-sm">
                <button
                  type="button"
                  onClick={() => setOpenIndex(isOpen ? null : index)}
                  aria-expanded={isOpen}
                  className="flex w-full items-center justify-between gap-4 px-6 py-5 text-left font-serif font-semibold text-text-100"
                >
                  {faq.question}
                  <ChevronDown className={`h-4 w-4 shrink-0 text-text-400 transition-transform ${isOpen ? "rotate-180" : ""}`} />
                </button>
                {isOpen && <p className="px-6 pb-5 text-sm leading-relaxed text-text-300">{faq.answer}</p>}
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
