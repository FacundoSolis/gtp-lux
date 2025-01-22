let currentIndex = 0;
const slides = document.querySelector('.slides');
const totalImages = document.querySelectorAll('.slides img').length;

function scrollSlides(direction) {
  const imagesPerView = window.innerWidth > 768 ? 4 : 1; // 4 en escritorio, 1 en móvil
  currentIndex += direction;

  // Evitar desbordamiento
  if (currentIndex < 0) {
    currentIndex = totalImages - imagesPerView;
  } else if (currentIndex > totalImages - imagesPerView) {
    currentIndex = 0;
  }

  const imageWidth = slides.querySelector('img').offsetWidth + 10; // Ancho + gap
  slides.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
}