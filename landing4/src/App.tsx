import Header from "@/components/Header";
import Hero from "@/components/Hero";
import LogoCloud from "@/components/LogoCloud";
import StepsSection from "@/components/StepsSection";
import ShowcaseSection from "@/components/ShowcaseSection";
import WhyUsSection from "@/components/WhyUsSection";
import SolutionsSection from "@/components/SolutionsSection";
import EfficiencySection from "@/components/EfficiencySection";
import TeamSection from "@/components/TeamSection";
import BlogCarousel from "@/components/BlogCarousel";
import FaqAccordion from "@/components/FaqAccordion";
import CtaBanner from "@/components/CtaBanner";
import Footer from "@/components/Footer";

export default function App() {
  return (
    <div className="min-h-screen bg-bg-0">
      <Header />
      <main>
        <Hero />
        <LogoCloud />
        <StepsSection />
        <ShowcaseSection />
        <WhyUsSection />
        <SolutionsSection />
        <EfficiencySection />
        <TeamSection />
        <BlogCarousel />
        <FaqAccordion />
        <CtaBanner />
      </main>
      <Footer />
    </div>
  );
}
