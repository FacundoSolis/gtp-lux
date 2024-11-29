const slides = document.querySelector('.slides-valkyrya');
const images = document.querySelectorAll('.slides-valkyrya img');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
let index = 0;

const totalImages = images.length;

function moveSlider() {
  if (index >= totalImages) {
    index = 0;
    slides.style.transition = 'none'; // Desactivar la transición al hacer el bucle
    slides.style.transform = `translateX(0)`; // Regresar al principio
  } else {
    slides.style.transition = 'transform 0.5s ease'; // Activar la transición cuando no sea el bucle
    slides.style.transform = `translateX(-${index * 100}%)`; // Mover las imágenes
  }
}

// Función para mover a la siguiente imagen
nextButton.addEventListener('click', () => {
  index++;
  moveSlider();
});

// Función para mover a la imagen anterior
prevButton.addEventListener('click', () => {
  index--;
  if (index < 0) {
    index = totalImages - 1; // Si es el primero, vuelve al último
  }
  moveSlider();
});

// Configura un intervalo para mover el slider automáticamente
setInterval(() => {
  index++;
  moveSlider();
}, 3000); // Cambia la imagen cada 3 segundos
