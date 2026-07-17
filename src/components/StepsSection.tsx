const STEPS = [
  {
    number: 1,
    title: "Entendemos tu operación",
    description: "Analizamos tus procesos, necesidades y oportunidades de mejora.",
  },
  {
    number: 2,
    title: "Diseñamos la solución",
    description: "Combinamos inteligencia artificial, automatización e integración de sistemas.",
  },
  {
    number: 3,
    title: "Implementamos y optimizamos",
    description: "Ponemos la solución en marcha, medimos resultados y la mejoramos continuamente.",
  },
];

export default function StepsSection() {
  return (
    <section id="como-funciona" className="bg-bg-100 px-6 py-24">
      <div className="mx-auto max-w-5xl">
        <h2 className="text-center font-serif text-3xl font-bold text-text-100">
          Tu agente inteligente listo en tres pasos
        </h2>

        <div className="mt-14 grid gap-8 md:grid-cols-3">
          {STEPS.map((step) => (
            <div
              key={step.number}
              className="rounded-3xl bg-bg-200 px-8 py-10 text-center"
            >
              <div className="mx-auto mb-5 flex h-9 w-9 items-center justify-center rounded-full bg-[var(--navy-deep)] text-sm font-bold text-white">
                {step.number}
              </div>
              <h3 className="font-serif text-xl text-text-100">{step.title}</h3>
              <p className="mt-3 text-sm leading-relaxed text-text-300">{step.description}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
