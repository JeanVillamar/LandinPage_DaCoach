import { useId, useState, type FormEvent } from "react";
import { ArrowRight } from "lucide-react";

export function Contacto() {
  const [submitted, setSubmitted] = useState(false);
  const formId = useId();

  function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setSubmitted(true);
  }

  return (
    <section className="section contact-section" id="contacto">
      <div className="container contact-grid">
        <div className="contact-intro">
          <p className="eyebrow">
            <i /> Hablemos
          </p>
          <h2>Cuéntanos qué proceso te está quitando tiempo.</h2>
          <p className="lead">
            En la primera conversación buscamos entender el problema, no
            venderte una solución.
          </p>
        </div>

        {submitted ? (
          <div className="contact-form contact-form--done" role="status">
            <h3>Listo, la recibimos.</h3>
            <p>
              Te contactaremos en menos de 24 horas para agendar una primera
              conversación.
            </p>
          </div>
        ) : (
          <form className="contact-form" onSubmit={handleSubmit} noValidate>
            <div className="form-field">
              <label htmlFor={`${formId}-nombre`}>Nombre</label>
              <input id={`${formId}-nombre`} name="nombre" type="text" autoComplete="name" required />
            </div>

            <div className="form-field">
              <label htmlFor={`${formId}-empresa`}>Empresa</label>
              <input id={`${formId}-empresa`} name="empresa" type="text" autoComplete="organization" required />
            </div>

            <div className="form-field">
              <label htmlFor={`${formId}-correo`}>Correo</label>
              <input id={`${formId}-correo`} name="correo" type="email" autoComplete="email" required />
            </div>

            <div className="form-field">
              <label htmlFor={`${formId}-proceso`}>Proceso que deseas mejorar</label>
              <input id={`${formId}-proceso`} name="proceso" type="text" required />
            </div>

            <div className="form-field form-field--full">
              <label htmlFor={`${formId}-mensaje`}>Mensaje (opcional)</label>
              <textarea id={`${formId}-mensaje`} name="mensaje" rows={4} />
            </div>

            <button className="button button--primary" type="submit">
              Revisar mi proceso <ArrowRight aria-hidden="true" />
            </button>
          </form>
        )}
      </div>
    </section>
  );
}
