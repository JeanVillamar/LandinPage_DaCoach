import { Typewriter } from "./letra";

type PausaEditorialProps = {
  id?: string;
  lines: string[];
};

export function PausaEditorial({ id, lines }: PausaEditorialProps) {
  return (
    <section className="editorial-pause" id={id}>
      <div className="editorial-pause__texture" aria-hidden="true" />
      <div className="container">
        <Typewriter as="h2" className="editorial-pause__text" lines={lines} />
      </div>
    </section>
  );
}
