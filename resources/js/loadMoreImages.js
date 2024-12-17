document.addEventListener('DOMContentLoaded', function () {
    const additionalImages = window.additionalImages; // Obtener imágenes globales
    const loadMoreButton = document.getElementById('loadMoreButton');
    const modalContainer = document.querySelector('.modal-images-container');
    const imageModalElement = document.getElementById('imageModal');
    const imageModal = new bootstrap.Modal(imageModalElement);

    // Función para cargar más imágenes en el modal
    const loadMoreImages = () => {
        // Limpiamos las imágenes previas del modal
        modalContainer.innerHTML = '';

        // Añadimos las nuevas imágenes al modal
        additionalImages.forEach((imageUrl) => {
            const imgDiv = document.createElement('div');
            imgDiv.classList.add('productCover__img--small');
            imgDiv.style.backgroundImage = `url(${imageUrl})`;
            modalContainer.appendChild(imgDiv);
        });

        // Mostrar el modal
        imageModal.show();

        // Ocultar el botón después de cargar las imágenes
        loadMoreButton.style.display = 'none';
    };

    // Evento click para el botón
    loadMoreButton.addEventListener('click', loadMoreImages);

    // Evento para mostrar el botón nuevamente cuando se cierre el modal
    imageModalElement.addEventListener('hidden.bs.modal', function () {
        loadMoreButton.style.display = 'block';
    });
});
