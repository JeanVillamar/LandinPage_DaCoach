import { HeroGeometric } from './components/portada'
import { Problema } from './components/problema'
import { AntesDespues } from './components/antes-despues'
import { CasoEstudio } from './components/caso-estudio'
import { PausaEditorial } from './components/pausa-editorial'
import { Fundador } from './components/fundador'
import { Servicios } from './components/servicios'
import { Metodologia, Garantias } from './components/metodologia'
import { Contacto } from './components/contacto'
import { Footer } from './components/footer'

function App() {
  return (
    <>
      <a className="skip-link" href="#inicio">
        Saltar al contenido principal
      </a>
      <HeroGeometric />
      <main>
        <Problema />
        <AntesDespues />
        <CasoEstudio />
        <PausaEditorial
          id="pausa-1"
          lines={["El problema nunca fue trabajar mucho.", "Fue repetir trabajo."]}
        />
        <Fundador />
        <Servicios />
        <PausaEditorial
          id="pausa-2"
          lines={["Más tecnología", "no siempre significa", "más productividad."]}
        />
        <Metodologia />
        <Garantias />
        <Contacto />
      </main>
      <Footer />
    </>
  )
}

export default App
