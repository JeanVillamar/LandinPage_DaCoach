import isotipoBlanco from "../dacoach-isotipo-blanco.svg";

export function Footer() {
  return (
    <footer className="site-footer">
      <div className="container site-footer__inner">
        <div className="site-footer__brand">
          <img src={isotipoBlanco} alt="" width={22} height={22} />
          <strong>DaCoach</strong>
        </div>

        <ul className="site-footer__contact">
          <li>
            <a href="#contacto">Escríbenos</a>
          </li>
          <li>
            <a href="#" target="_blank" rel="noreferrer">
              LinkedIn
            </a>
          </li>
        </ul>

        <p className="site-footer__phrase">La tecnología al servicio del criterio humano.</p>

        <p className="site-footer__legal">
          © {new Date().getFullYear()} DaCoach. Todos los derechos reservados.
        </p>
      </div>
    </footer>
  );
}
