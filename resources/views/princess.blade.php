@extends('layouts.public')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/princess.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@section('content')

<header class="topbar">
    <div class="topbar__logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <nav class="nav-menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <div class="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="mobile-menu">
        <span class="close-menu">✕</span>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>

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
    <h1>Calendario</h1>
    <h4>Añade las fechas para ver precios y disponibilidad</h4>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Formulario de reserva y calendario -->
        <div class="col-md-6">
            <form id="reservation-form" action="{{ route('boats.reserve', ['boatId' => 4]) }}" method="POST">
                @csrf
                <input type="hidden" name="boat_id" value="4">

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

                <!-- Calendario -->
                <div id="availability-calendar" class="calendar-wrapper mt-3">
                    <!-- Aquí se renderiza el calendario -->
                </div>
            </form>
        </div>

        <!-- Columna derecha con secciones separadas -->
        <div class="col-md-6">
            <!-- Tarjeta de precios -->
            <section id="price-summary" class="price-card mt-3" style="display: {{ $price > 0 ? 'block' : 'none' }}">
                <h5>Resumen de precios</h5>
                <p><strong>Total:</strong> <span id="total-price">{{ $price }}€</span></p>
                <button id="price-list-button" class="btn btn-info mt-3">Consultar la lista de precios</button>
                <form id="reservation-form" action="{{ route('boats.reserve', ['boatId' => $boat->id]) }}" method="POST">
                @csrf
                    <input type="hidden" name="port_id" id="hidden-port-id" value="{{ request('port_id') }}">
                    <input type="hidden" name="name" value="Reserva sin nombre">
                    <input type="hidden" name="pickup_date" id="hidden-pickup-date" value="{{ request('pickup_date') }}">
                    <input type="hidden" name="return_date" id="hidden-return-date" value="{{ request('return_date') }}">
                    <input type="hidden" name="price" id="hidden-price" value="{{ $price }}">

                    <button type="submit" class="btn btn-primary mt-3">Proceder al Pago</button>
                </form>
            </section>


            <!-- Sección de condiciones -->
            <section id="conditions-section" class="conditions-section mt-3">
                <h2 class="conditions-section__title">Condiciones</h2>
                <div class="conditions-section__content">
                    <p><strong>Check-in y check-out</strong></p>
                    <p>Hora para el check-in (alquiler de un día): 9:30</p>
                    <p>Hora para el check-out (alquiler de un día): 16:30</p>
                    <p>Hora de recogida: 9:30</p>
                    <p>Hora de entrega: 16:30</p>

                    <p><strong>Normas del barco</strong></p>
                    <p>Fianza: 1.500 €</p>
                    <p>Carburante incluido en el precio: No</p>

                    <p><strong>Política de cancelación</strong></p>
                    <p>Reembolso de hasta el 70% hasta 30 días antes de la llegada, gastos de gestión y del servicio no incluidos.</p>
                </div>
            </section>
        </div>
    </div>
</div>


<!-- Modal para lista de precios -->
<div id="priceListModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de precios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-price-list-container">
                <!-- Contenido dinámico de la lista de precios -->
            </div>
        </div>
    </div>
</div>


<div class="reviews-conditions-container">
  <!-- Sección de Opiniones -->
  <section id="reviews-section" class="reviews-section">
    <h2 class="reviews-section__title">OPINIONES</h2>
    
    <!-- Información del propietario -->
    <div class="reviews-section__owner">
      <p><strong>Idioma(s) hablado(s):</strong> Inglés, Español</p>
      <button class="btn-contact-owner">Contactar con el propietario</button>
    </div>
    
    <!-- Formulario para dejar una opinión -->
    <div class="reviews-section__form">
      <h3>Deja tu opinión</h3>
      <form id="review-form">
        <textarea id="review-text" placeholder="Escribe tu opinión aquí..." required></textarea>
        <div class="review-stars">
          <label>Puntúa:</label>
          <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 estrellas">★</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 estrellas">★</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 estrellas">★</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 estrellas">★</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 estrella">★</label>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn-submit-review">Enviar opinión</button>
          <div class="reviews-section__translate">
            <label class="switch">
              <input type="checkbox" id="translate-reviews">
              <span class="slider"></span>
            </label>
            <span>Traducir opiniones</span>
          </div>
        </div>
      </form>
    </div>
    
    <!-- Listado de opiniones -->
    <div class="reviews-section__list">
      <ul id="reviews-list">
        <!-- Las opiniones se insertarán dinámicamente aquí -->
      </ul>
    </div>
  </section>
</div>

