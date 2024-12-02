const slides = document.querySelector('.slides-valkyrya');
const images = document.querySelectorAll('.slides-valkyrya img');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
let index = 0;

// Duplicar las primeras y últimas imágenes
const totalImages = images.length;
const slideWidth = images[0].clientWidth;

// Clonar los nodos iniciales y finales
const firstClone = slides.firstElementChild.cloneNode(true);
const secondClone = slides.firstElementChild.nextElementSibling.cloneNode(true);
const lastClone = slides.lastElementChild.cloneNode(true);
const secondLastClone = slides.lastElementChild.previousElementSibling.cloneNode(true);

// Añadir clones al slider
slides.appendChild(firstClone);
slides.appendChild(secondClone);
slides.insertBefore(lastClone, slides.firstElementChild);
slides.insertBefore(secondLastClone, slides.firstElementChild);

// Ajustar la posición inicial
slides.style.transform = `translateX(-${slideWidth * 2}px)`;
index = 2; // Comenzar después de los clones iniciales

// Función para mover el slider
function moveSlider() {
  slides.style.transition = 'transform 0.5s ease-in-out';
  slides.style.transform = `translateX(-${slideWidth * index}px)`;

  slides.addEventListener('transitionend', () => {
    if (index >= totalImages + 2) {
      slides.style.transition = 'none'; // Sin animación
      index = 2; // Regresar al inicio lógico
      slides.style.transform = `translateX(-${slideWidth * index}px)`;
    } else if (index <= 1) {
      slides.style.transition = 'none'; // Sin animación
      index = totalImages + 1; // Ir al final lógico
      slides.style.transform = `translateX(-${slideWidth * index}px)`;
    }
  });
}

// Función para avanzar
nextButton.addEventListener('click', () => {
  index++;
  moveSlider();
});

// Función para retroceder
prevButton.addEventListener('click', () => {
  index--;
  moveSlider();
});

// Auto-play cada 3 segundos
setInterval(() => {
  index++;
  moveSlider();
}, 3000);

