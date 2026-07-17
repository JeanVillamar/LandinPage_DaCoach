import { motion, useReducedMotion } from "motion/react";
import { ArrowRight, ArrowUpRight, Circle, Menu, X } from "lucide-react";
import { useEffect, useState } from "react";

import isotipo from "../dacoach-isotipo-blanco.svg";
import logoEmc from "../eminat-medical-center.png";
import logoAlejandroMagno from "../alejandro-magno.jpg";
import logoEminatResearch from "../eminat-clinical-research.png";

const NAV_LINKS = [
  { href: "#caso-estudio", label: "Casos" },
  { href: "#servicios", label: "Servicios" },
  { href: "#metodologia", label: "Método" },
  { href: "#nosotros", label: "Nosotros" },
];

const clients = [
  {
    src: logoEmc,
    name: "Eminat Medical Center",
    className: "hero-client__logo--emc",
  },
  {
    src: logoAlejandroMagno,
    name: "Alejandro Magno",
    className: "hero-client__logo--portrait",
  },
  {
    src: logoEminatResearch,
    name: "Eminat Clinical Research",
    className: "hero-client__logo--eminat",
  },
];

function SiteHeader() {
  const [open, setOpen] = useState(false);

  useEffect(() => {
    function handleKeydown(event: KeyboardEvent) {
      if (event.key === "Escape") setOpen(false);
    }

    function handleResize() {
      if (window.innerWidth >= 900) setOpen(false);
    }

    window.addEventListener("keydown", handleKeydown);
    window.addEventListener("resize", handleResize);

    return () => {
      window.removeEventListener("keydown", handleKeydown);
      window.removeEventListener("resize", handleResize);
    };
  }, []);

  return (
    <header className="hero-header">
      <div className="container hero-header__inner">
        <a className="hero-brand" href="#inicio" aria-label="DaCoach, inicio">
          <img src={isotipo} alt="" width={20} height={20} />
          <strong>DaCoach</strong>
          <span>Integral Services</span>
        </a>

        <nav className="hero-nav" aria-label="Navegación principal">
          {NAV_LINKS.map((link) => (
            <a href={link.href} key={link.href}>
              {link.label}
            </a>
          ))}
        </nav>

        <a className="hero-header__cta" href="#contacto">
          Conversemos
        </a>

        <button
          type="button"
          className="hero-nav-toggle"
          aria-expanded={open}
          aria-controls="hero-mobile-nav"
          aria-label={open ? "Cerrar menú" : "Abrir menú"}
          onClick={() => setOpen((value) => !value)}
        >
          {open ? <X aria-hidden="true" /> : <Menu aria-hidden="true" />}
        </button>
      </div>

      {open && (
        <nav
          className="hero-mobile-nav"
          id="hero-mobile-nav"
          aria-label="Navegación móvil"
        >
          {NAV_LINKS.map((link) => (
            <a href={link.href} key={link.href} onClick={() => setOpen(false)}>
              {link.label}
            </a>
          ))}
          <a href="#contacto" onClick={() => setOpen(false)}>
            Conversemos
          </a>
        </nav>
      )}
    </header>
  );
}

type ElegantShapeProps = {
  className: string;
  delay?: number;
  width?: number;
  height?: number;
  rotate?: number;
  tone: "indigo" | "rose" | "violet" | "amber" | "cyan";
};

function ElegantShape({
  className,
  delay = 0,
  width = 400,
  height = 100,
  rotate = 0,
  tone,
}: ElegantShapeProps) {
  const reduceMotion = useReducedMotion();

  return (
    <motion.div
      className={`hero-shape ${className}`}
      initial={
        reduceMotion
          ? false
          : {
              opacity: 0,
              y: -150,
              rotate: rotate - 15,
            }
      }
      animate={{
        opacity: 1,
        y: 0,
        rotate,
      }}
      transition={{
        duration: 2.4,
        delay,
        ease: [0.23, 0.86, 0.39, 0.96],
        opacity: { duration: 1.2 },
      }}
      aria-hidden="true"
    >
      <motion.div
        animate={reduceMotion ? undefined : { y: [0, 15, 0] }}
        transition={{
          duration: 12,
          repeat: Number.POSITIVE_INFINITY,
          ease: "easeInOut",
        }}
        style={{ width, height }}
        className="hero-shape__float"
      >
        <div className={`hero-shape__body hero-shape__body--${tone}`} />
      </motion.div>
    </motion.div>
  );
}