<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-left">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo">
      </a>
      <div class="social-icons">
        <a href="https://instagram.com" target="_blank">
          <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
        </a>
        <a href="https://facebook.com" target="_blank">
          <img src="{{ asset('img/facebook.png') }}" alt="Facebook">
        </a>
      </div>
      <p class="contact-email">contacto@empresa.com</p>
      <p class="location">Puerto de Dénia, Edificio Capitanía, Dársena de Babor, s/n, 03700 Dénia, Alicante</p>
    </div>
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
<script src="{{ asset('js/loadMoreDescription2.js') }}"></script>
<script src="{{ asset('js/listapreciosprincess.js') }}"></script>
<script src="{{ asset('js/syncddate.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/es.js"></script>
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
        const priceListButton = document.getElementById('price-list-button');
        const priceListModal = new bootstrap.Modal(document.getElementById('priceListModal'));
        document.getElementById('pickup_date').addEventListener('change', updateHiddenFields);
        document.getElementById('return_date').addEventListener('change', updateHiddenFields);

        function updateHiddenFields() {
            document.getElementById('hidden-pickup-date').value = document.getElementById('pickup_date').value;
            document.getElementById('hidden-return-date').value = document.getElementById('return_date').value;
            document.getElementById('hidden-price').value = document.getElementById('total-price').textContent.replace('€', '').trim();
        }

        let selectedPickupDate = null;
        let selectedReturnDate = null;

        // Función para calcular el precio
        function calculatePrice(boatId, startDate, endDate) {
            if (!startDate || !endDate) return;

            axios
                .get('/calculate-price', {
                    params: { boat_id: boatId, start_date: startDate, end_date: endDate },
                })
                .then((response) => {
                    const totalPrice = response.data.total_price;
                    showPriceSummary(totalPrice);
                })
                .catch((error) => {
                    console.error('Error al calcular el precio:', error);
                    alert('No se pudo calcular el precio. Intenta nuevamente.');
                });
        }

        // Mostrar resumen de precios
        function showPriceSummary(totalPrice) {
            if (totalPriceElement && priceSummary) {
                totalPriceElement.textContent = `${totalPrice}€`;
                priceSummary.style.display = 'block';
            }
        }

        // Manejo de cambios en las fechas
        function handleDateChange() {
            if (pickupInput.value && returnInput.value) {
                const startDate = new Date(pickupInput.value).toISOString().split('T')[0];
                const endDate = new Date(returnInput.value).toISOString().split('T')[0];
                calculatePrice(boatId, startDate, endDate);
            }
        }

        pickupInput.addEventListener('change', handleDateChange);
        returnInput.addEventListener('change', handleDateChange);

        // Inicializar el calendario
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

                    const events = response.data.map(reservation => ({
                        title: reservation.available ? 'Disponible' : 'Reservado',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.available ? 'green' : 'red',
                        extendedProps: { available: reservation.available },
                    }));

                    successCallback(events);
                } catch (error) {
                    failureCallback(error);
                }
            },
            dateClick: handleDateClick,
        });

        calendar.render();

        // Manejo de selección de fechas
        function handleDateClick(info) {
            const clickedDate = info.dateStr;

            if (clickedDate === selectedPickupDate) {
                resetSelection();
                return;
            }

            const isReserved = calendar.getEvents().some(event =>
                !event.extendedProps.available &&
                clickedDate >= event.startStr &&
                clickedDate < event.endStr
            );

            if (isReserved) {
                alert('Este día está reservado. Por favor selecciona otra fecha.');
                return;
            }

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
                    alert('El rango seleccionado incluye días reservados.');
                    return;
                }

                selectedReturnDate = clickedDate;
                returnInput.value = selectedReturnDate;
                handleDateChange(); // Calcular precio al seleccionar rango
            } else {
                selectedPickupDate = clickedDate;
                selectedReturnDate = null;
                pickupInput.value = selectedPickupDate;
                returnInput.value = '';
            }

            highlightSelectedDates();
        }

        // Resaltar fechas seleccionadas
        function highlightSelectedDates() {
            document.querySelectorAll('.fc-day[data-date]').forEach(dayCell => {
                dayCell.style.backgroundColor = '';
            });

            if (selectedPickupDate && selectedReturnDate) {
                let currentDate = new Date(selectedPickupDate);
                const endDate = new Date(selectedReturnDate);

                while (currentDate <= endDate) {
                    const currentDateStr = currentDate.toISOString().split('T')[0];
                    const dayCell = document.querySelector(`.fc-day[data-date="${currentDateStr}"]`);
                    if (dayCell) dayCell.style.backgroundColor = '#007BFF';
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            } else if (selectedPickupDate) {
                const dayCell = document.querySelector(`.fc-day[data-date="${selectedPickupDate}"]`);
                if (dayCell) dayCell.style.backgroundColor = '#007BFF';
            }
        }

        // Verificar superposición de fechas
        function checkRangeOverlap(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            return calendar.getEvents().some(event => {
                if (!event.extendedProps.available) {
                    const eventStart = new Date(event.startStr);
                    const eventEnd = new Date(event.endStr);

                    return (
                        (start >= eventStart && start < eventEnd) ||
                        (end > eventStart && end <= eventEnd) ||
                        (start <= eventStart && end >= eventEnd)
                    );
                }
                return false;
            });
        }

        // Reiniciar selección
        function resetSelection() {
            selectedPickupDate = null;
            selectedReturnDate = null;
            pickupInput.value = '';
            returnInput.value = '';
            priceSummary.style.display = 'none'; // Ocultar resumen de precios
            highlightSelectedDates();
        }

        portSelect.addEventListener('change', function () {
            resetSelection();
            calendar.refetchEvents();
        });

        // Estilo personalizado para días seleccionados
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
                background-color: transparent !important;
                color: inherit !important;
            }
        `;
        document.head.appendChild(style);
    });
</script>