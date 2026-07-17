import {
  AnimatePresence,
  motion,
  useInView,
  useReducedMotion,
  type Variants,
} from "motion/react";
import { useEffect, useRef, useState } from "react";
import { ClipRevealText } from "./titulo";

const states = {
  antes: {
    eyebrow: "Antes",
    title: "Así funciona hoy",
    items: [
      "Datos dispersos",
      "Validaciones manuales",
      "Seguimientos tardíos",
      "Personas copiando información",
      "Falta de trazabilidad",
    ],
  },
  despues: {
    eyebrow: "Después",
    title: "Así funciona automatizado",
    items: [
      "Flujo centralizado",
      "Alertas automáticas",
      "Menos errores",
      "Información disponible",
      "Equipo enfocado en decisiones",
    ],
  },
} as const;

type Phase = keyof typeof states;
type RowCustom = { phase: Phase; index: number };

const panelVariants: Variants = {
  hidden: (phase: Phase) => ({
    opacity: 0,
    scale: phase === "antes" ? 0.97 : 1.025,
    filter: phase === "antes" ? "blur(0px)" : "blur(8px)",
  }),
  visible: {
    opacity: 1,
    scale: 1,
    filter: "blur(0px)",
    transition: {
      duration: 0.55,
      ease: [0.22, 1, 0.36, 1],
      when: "beforeChildren",
      staggerChildren: 0.07,
    },
  },
  exit: (phase: Phase) => ({
    opacity: 0,
    scale: phase === "antes" ? 0.94 : 1.02,
    filter: "blur(7px)",
    transition: {
      duration: 0.48,
      ease: [0.4, 0, 1, 1],
      when: "afterChildren",
      staggerChildren: 0.045,
      staggerDirection: -1,
    },
  }),
};

const rowVariants: Variants = {
  hidden: ({ phase, index }: RowCustom) => ({
    opacity: 0,
    x: phase === "antes" ? (index % 2 === 0 ? -18 : 18) : 0,
    y: phase === "despues" ? 12 : 0,
    rotate: phase === "antes" ? (index % 2 === 0 ? -2.5 : 2.5) : 0,
  }),
  visible: ({ phase, index }: RowCustom) => ({
    opacity: 1,
    x: 0,
    y: 0,
    rotate:
      phase === "antes" ? (index % 2 === 0 ? -1.25 : 1.1) : 0,
    transition: {
      duration: 0.48,
      ease: [0.22, 1, 0.36, 1],
    },
  }),
  exit: ({ phase, index }: RowCustom) => ({
    opacity: 0,
    x:
      phase === "antes"
        ? index % 2 === 0
          ? -34
          : 34
        : 0,
    y: phase === "despues" ? -10 : index * 2,
    rotate:
      phase === "antes" ? (index % 2 === 0 ? -5 : 5) : 0,
    transition: {
      duration: 0.32,
      ease: [0.4, 0, 1, 1],
    },
  }),
};

function TransformPanel({
  phase,
  reducedMotion,
}: {
  phase: Phase;
  reducedMotion: boolean;
}) {
  const content = states[phase];

  return (
    <motion.div
      key={phase}
      className={`transform-panel transform-panel--${phase}`}
      custom={phase}
      variants={reducedMotion ? undefined : panelVariants}
      initial={reducedMotion ? false : "hidden"}
      animate="visible"
      exit={reducedMotion ? undefined : "exit"}
      aria-live="polite"
    >
      <p className="transform-panel__eyebrow">{content.eyebrow}</p>
      <h3>{content.title}</h3>
      <ul className="transform-panel__list">
        {content.items.map((item, index) => (
          <motion.li
            key={item}
            custom={{ phase, index }}
            variants={reducedMotion ? undefined : rowVariants}
          >
            <span className="transform-panel__marker" aria-hidden="true" />
            {item}
          </motion.li>
        ))}
      </ul>
    </motion.div>
  );
}

export function AntesDespues() {
  const [phase, setPhase] = useState<Phase>("antes");
  const [hasPlayed, setHasPlayed] = useState(false);
  const stageRef = useRef<HTMLDivElement>(null);
  const isInView = useInView(stageRef, { once: true, amount: 0.55 });
  const reduceMotion = Boolean(useReducedMotion());

  useEffect(() => {
    if (!isInView || hasPlayed || reduceMotion) return;

    const timeout = window.setTimeout(() => {
      setPhase("despues");
      setHasPlayed(true);
    }, 1800);

    return () => window.clearTimeout(timeout);
  }, [hasPlayed, isInView, reduceMotion]);

  return (
    <section className="section before-after" id="antes-despues">
      <div className="container">
        <p className="eyebrow">
          <i /> El cambio
        </p>
        <ClipRevealText
          as="h2"
          lines={[
            "Lo que cambia cuando el proceso",
            "deja de depender de la memoria.",
          ]}
        />

        <div className="before-after__experience" ref={stageRef}>
          <div
            className="before-after__controls"
            role="group"
            aria-label="Comparar proceso antes y después"
          >
            <button
              type="button"
              className={phase === "antes" ? "is-active" : ""}
              aria-pressed={phase === "antes"}
              onClick={() => {
                setPhase("antes");
                setHasPlayed(true);
              }}
            >
              Antes
            </button>
            <button
              type="button"
              className={phase === "despues" ? "is-active" : ""}
              aria-pressed={phase === "despues"}
              onClick={() => {
                setPhase("despues");
                setHasPlayed(true);
              }}
            >
              Después
            </button>
          </div>

          <div className="before-after__stage">
            <AnimatePresence mode="wait" initial={false}>
              <TransformPanel
                key={phase}
                phase={phase}
                reducedMotion={reduceMotion}
              />
            </AnimatePresence>
          </div>

          <p className="before-after__hint">
            {phase === "antes"
              ? "El trabajo depende de recordar, copiar y perseguir información."
              : "El flujo organiza la información y deja las decisiones en manos del equipo."}
          </p>
        </div>
      </div>
    </section>
  );
}
