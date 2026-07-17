import { useRef, useState } from "react";
import { ChevronLeft, ChevronRight, ArrowRight } from "lucide-react";

const POSTS = [
  {
    image: "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=700&q=80",
    date: "12 Oct 2023",
    text: "Descubre cómo la IA está transformando la colaboración en equipos de alto rendimiento. La estrategia digital es el motor del cambio.",
  },
  {
    image: "https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=700&q=80",
    date: "10 Oct 2023",
    text: "La automatización de canales de atención como WhatsApp no es el futuro, es el presente. Mejora tu CX hoy mismo.",
  },
  {
    image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=700&q=80",
    date: "08 Oct 2023",
    text: "Visualiza el éxito de tu operación con dashboards inteligentes. Datos en tiempo real para decisiones estratégicas.",
  },
];

export default function BlogCarousel() {
  const [tab, setTab] = useState<"instagram" | "facebook">("instagram");
  const scrollerRef = useRef<HTMLDivElement>(null);

  const scrollBy = (direction: 1 | -1) => {
    scrollerRef.current?.scrollBy({ left: direction * 340, behavior: "smooth" });
  };

  return (
    <section id="casos-de-uso" className="bg-bg-200 px-6 py-24">
      <div className="mx-auto max-w-6xl">
        <div className="mx-auto max-w-2xl text-center">
          <h2 className="font-serif text-3xl font-bold text-text-100">Lo último de DaCoach</h2>
          <p className="mt-4 text-text-300">
            Conoce nuestras últimas publicaciones, novedades y contenidos sobre automatización, IA y
            transformación digital.
          </p>
        </div>

        <div className="mt-8 flex justify-center gap-2">
          <button
            type="button"
            onClick={() => setTab("instagram")}
            className={`rounded-full px-5 py-2 text-xs font-bold uppercase tracking-wide transition-colors ${
              tab === "instagram" ? "bg-[var(--navy-deep)] text-white" : "bg-bg-100 text-text-300"
            }`}
          >
            Instagram
          </button>
          <button
            type="button"
            onClick={() => setTab("facebook")}
            className={`rounded-full px-5 py-2 text-xs font-bold uppercase tracking-wide transition-colors ${
              tab === "facebook" ? "bg-[var(--navy-deep)] text-white" : "bg-bg-100 text-text-300"
            }`}
          >
            Facebook
          </button>
        </div>

        <div className="relative mt-10">
          <div ref={scrollerRef} className="flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth pb-2">
            {POSTS.map((post) => (
              <article
                key={post.text}
                className="w-full shrink-0 snap-start overflow-hidden rounded-3xl bg-bg-100 sm:w-[calc((100%-3rem)/3)]"
              >
                <img src={post.image} alt="" className="h-56 w-full object-cover" />
                <div className="p-6">
                  <div className="flex items-center justify-between">
                    <span className="rounded bg-bg-200 px-2 py-1 text-[11px] font-bold uppercase tracking-wide text-accent">
                      {tab === "instagram" ? "Instagram" : "Facebook"}
                    </span>
                    <span className="text-xs text-text-400">{post.date}</span>
                  </div>
                  <p className="mt-3 text-sm leading-relaxed text-text-300">{post.text}</p>
                  <a href="#" className="mt-4 inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wide text-accent">
                    Ver publicación
                    <ArrowRight className="h-3.5 w-3.5" />
                  </a>
                </div>
              </article>
            ))}
          </div>

          <button
            type="button"
            onClick={() => scrollBy(-1)}
            aria-label="Anterior"
            className="absolute left-0 top-1/2 hidden h-10 w-10 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-bg-100 text-text-300 shadow-md sm:flex"
          >
            <ChevronLeft className="h-4 w-4" />
          </button>
          <button
            type="button"
            onClick={() => scrollBy(1)}
            aria-label="Siguiente"
            className="absolute right-0 top-1/2 hidden h-10 w-10 translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-bg-100 text-text-300 shadow-md sm:flex"
          >
            <ChevronRight className="h-4 w-4" />
          </button>
        </div>
      </div>
    </section>
  );
}
