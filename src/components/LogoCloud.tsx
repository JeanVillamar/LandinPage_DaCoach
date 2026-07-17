import eminatResearch from "@/assets/logos/eminat-clinical-research.png";
import eminatMedicalCenter from "@/assets/logos/eminat-medical-center.png";
import alejandroMagno from "@/assets/logos/alejandro-magno.jpg";

const LOGOS = [
  { src: eminatResearch, alt: "Eminat Research Group" },
  { src: eminatMedicalCenter, alt: "EMC Medical Center" },
  { src: alejandroMagno, alt: "Alejandro Magno" },
];

export default function LogoCloud() {
  return (
    <section className="border-y border-bg-300 bg-bg-0 px-6 py-14">
      <div className="mx-auto max-w-5xl text-center">
        <p className="text-sm text-text-300">Empresas que transforman su atención con inteligencia artificial</p>
        <div className="mt-8 flex flex-wrap items-center justify-center gap-8">
          {LOGOS.map((logo) => (
            <div
              key={logo.alt}
              className="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl shadow-sm"
            >
              <img src={logo.src} alt={logo.alt} className="h-full w-full object-cover" />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
