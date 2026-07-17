const NAV_LINKS = [
  { label: "Soluciones", href: "#soluciones" },
  { label: "Cómo funciona", href: "#como-funciona" },
  { label: "Beneficios", href: "#beneficios" },
  { label: "Casos de uso", href: "#casos-de-uso" },
  { label: "Nosotros", href: "#nosotros" },
];

export default function Header() {
  return (
    <header className="sticky top-0 z-40 border-b border-bg-300 bg-bg-0/95 backdrop-blur">
      <div className="mx-auto flex h-[74px] max-w-7xl items-center justify-between px-6">
        <a href="#top" className="font-serif text-xl font-bold text-accent">
          DaCoach
        </a>

        <nav className="hidden items-center gap-8 md:flex">
          {NAV_LINKS.map((link) => (
            <a
              key={link.href}
              href={link.href}
              className="text-xs font-semibold uppercase tracking-wide text-text-300 transition-colors hover:text-text-100"
            >
              {link.label}
            </a>
          ))}
        </nav>

        <a
          href="#contacto"
          className="rounded-lg bg-accent px-5 py-2.5 text-xs font-bold uppercase tracking-wide text-white transition-colors hover:bg-accent-hover"
        >
          Solicitar demo
        </a>
      </div>
    </header>
  );
}
