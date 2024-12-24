@extends('layouts.public')

@push('styles')
    @vite('resources/css/menu.css')
    @vite('resources/css/princess.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@section('content')
<!-- Menú fijo -->
<header class="topbar">
<div class="topbar__logo">
        <!-- Enlace que lleva a la página principal -->
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
        </a>
    </div>
    <!-- Menú de escritorio -->
    <nav class="nav-menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">Español</span>
                    <ul>
                        <li><a href="#" class="language">Français</a></li>
                        <li><a href="#" class="language">English</a></li>
                        <li><span class="selected">Español</span></li>
                        <li><a href="#" class="language">Italiano</a></li>
                        <li><a href="#" class="language">Deutsch</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Menú hamburguesa -->
    <div class="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Menú móvil -->
    <div class="mobile-menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">Español</span>
                    <ul>
                        <li><a href="#" class="language">Français</a></li>
                        <li><a href="#" class="language">English</a></li>
                        <li><span class="selected">Español</span></li>
                        <li><a href="#" class="language">Italiano</a></li>
                        <li><a href="#" class="language">Deutsch</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>


<!-- Slider de imágenes y características del barco -->
<section class="container-valkyrya">
    <h2>Princess</h2>
</section>   

<section class="productCover">
    <div class="productCover__imagesContainer">
        <div class="productCover__sideImgs" id="imageContainer">
            <div class="productCover__img--small" style="background-image: url('{{ asset('img/val1.jpg') }}');"></div>
            <div class="productCover__img--small" style="background-image: url('{{ asset('img/val2.jpg') }}');"></div>
            <div class="productCover__img--small" style="background-image: url('{{ asset('img/val3.jpg') }}');"></div>
            <div class="productCover__img--small" style="background-image: url('{{ asset('img/val4.jpg') }}');"></div>
        </div>
    </div>
    <div class="productCover__ctaContainer">
        <button class="productCover__cta" id="loadMoreButton">Ver más fotos</button>
    </div>
</section>

<!-- Modal específico -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Galería de imágenes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-images-container" id="modalImagesContainer">
                    <!-- Las imágenes adicionales se cargarán aquí -->
                </div>
            </div>
        </div>
    </div>
</div>


<section class="description-boat">
    <h3>Descripción del Barco</h3>
    <p>Alquiler de Yates en Denia</p>
    <p>Navegue en el exclusivo Princess V65, un lujoso barco abierto de día diseñado para el confort y la relajación. 
        Con capacidad para 10 invitados, este yate ofrece 3 baños completos y camarotes. 
        Un salón de planta abierta y una cocina completa, perfecta para una experiencia inolvidable.
        El patrón es obligatorio, lo que garantiza un día seguro en el mar</p>

     <!-- Botón para abrir el modal -->
     <button id="loadMoreDescription2Button" class="btn-ver-más">Ver más</button>
</section>

<!-- Modal de descripción -->
<div class="modal fade" id="descriptionModal2" tabindex="-1" aria-labelledby="descriptionModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="descriptionModalLabel2">Descripción del Barco</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-description-container">
        <!-- Aquí se cargará la descripción dinámicamente -->
      </div>
    </div>
  </div>
</div>

<!-- Características del barco -->
<main class="layout">
    <section class="characteristics">
        <h3>Características del Barco</h3>
        <div class="info-list">
            <div class="info-row light">
                <span><strong>Modelo:</strong></span>
                <span>Sunseeker Portofino 53</span>
            </div>
            <div class="info-row">
                <span><strong>Eslora:</strong></span>
                <span>12m</span>
            </div>
            <div class="info-row light">
                <span><strong>Manga:</strong></span>
                <span>4.5m</span>
            </div>
            <div class="info-row">
                <span><strong>Capacidad:</strong></span>
                <span>12 personas</span>
            </div>
            <div class="info-row light">
                <span><strong>Tripulación:</strong></span>
                <span>2 personas</span>
            </div>
            <div class="info-row">
                <span><strong>Motor:</strong></span>
                <span>200CV</span>
            </div>
            <div class="info-row light">
                <span><strong>Equipamiento:</strong></span>
                <span>Solarium, toldo retráctil, música, nevera</span>
            </div>
        </div>
    </section>

    <!-- Especificaciones -->
<section class="right-boxes">
    <h3>Especificaciones</h3>
        <div class="row">
            <div class="box">
                <i class="fa-solid fa-users"></i> Tripulación
            </div>
            <div class="box">
                <i class="fa-solid fa-bed"></i> Ropa de cama
            </div>
            <div class="box">
                <i class="fa-solid fa-ship"></i> Piloto automatico
            </div>
        </div>
        <div class="row">
            <div class="box">
                <i class="fa-solid fa-wind"></i> Aire acondicionado
            </div>
            <div class="box">
                <i class="fa-solid fa-car-battery"></i> Generador
            </div>
            <div class="box">
                <i class="fa-solid fa-car-battery"></i> Generador
            </div>
        </div>
        <div class="row large">
            <div class="box">
                <i class="fa-solid fa-anchor"></i> Patrón
            </div>
            <div class="box">
                <i class="fa-solid fa-music"></i> Altavoces externos
            </div>
        </div>
    </section>
</main>

<!-- Detalles de precios -->
<section class="pricing-details-columns">
    <div class="characteristics2">
        <h3>Incluido en el Precio</h3>
        <div class="info-list2">
            <div class="info-row2"><span>Seguro a todo riesgo</span><span>✔</span></div>
            <div class="info-row2"><span>Bebidas</span><span>✔</span></div>
            <div class="info-row2"><span>Equipo snorkel</span><span>✔</span></div>
            <div class="info-row2"><span>Paddle surf</span><span>✔</span></div>
            <div class="info-row2"><span>Toallas</span><span>✔</span></div>
        </div>
    </div>
    <div class="characteristics3">
        <h3>No Incluido en el Precio</h3>
        <div class="info-list3">
            <div class="info-row3"><span>Combustible</span><span>✘</span></div>
            <div class="info-row3"><span>Bebidas premium</span><span>✘</span></div>
            <div class="info-row3"><span>Equipos Especiales</span><span>✘</span></div>
        </div>
    </div>
</section>

<!-- Formulario de reserva -->
<div class="container">
    <h1>Reserva del Barco Princess</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Único formulario de reserva -->
    <form id="reservation-form" action="{{ route('boats.reserve', ['boatId' => 4]) }}" method="POST"> <!-- ID cambiado a 4 -->
        @csrf
        <input type="hidden" name="boat_id" value="4"> <!-- ID de Princess V65 -->

        <!-- Selección del puerto -->
        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-control" required>
                <option value="">Lugar de salida</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}">{{ $port->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección de fechas -->
        <div class="row">
            <div class="col">
                <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
                <input type="text" id="pickup_date" name="pickup_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
            </div>
            <div class="col">
                <label for="return_date" class="form-label">Fecha de Entrega:</label>
                <input type="text" id="return_date" name="return_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
            </div>
        </div>

        <!-- Calendario compacto -->
        <div id="availability-calendar" class="calendar-wrapper">
            <!-- Aquí se renderiza el calendario -->
        </div>

        <!-- Tarjeta de precios -->
        <div id="price-summary" class="price-card" style="display: none;">
            <h5>Resumen de precios</h5>
            <p><strong>Total:</strong> <span id="total-price">0€</span></p>
        </div>

        <!-- Información del cliente -->
        <div class="mt-4">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Ejemplo: Juan Pérez" required>

            <label for="email" class="form-label mt-2">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Ejemplo: juan.perez@correo.com" required>

            <label for="phone" class="form-label mt-2">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Ejemplo: +34 600 000 000"required>
        </div>

        <!-- Botón de reserva -->
        <button type="submit" class="btn btn-primary mt-3">Reservar</button>
    </form>
