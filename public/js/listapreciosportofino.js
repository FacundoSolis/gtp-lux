document.addEventListener('DOMContentLoaded', function () {
    const priceListButton = document.getElementById('price-list-button');
    const priceListModal = new bootstrap.Modal(document.getElementById('priceListModal'));
    const priceListContent = document.getElementById('price-list-content');

    priceListButton.addEventListener('click', function () {
        const boatId = 3; // ID del barco (esto puede ser dinámico según el barco en la página)

        // Mostrar mensaje de carga
        priceListContent.innerHTML = '<p>Cargando lista de precios...</p>';

        // Realizar la petición para obtener los precios
        fetch(`/get-prices?boat_id=${boatId}`)
            .then(response => response.json())
            .then(data => {
                if (data.prices.length === 0) {
                    priceListContent.innerHTML = '<p>No hay precios disponibles para este barco.</p>';
                } else {
                    let content = `<h4>Lista de Precios para ${data.boat_name}</h4><ul>`;
                    data.prices.forEach(price => {
                        content += `
                            <li>
                                <strong>Fechas:</strong> ${price.start_date} - ${price.end_date}<br>
                                <strong>Precio por día:</strong> ${price.price_per_day} € / día
                            </li>`;
                    });
                    content += '</ul>';
                    priceListContent.innerHTML = content;
                }
            })
            .catch(error => {
                console.error('Error al cargar la lista de precios:', error);
                priceListContent.innerHTML = '<p>Error al cargar los precios. Intenta nuevamente.</p>';
            });

        // Abrir el modal
        priceListModal.show();
    });
});
