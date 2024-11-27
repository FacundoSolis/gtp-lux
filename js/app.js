window.addEventListener('scroll', function() {
    const images = document.querySelectorAll('.slider img');
    images.forEach(function(image) {
      if (image.getBoundingClientRect().top < window.innerHeight) {
        image.classList.add('visible');
      }
    });
  });
  