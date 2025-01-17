document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.slider-with-arrows');
    sliders.forEach(sliderWrapper => {
      const slidesContainer = sliderWrapper.querySelector('.slides');
      const prevButton = sliderWrapper.querySelector('.prev');
      const nextButton = sliderWrapper.querySelector('.next');
      const slideItems = slidesContainer.querySelectorAll('img');
      const totalSlides = slideItems.length;
  
      let currentIndex = 0;
      let isTransitioning = false;
  
      // Clonar las imágenes para crear el efecto de loop infinito
      const firstClone = slideItems[0].cloneNode(true);
      const lastClone = slideItems[totalSlides - 1].cloneNode(true);
  
      slidesContainer.appendChild(firstClone);
      slidesContainer.insertBefore(lastClone, slidesContainer.firstChild);
  
      function updateSliderPosition() {
        const slideWidth = slidesContainer.getBoundingClientRect().width / getVisibleSlides();
        slidesContainer.style.transform = `translateX(-${(currentIndex + 1) * slideWidth}px)`;
        slideItems.forEach(slide => {
          slide.style.width = `${slideWidth}px`; // Asegurar que cada imagen tenga el ancho correcto
        });
      }
  
      function getVisibleSlides() {
        return window.innerWidth >= 768 ? 4 : 1; // 4 imágenes en escritorio, 1 en móvil
      }
  
      function handleTransitionEnd() {
        isTransitioning = false;
  
        // Loop infinito
        if (currentIndex === totalSlides) {
          slidesContainer.style.transition = 'none';
          currentIndex = 0;
          updateSliderPosition();
        } else if (currentIndex === -1) {
          slidesContainer.style.transition = 'none';
          currentIndex = totalSlides - 1;
          updateSliderPosition();
        }
      }
  
      function moveNext() {
        if (isTransitioning) return;
        isTransitioning = true;
  
        slidesContainer.style.transition = 'transform 0.6s ease-in-out';
        currentIndex++;
        updateSliderPosition();
      }
  
      function movePrev() {
        if (isTransitioning) return;
        isTransitioning = true;
  
        slidesContainer.style.transition = 'transform 0.6s ease-in-out';
        currentIndex--;
        updateSliderPosition();
      }
  
      prevButton.addEventListener('click', movePrev);
      nextButton.addEventListener('click', moveNext);
  
      slidesContainer.addEventListener('transitionend', handleTransitionEnd);
  
      // Desplazamiento automático
      let autoSlide = setInterval(moveNext, 3000);
  
      // Pausar el auto-slide al interactuar con el slider
      sliderWrapper.addEventListener('mouseover', () => clearInterval(autoSlide));
      sliderWrapper.addEventListener('mouseout', () => {
        autoSlide = setInterval(moveNext, 3000);
      });
  
      updateSliderPosition();
      window.addEventListener('resize', updateSliderPosition);
    });
  });
  