</div>

<!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo">
            <div class="social-icons">
                <a href="https://instagram.com" target="_blank"><img src="{{ asset('img/instagram.png') }}" alt="Instagram"></a>
                <a href="https://facebook.com" target="_blank"><img src="{{ asset('img/facebook.png') }}" alt="Facebook"></a>
            </div>
            <p class="contact-email">contacto@empresa.com</p>
            <p class="location">Puerto de Dénia, Edificio Capitanía, Dársena de Babor, s/n, 03700 Dénia, Alicante</p>
        </div>
        <div class="footer-right"></div>
    </div>
</footer>
@endsection


@section('scripts')
    <script>
            window.additionalImages = [
                "{{ asset('img/val5.jpg') }}",
                "{{ asset('img/val6.jpg') }}",
                "{{ asset('img/val7.jpg') }}",
                "{{ asset('img/val8.jpg') }}"
    ];
    </script>
    @vite('resources/js/loadMoreDescription2.js')
    @vite('resources/js/loadMoreImages2.js') <!-- Script exclusivo para Princess -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('availability-calendar');
        const portSelect = document.getElementById('port_id');
        const pickupInput = document.getElementById('pickup_date');
        const returnInput = document.getElementById('return_date');
        const priceSummary = document.getElementById('price-summary');
        const totalPriceElement = document.getElementById('total-price');
        const boatId = 4; // ID del barco actualizado
        const hamburgerMenu = document.querySelector('.hamburger-menu');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (hamburgerMenu && mobileMenu) {
            hamburgerMenu.addEventListener('click', function () {
                mobileMenu.classList.toggle('active');
            });
        }
        // Función para calcular el precio
        function calculatePrice(boatId, startDate, endDate) {
            if (!startDate || !endDate) return;
            
            axios
                .get('/calculate-price', {
                    params: { boat_id: boatId, start_date: startDate, end_date: endDate },
                })
                .then((response) => {
                    console.log('Respuesta del servidor:', response);

                    // Obtener el precio total de la respuesta
                    const totalPrice = response.data.total_price;
                    // Mostrar el precio en la tarjeta
                    showPriceSummary(totalPrice);
                })
                .catch((error) => {
                    console.error('Error al calcular el precio:', error);
                    alert('No se pudo calcular el precio. Intenta nuevamente.');
                });
        }
        // Muestra el precio en la tarjeta
        function showPriceSummary(totalPrice) {
            const priceCard = document.getElementById('price-summary');
            const totalPriceElement = document.getElementById('total-price');

            totalPriceElement.textContent = totalPrice + '€';  // Muestra el precio calculado

            priceCard.style.display = 'block';  // Muestra la tarjeta de precios
        }
        // Llama a esta función después de que se seleccionen ambas fechas
        pickupInput.addEventListener('change', () => {
        // Verificar si ambas fechas están seleccionadas
            if (pickupInput.value && returnInput.value) {
        // Convertir las fechas a formato YYYY-MM-DD
                const startDate = new Date(pickupInput.value).toISOString().split('T')[0];
                const endDate = new Date(returnInput.value).toISOString().split('T')[0];

                // Mostrar las fechas seleccionadas en la consola
                console.log('Start Date:', startDate);
                console.log('End Date:', endDate);

                // Llamar a la función para calcular el precio
                calculatePrice(boatId, startDate, endDate);
    }
});
        returnInput.addEventListener('change', () => {
            // Verificar si ambas fechas están seleccionadas
            if (pickupInput.value && returnInput.value) {
                // Convertir las fechas a formato YYYY-MM-DD
                const startDate = new Date(pickupInput.value).toISOString().split('T')[0];
                const endDate = new Date(returnInput.value).toISOString().split('T')[0];

                // Llamar a la función para calcular el precio
                calculatePrice(boatId, startDate, endDate);
            }
});

        let selectedPickupDate = null;
        let selectedReturnDate = null;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            events: async function (fetchInfo, successCallback, failureCallback) {
                try {
                    const portId = portSelect.value;
                    if (!portId) {
                        successCallback([]);
                        return;
                    }

                    const response = await axios.get(`/reservations/calendar/${boatId}/${portId}`, {
                        params: {
                            startDate: fetchInfo.startStr,
                            endDate: fetchInfo.endStr,
                        },
                    });

                    const reservations = response.data;

                    const events = reservations.map(reservation => ({
                        title: reservation.available ? 'Disponible' : 'Reservado',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.available ? 'green' : 'red',
                        extendedProps: { available: reservation.available },
                    }));

                    successCallback(events);
                } catch (error) {
                    console.error('Error al cargar las reservas:', error);
                    failureCallback(error);
                }
            },
            dateClick: function (info) {
                const clickedDate = info.dateStr;

                // Si el usuario hace clic en la fecha inicial seleccionada, reiniciar la selección
                if (clickedDate === selectedPickupDate) {
                    resetSelection();
                    return;
                }

                // Comprobar si el día está reservado
                const isReserved = calendar.getEvents().some(event =>
                    !event.extendedProps.available &&
                    clickedDate >= event.startStr &&
                    clickedDate < event.endStr
                );

                if (isReserved) {
                    alert('Este día está reservado. Por favor selecciona otra fecha.');
                    return;
                }

                // Seleccionar fechas
                if (!selectedPickupDate) {
                    selectedPickupDate = clickedDate;
                    pickupInput.value = selectedPickupDate;
                } else if (!selectedReturnDate) {
                    if (clickedDate <= selectedPickupDate) {
                        alert('La fecha de entrega debe ser posterior a la fecha de recogida.');
                        return;
                    }

                    // Verificar si el rango contiene días reservados
                const isRangeReserved = checkRangeOverlap(selectedPickupDate, clickedDate);
                if (isRangeReserved) {
                    alert('El rango seleccionado incluye días ya reservados. Por favor selecciona otro rango.');
                    return;
                }

                    selectedReturnDate = clickedDate;
                    returnInput.value = selectedReturnDate;
                } else {
                    selectedPickupDate = clickedDate;
                    selectedReturnDate = null;
                    pickupInput.value = selectedPickupDate;
                    returnInput.value = '';
                }

                highlightSelectedDates();
            },
        });

        function highlightSelectedDates() {

                // Limpia estilos previos aplicados solo a las celdas seleccionadas
            document.querySelectorAll('.fc-day[data-date]').forEach(dayCell => {
                dayCell.style.backgroundColor = ''; // Restablecer color
            });
            // Limpiar eventos visuales previos
            calendar.getEvents().forEach(event => {
                event.setProp('backgroundColor', event.extendedProps.available ? 'green' : 'red');
                event.setProp('borderColor', '');
            });

            // Aplicar estilo a los días seleccionados
            if (selectedPickupDate && selectedReturnDate) {
                let currentDate = new Date(selectedPickupDate);
                const endDate = new Date(selectedReturnDate);

                while (currentDate <= endDate) {
                    const currentDateStr = currentDate.toISOString().split('T')[0];
                    const dayCell = document.querySelector(`.fc-day[data-date="${currentDateStr}"]`);
                    if (dayCell) dayCell.style.backgroundColor = '#007BFF'; // Azul para seleccionados
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            } else if (selectedPickupDate) {
                const dayCell = document.querySelector(`.fc-day[data-date="${selectedPickupDate}"]`);
                if (dayCell) dayCell.style.backgroundColor = '#007BFF'; // Azul para fecha inicial seleccionada
            }
        }

        function checkRangeOverlap(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            return calendar.getEvents().some(event => {
                if (!event.extendedProps.available) {
                    const eventStart = new Date(event.startStr);
                    const eventEnd = new Date(event.endStr);

                // Verificar si algún día del rango seleccionado se solapa con un rango reservado
                    return (
                        (start >= eventStart && start < eventEnd) || // Inicio dentro de un rango reservado
                        (end > eventStart && end <= eventEnd) || // Fin dentro de un rango reservado
                        (start <= eventStart && end >= eventEnd) // Cubre completamente un rango reservado
                    );
                }
                return false;
             });
        }

        function resetSelection() {
            selectedPickupDate = null;
            selectedReturnDate = null;
            pickupInput.value = '';
            returnInput.value = '';
            highlightSelectedDates();
        }

        portSelect.addEventListener('change', function () {
            selectedPickupDate = null;
            selectedReturnDate = null;
            pickupInput.value = '';
            returnInput.value = '';
            highlightSelectedDates();
            calendar.refetchEvents(); // Recargar eventos según el puerto seleccionado
        });

        // Estilos para días seleccionados
        const style = document.createElement('style');
        style.innerHTML = `
            .fc-day.fc-day-past {
                pointer-events: none;
                opacity: 0.5;
            }
            .fc-day[data-date] {
                transition: background-color 0.2s ease;
            }
        .fc-day-today {
                background-color: transparent !important; /* Quitar el fondo del día actual */
                color: inherit !important; /* Restaurar el color de texto */
            }
        `;
        document.head.appendChild(style);

        calendar.render();
    });
</script>