const fadeUpVariants = {
  hidden: { opacity: 0, y: 30 },
  visible: (index: number) => ({
    opacity: 1,
    y: 0,
    transition: {
      duration: 1,
      delay: 0.5 + index * 0.16,
      ease: [0.25, 0.4, 0.25, 1] as const,
    },
  }),
};

function ClientShowcase() {
  const reduceMotion = useReducedMotion();

  return (
    <motion.div
      className="hero-clients"
      variants={fadeUpVariants}
      custom={4}
      initial={reduceMotion ? "visible" : "hidden"}
      animate="visible"
    >
      <p className="hero-clients__label">
        Organizaciones que ya confían en nosotros
      </p>
      <ul className="hero-clients__grid">
        {clients.map((client) => (
          <li className="hero-client" key={client.name}>
            <span className="hero-client__media">
              <img
                className={client.className}
                src={client.src}
                alt=""
                width={64}
                height={64}
              />
            </span>
            <span>{client.name}</span>
          </li>
        ))}
      </ul>
    </motion.div>
  );
}

function HeroGeometric() {
  const reduceMotion = useReducedMotion();
  const initialState = reduceMotion ? "visible" : "hidden";

  return (
    <section className="hero-section" id="inicio" aria-labelledby="hero-title">
      <SiteHeader />

      <div className="hero-ambient" aria-hidden="true" />

      <div className="hero-shapes" aria-hidden="true">
        <ElegantShape
          delay={0.3}
          width={600}
          height={140}
          rotate={12}
          tone="indigo"
          className="hero-shape--indigo"
        />
        <ElegantShape
          delay={0.5}
          width={500}
          height={120}
          rotate={-15}
          tone="rose"
          className="hero-shape--rose"
        />
        <ElegantShape
          delay={0.4}
          width={300}
          height={80}
          rotate={-8}
          tone="violet"
          className="hero-shape--violet"
        />
        <ElegantShape
          delay={0.6}
          width={200}
          height={60}
          rotate={20}
          tone="amber"
          className="hero-shape--amber"
        />
        <ElegantShape
          delay={0.7}
          width={150}
          height={40}
          rotate={-25}
          tone="cyan"
          className="hero-shape--cyan"
        />
      </div>

      <div className="container hero-section__inner">
        <div className="hero-content">
          <motion.div
            custom={0}
            variants={fadeUpVariants}
            initial={initialState}
            animate="visible"
            className="hero-badge"
          >
            <Circle aria-hidden="true" />
            <span>Consultoría de automatización para pymes</span>
          </motion.div>

          <motion.h1
            id="hero-title"
            custom={1}
            variants={fadeUpVariants}
            initial={initialState}
            animate="visible"
          >
            <span>Automatizamos lo repetitivo.</span>
            <strong>Tu equipo se queda con lo importante.</strong>
          </motion.h1>

          <motion.p
            className="hero-lead"
            custom={2}
            variants={fadeUpVariants}
            initial={initialState}
            animate="visible"
          >
            Analizamos cómo funciona tu negocio, detectamos dónde se pierde
            tiempo y construimos automatizaciones que realmente generan valor.
          </motion.p>

          <motion.div
            className="hero-actions"
            custom={3}
            variants={fadeUpVariants}
            initial={initialState}
            animate="visible"
          >
            <a className="hero-button hero-button--primary" href="#contacto">
              Revisemos tu proceso <ArrowRight aria-hidden="true" />
            </a>
            <a className="hero-button hero-button--secondary" href="#metodologia">
              Ver cómo trabajamos <ArrowUpRight aria-hidden="true" />
            </a>
          </motion.div>
        </div>

        <ClientShowcase />
      </div>

      <div className="hero-vignette" aria-hidden="true" />
    </section>
  );
}

export { HeroGeometric };
