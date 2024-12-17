document.addEventListener('DOMContentLoaded', function () {
    const additionalImagesPrincess = [
        "{{ asset('img/princess1.jpg') }}",
        "{{ asset('img/princess2.jpg') }}",
        "{{ asset('img/princess3.jpg') }}",
        "{{ asset('img/princess4.jpg') }}"
    ];

    const loadMoreButton = document.getElementById('loadMoreButton'); // Botón específico
    const modalContainer = document.getElementById('modalImagesContainer'); // Contenedor modal específico
    const imageModalElement = document.getElementById('imageModal'); // Modal específico
    const imageModal = new bootstrap.Modal(imageModalElement);

    // Función para cargar más imágenes en el modal
    const loadMoreImages = () => {
        modalContainer.innerHTML = ''; // Limpia el contenedor

        // Inserta las imágenes adicionales específicas
        additionalImagesPrincess.forEach((imageUrl) => {
            const imgDiv = document.createElement('div');
            imgDiv.classList.add('productCover__img--small');
            imgDiv.style.backgroundImage = `url(${imageUrl})`;
            modalContainer.appendChild(imgDiv);
        });

        // Muestra el modal
        imageModal.show();

        // Oculta el botón
        loadMoreButton.style.display = 'none';
    };

    // Evento para el botón "Ver más fotos"
    loadMoreButton.addEventListener('click', loadMoreImages);

    // Evento para restablecer el botón cuando se cierra el modal
    imageModalElement.addEventListener('hidden.bs.modal', () => {
        loadMoreButton.style.display = 'block';
    });
});
