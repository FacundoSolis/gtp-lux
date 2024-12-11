document.addEventListener('DOMContentLoaded', function () {
  // Lista de imágenes adicionales
  const additionalImages = [
      'http://127.0.0.1:8000/img/val5.jpg',
      'http://127.0.0.1:8000/img/val6.jpg',
      'http://127.0.0.1:8000/img/val7.jpg',
      'http://127.0.0.1:8000/img/val8.jpg',
      // Añade más URLs de imágenes aquí
  ];

  const loadMoreButton = document.getElementById('loadMoreButton');
  const modalContainer = document.querySelector('.modal-images-container');
  const imageModalElement = document.getElementById('imageModal');
  const imageModal = new bootstrap.Modal(imageModalElement);

  // Función para cargar más imágenes en la modal
  const loadMoreImages = () => {
      // Limpiamos las imágenes previas del modal
      modalContainer.innerHTML = '';

      // Añadimos las nuevas imágenes al modal
      additionalImages.forEach((imageUrl) => {
          const imgDiv = document.createElement('div');
          imgDiv.classList.add('productCover__img--small');
          imgDiv.style.backgroundImage = `url(${imageUrl})`;
          modalContainer.appendChild(imgDiv); // Añadir la nueva imagen al modal
      });

      // Mostrar la modal
      imageModal.show();

      // Ocultar el botón después de cargar las imágenes
      loadMoreButton.style.display = 'none';
  };

  // Agregar evento de clic al botón
  loadMoreButton.addEventListener('click', loadMoreImages);

  // Evento para mostrar el botón nuevamente cuando se cierre el modal
  imageModalElement.addEventListener('hidden.bs.modal', function () {
      loadMoreButton.style.display = 'block'; // Mostrar el botón nuevamente
  });
});
