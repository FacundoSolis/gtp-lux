document.addEventListener('DOMContentLoaded', () => {
  // Seleccionar las secciones que queremos animar
  const sections = document.querySelectorAll(
    '.layout, .pricing-details-columns, .content-wrapper, .characteristics, .right-boxes'
  );

  // Configurar el Intersection Observer
  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('section-visible'); // Agregar clase visible
          observer.unobserve(entry.target); // Dejar de observar una vez visible
        }
      });
    },
    { threshold: 0.2 } // Activar cuando el 20% de la sección es visible
  );

  // Agregar la clase inicial y observar cada sección
  sections.forEach((section, index) => {
    section.classList.add('section-hidden'); // Ocultar inicialmente

    // Aplicar animación específica según el índice
    if (index % 3 === 0) {
      section.classList.add('section-from-left');
    } else if (index % 3 === 1) {
      section.classList.add('section-from-right');
    } else {
      section.classList.add('section-zoom');
    }

    observer.observe(section); // Observar la sección
  });
});
