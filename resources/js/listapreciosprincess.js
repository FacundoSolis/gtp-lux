document.addEventListener('DOMContentLoaded', function () {
    const priceListButton = document.getElementById('price-list-button');
    const modalContainer = document.querySelector('.modal-price-list-container');
    const modalElement = document.getElementById('priceListModal');

    // Contenido de la lista de precios para el modal
    const priceListContent = `
        <h4>Lista de Precios</h4>
        <ul>
            <li>01 enero - 31 mayo: <strong>3.400 € / día</strong></li>
            <li>01 junio - 30 junio: <strong>3.975 € / día</strong></li>
            <li>01 julio - 31 agosto: <strong>4.725 € / día</strong></li>
            <li>01 septiembre - 30 septiembre: <strong>3975 € / día</strong></li>
            <li>01 octubre - 31 diciembre: <strong>4725 € / día</strong></li>
        </ul>
    `;

    // Función para cargar y mostrar el modal
    const loadPriceListModal = () => {
        modalContainer.innerHTML = priceListContent;

        // Inicializar y mostrar el modal
        const priceListModal = new bootstrap.Modal(modalElement);
        priceListModal.show();
    };

    // Asignar evento al botón para abrir el modal
    priceListButton.addEventListener('click', loadPriceListModal);

    // Evento para limpiar correctamente al cerrar el modal
    modalElement.addEventListener('hidden.bs.modal', () => {
        // Eliminar cualquier fondo residual
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) backdrop.remove();

        // Asegurar que el scroll de la página funcione
        document.body.style.overflow = '';
        document.body.classList.remove('modal-open'); // Quitar clase de Bootstrap que bloquea el scroll
    });
});
