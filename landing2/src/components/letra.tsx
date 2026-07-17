import { useInView, useReducedMotion } from "motion/react";
import { type ElementType, useEffect, useRef, useState } from "react";

function cn(...classes: Array<string | false | undefined>) {
  return classes.filter(Boolean).join(" ");
}

export type TypewriterProps = {
  lines: string[];
  as?: ElementType;
  className?: string;
  lineClassName?: string;
  speed?: number;
  lineDelay?: number;
  initialDelay?: number;
};

/**
 * Types each line out letter by letter, one line after another, with a
 * blinking cursor on the active line — the "writing" effect used for the
 * two big editorial-pause phrases. Starts once scrolled into view and
 * settles (cursor fades) once the full phrase has been typed.
 */
export function Typewriter({
  lines,
  as: Tag = "div",
  className,
  lineClassName,
  speed = 38,
  lineDelay = 260,
  initialDelay = 300,
}: TypewriterProps) {
  const reduceMotion = useReducedMotion();
  const ref = useRef<HTMLDivElement | null>(null);
  const inView = useInView(ref, { once: true, amount: 0.6 });

  const [lineIndex, setLineIndex] = useState(0);
  const [charIndex, setCharIndex] = useState(0);
  const [finished, setFinished] = useState(reduceMotion);
  const [cursorVisible, setCursorVisible] = useState(true);

  useEffect(() => {
    if (reduceMotion || !inView || finished) return;

    const current = lines[lineIndex] ?? "";

    if (charIndex < current.length) {
      const delay = charIndex === 0 ? initialDelay : speed;
      const timeout = setTimeout(() => setCharIndex((value) => value + 1), delay);
      return () => clearTimeout(timeout);
    }

    if (lineIndex < lines.length - 1) {
      const timeout = setTimeout(() => {
        setLineIndex((value) => value + 1);
        setCharIndex(0);
      }, lineDelay);
      return () => clearTimeout(timeout);
    }

    const timeout = setTimeout(() => setFinished(true), 500);
    return () => clearTimeout(timeout);
  }, [reduceMotion, inView, finished, charIndex, lineIndex, lines, speed, lineDelay, initialDelay]);

  useEffect(() => {
    if (!finished) return;
    const timeout = setTimeout(() => setCursorVisible(false), 900);
    return () => clearTimeout(timeout);
  }, [finished]);

  return (
    <Tag className={className} ref={ref}>
      <span aria-hidden="true">
        {lines.map((line, index) => {
          const isPast = reduceMotion || finished || index < lineIndex;
          const isActive = !isPast && index === lineIndex;
          const visibleText = isPast ? line : isActive ? line.slice(0, charIndex) : "";
          const showCursor = !reduceMotion && cursorVisible && (isActive || (finished && index === lines.length - 1));

          return (
            <span className={cn("typewriter-row", lineClassName)} key={`${index}-${line}`}>
              {visibleText}
              {showCursor && (
                <span className="typewriter-cursor" aria-hidden="true">
                  _
                </span>
              )}
            </span>
          );
        })}
      </span>
      <span className="sr-only">{lines.join(" ")}</span>
    </Tag>
  );
}

export default Typewriter;
