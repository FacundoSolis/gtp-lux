window.addEventListener('scroll', function() {
    const images = document.querySelectorAll('.slider img');
    images.forEach(function(image) {
      if (image.getBoundingClientRect().top < window.innerHeight) {
        image.classList.add('visible');
      }
    });
  });
  
  // JavaScript para funcionalidad del slider
document.querySelectorAll('.slider-with-arrows').forEach((container) => {
  const slides = container.querySelector('.slides');
  const images = slides.querySelectorAll('img');
  const totalImages = images.length;
  let index = 0;

  container.querySelector('.prev').addEventListener('click', () => {
    index = (index - 1 + totalImages) % totalImages;
    slides.style.transform = `translateX(-${index * 100}%)`;
  });

  container.querySelector('.next').addEventListener('click', () => {
    index = (index + 1) % totalImages;
    slides.style.transform = `translateX(-${index * 100}%)`;
  });
});
