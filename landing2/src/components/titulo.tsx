import { motion, useReducedMotion, type Variants } from "motion/react";
import type { ElementType } from "react";

function cn(...classes: Array<string | false | undefined>) {
  return classes.filter(Boolean).join(" ");
}

export type ClipRevealLine = string | { text: string; className?: string };

export type ClipRevealTextProps = {
  lines: ClipRevealLine[];
  as?: ElementType;
  className?: string;
  lineClassName?: string;
  delay?: number;
  stagger?: number;
  trigger?: "mount" | "inView";
  amount?: number;
};

const clipVariants: Variants = {
  hidden: { clipPath: "inset(0 0 100% 0)", y: 14 },
  visible: ({ index, delay, stagger }: { index: number; delay: number; stagger: number }) => ({
    clipPath: "inset(0 0 0% 0)",
    y: 0,
    transition: {
      duration: 0.9,
      delay: delay + index * stagger,
      ease: [0.22, 1, 0.36, 1] as const,
    },
  }),
};

/**
 * Reveals each line of a heading with a clip-mask wipe — used for every
 * section title (see MOVIMIENTO in the brief). For the "writing" effect on
 * the editorial-pause phrases, see Typewriter in ./letra.
 */
export function ClipRevealText({
  lines,
  as: Tag = "div",
  className,
  lineClassName,
  delay = 0,
  stagger = 0.12,
  trigger = "inView",
  amount = 0.6,
}: ClipRevealTextProps) {
  const reduceMotion = useReducedMotion();
  const shouldAnimateOnMount = !reduceMotion && trigger === "mount";
  const shouldAnimateInView = !reduceMotion && trigger === "inView";

  return (
    <Tag className={className}>
      {lines.map((line, index) => {
        const text = typeof line === "string" ? line : line.text;
        const extraClass = typeof line === "string" ? undefined : line.className;

        return (
          <span className="clip-reveal-row" key={`${index}-${text}`}>
            <motion.span
              className={cn("clip-reveal-line", lineClassName, extraClass)}
              custom={{ index, delay, stagger }}
              variants={clipVariants}
              initial={reduceMotion ? "visible" : "hidden"}
              animate={shouldAnimateOnMount ? "visible" : undefined}
              whileInView={shouldAnimateInView ? "visible" : undefined}
              viewport={shouldAnimateInView ? { once: true, amount } : undefined}
            >
              {text}
            </motion.span>
          </span>
        );
      })}
    </Tag>
  );
}

export default ClipRevealText;
