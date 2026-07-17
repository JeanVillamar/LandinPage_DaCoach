export default function CtaBanner() {
  return (
    <section id="contacto" className="bg-[var(--navy-deep)] px-6 py-24 text-center">
      <div className="mx-auto max-w-2xl">
        <h2 className="text-balance font-serif text-4xl font-bold leading-tight text-white">
          Empieza a transformar tu empresa con tecnología
        </h2>
        <p className="mt-5 text-lg leading-relaxed text-sky-200">
          Conversemos sobre los procesos, oportunidades y soluciones digitales que pueden impulsar tu negocio.
        </p>
        <a
          href="#top"
          className="mt-8 inline-flex items-center justify-center rounded-lg bg-white px-7 py-3 text-xs font-bold uppercase tracking-wide text-[var(--navy-deep)] transition-colors hover:bg-sky-100"
        >
          Solicitar demo
        </a>
      </div>
    </section>
  );
}
