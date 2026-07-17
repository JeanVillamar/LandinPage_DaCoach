const COLUMNS = [
  {
    title: "Soluciones",
    links: ["Automatización de procesos", "Agentes inteligentes", "Integración de sistemas", "Canales digitales"],
  },
  {
    title: "Empresa",
    links: ["Nosotros", "Casos de uso", "Beneficios", "Cómo funciona"],
  },
  {
    title: "Contacto",
    links: ["Solicitar demo", "hola@dacoach.com", "+51 999 999 999"],
  },
];

export default function Footer() {
  return (
    <footer className="bg-bg-100 px-6 py-16">
      <div className="mx-auto grid max-w-6xl gap-10 sm:grid-cols-2 md:grid-cols-4">
        <div>
          <span className="font-serif text-xl font-bold text-accent">DaCoach</span>
          <p className="mt-3 max-w-xs text-sm text-text-400">
            Soluciones digitales e inteligencia artificial para optimizar procesos y escalar tu operación.
          </p>
        </div>

        {COLUMNS.map((column) => (
          <div key={column.title}>
            <h4 className="text-xs font-bold uppercase tracking-wide text-text-400">{column.title}</h4>
            <ul className="mt-4 space-y-2.5">
              {column.links.map((link) => (
                <li key={link}>
                  <a href="#" className="text-sm text-text-300 transition-colors hover:text-text-100">
                    {link}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        ))}
      </div>

      <div className="mx-auto mt-12 max-w-6xl border-t border-bg-300 pt-6 text-xs text-text-400">
        © {new Date().getFullYear()} DaCoach. Todos los derechos reservados.
      </div>
    </footer>
  );
}
