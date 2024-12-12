@extends('layouts.public')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('node_modules/normalize.css/normalize.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">

<style>
    html {
      scroll-behavior: smooth;
    }
</style>

  <!-- Banner Section -->
<section class="banner">
  <video class="banner-video" autoplay muted loop>
    <source src="{{ asset('img/video-banner.mp4') }}" type="video/mp4">
  </video>
  <div class="overlay"></div>
  <div class="banner-content">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    <h1>Alquiler de Barco en Denia</h1>
    <h2>GTP LUX | Sun & Mediterranean Sea</h2>
    <a href="#slider" class="btn">Reservar</a>
  </div>
</section>

<!-- Formulario de reserva en forma de card centrado -->
<div class="reservation-form-wrapper">
    <div class="container">
        <div class="card mx-auto" style="width: 50%;">
            <div class="card-body">
                <form id="reservation-form" action="http://127.0.0.1:8000" method="GET">
                    <input type="hidden" name="_token" value="ocG5Jzfeyje4G7zL7KcHWNOrKmk4w5o12oGkVr0m" autocomplete="off">                
                    <div class="mb-3">
                        <label for="port_id" class="form-label">Puerto:</label>
                        <select id="port_id" name="port_id" class="form-control" required="">
                            <option value="">Seleccione un puerto</option>
                            <option value="1">Marina De Denia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="boat_id" class="form-label">Selecciona un Barco:</label>
                        <select id="boat_id" name="boat_id" class="form-control" required="">
                            <option value="">Seleccione un barco</option>
                            <option value="3">Sunseeker Portofino 53</option>
                            <option value="4">Princess V65</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
                            <input type="text" id="pickup_date" name="pickup_date" class="form-control date-picker" readonly="" required="">
                        </div>
                        <div class="col">
                            <label for="return_date" class="form-label">Fecha de Entrega:</label>
                            <input type="text" id="return_date" name="return_date" class="form-control date-picker" readonly="" required="">
                        </div>
                    </div>
                    <button type="submit" class="btn-form">Reservar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="luxury-section">
  <h2 class="luxury-title">Nuestros Servicios</h2>
  <div class="luxury-iconsContainer">
    <!-- Columna 1 -->
    <div class="luxury-iconCard">
      <div class="luxury-icon" style="background-image: url('https://kitpro.site/sailey/wp-content/uploads/sites/153/2023/03/icon-1.png');"></div>
      <h3>Luxury Yachts &amp; Boats</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a href="#" class="luxury-button">Learn More</a>
    </div>
    <!-- Columna 2 -->
    <div class="luxury-iconCard">
      <div class="luxury-icon" style="background-image: url('https://kitpro.site/sailey/wp-content/uploads/sites/153/2023/03/icon-2.png');"></div>
      <h3>Charter Guide</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a href="#" class="luxury-button">Learn More</a>
    </div>
    <!-- Columna 3 -->
    <div class="luxury-iconCard">
      <div class="luxury-icon" style="background-image: url('https://kitpro.site/sailey/wp-content/uploads/sites/153/2023/03/icon-3.png');"></div>
      <h3>Party &amp; Events</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a href="#" class="luxury-button">Learn More</a>
    </div>
    <!-- Columna 4 -->
    <div class="luxury-iconCard">
      <div class="luxury-icon" style="background-image: url('https://kitpro.site/sailey/wp-content/uploads/sites/153/2023/03/icon-4.png');"></div>
      <h3>Private Trips</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
      <a href="#" class="luxury-button">Learn More</a>
    </div>
  </div>
</section>

<!-- Slider -->
<section id="slider" class="slider-container">
    <!-- Título principal -->
  <h2 class="slider-title">Te ofrecemos una experiencia inolvidable</h2>
  <!-- Primera sección: Imagen derecha, texto izquierda -->
  <div class="info-row">
    <div class="slider-with-arrows">
      <button class="prev">&lt;</button>
      <div class="slider">
        <div class="slides">
          <img src="{{ asset('img/yates.png') }}" alt="Imagen 1">
          <img src="{{ asset('img/yates2.png') }}" alt="Imagen 2">
      </div>
    </div>
      <button class="next">&gt;</button>
  </div>
  <div class="info-text">
    <h3>Lancha Sunseeker Portofino 53 800cv</h3>
    <p>Alquiler de Yates en Denia
    Navegue en el exclusivo Sunseeker Portofino 53, un lujoso barco abierto de día diseñado para el confort y la relajación. 
    Con capacidad para 11 personas, este yate ofrece 2 baños completos, 3 cabinas, un salón de planta abierta y una cocina completa, perfecta para una experiencia inolvidable.</p>
    <a href="{{ route('sunseeker', ['pickup_date' => request()->pickup_date, 'return_date' => request()->return_date]) }}">
    <button id="reservation-btn" class="btn">MÁS INFORMACIÓN</button>
    </a>
  </div>
</div>

<!-- Segunda sección: Imagen izquierda, texto derecha -->
<div class="info-row reverse">
  <div class="slider-with-arrows">
    <button class="prev">&lt;</button>
    <div class="slider">
      <div class="slides">
        <img src="{{ asset('img/yates3.png') }}" alt="Imagen 3">
        <img src="{{ asset('img/yates4.png') }}" alt="Imagen 4">
      </div>
      </div>
     <button class="next">&gt;</button>
  </div>
  <div class="info-text">
    <h3>Princess V65</h3>
    <p>Navegue en el exclusivo Princess V65, un lujoso barco abierto de día diseñado para el confort y la relajación. Con capacidad para 10 invitados, este yate ofrece 3 baños completos y camarotes. 
      Un salón de planta abierta y una cocina completa, perfecta para una experiencia inolvidable.</p>
    <a href="{{ route('princess', ['pickup_date' => request()->pickup_date, 'return_date' => request()->return_date]) }}">
      <button id="reservation-btn" class="btn">MÁS INFORMACIÓN</button>
    </a>
  </div>
</div>
</section>

<!-- Mapa -->
<section class="map-form">
  <div class="map-container">
    <h3 class="map-title">Nuestra Ubicación</h3>
    <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</section>
<section>
  <div class="form-container">
    <div class="form-card">
      <h3>¿Tienes alguna duda?</h3>
      <form>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Escribe tu apellido">

        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Escribe tu teléfono">

        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" placeholder="Escribe tu correo">

        <label for="motivo">Asunto</label>
        <textarea id="motivo" name="motivo" placeholder="Escribe tu consulta"></textarea>

        <button class="form-button">Enviar</button>
      </form>
    </div>
  </div>
</section>

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
      <p class="location">Marina Naviera Balear, Av. de Gabriel Roca, 07013 Palma, Balearic Islands</p>
    </div>
  </div>
</footer>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/menu-burger.js') }}"></script>

<!-- Aquí comienza el nuevo script -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('availability-calendar');
    const portSelect = document.getElementById('port_id');
    const pickupInput = document.getElementById('pickup_date');
    const returnInput = document.getElementById('return_date');
    
    // Inicializa las fechas de selección
    let selectedStartDate = pickupInput.value;
    let selectedEndDate = returnInput.value;
    
    // ID del barco desde el formulario
    const boatId = document.getElementById('boat_id').value;
    
    // Inicializa FullCalendar para mostrar la disponibilidad
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
            if (clickedDate === selectedStartDate) {
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
            if (!selectedStartDate) {
                selectedStartDate = clickedDate;
                pickupInput.value = selectedStartDate;
            } else if (!selectedEndDate) {
                if (clickedDate <= selectedStartDate) {
                    alert('La fecha de entrega debe ser posterior a la fecha de recogida.');
                    return;
                }

                selectedEndDate = clickedDate;
                returnInput.value = selectedEndDate;
            } else {
                selectedStartDate = clickedDate;
                selectedEndDate = null;
                pickupInput.value = selectedStartDate;
                returnInput.value = '';
            }

            highlightSelectedDates();
        },
    });

    // Mostrar calendario cuando se elige una fecha
    pickupInput.addEventListener('click', function () {
        calendarEl.style.display = 'block';
        calendar.render();
    });

    returnInput.addEventListener('click', function () {
        calendarEl.style.display = 'block';
        calendar.render();
    });

    // Cerrar calendario cuando se hace clic fuera
    document.addEventListener('click', function (event) {
        if (!calendarEl.contains(event.target) && !event.target.matches('#pickup_date, #return_date')) {
            calendarEl.style.display = 'none';
        }
    });

    // Resaltar las fechas seleccionadas
    function highlightSelectedDates() {
        calendar.getEvents().forEach(function (event) {
            event.setProp('backgroundColor', '');
            event.setProp('borderColor', '');
        });

        if (selectedStartDate) {
            calendar.getEvents().forEach(function (event) {
                if (event.startStr === selectedStartDate) {
                    event.setProp('backgroundColor', '#9b59b6');
                    event.setProp('borderColor', '#9b59b6');
                }
            });
        }

        if (selectedEndDate) {
            calendar.getEvents().forEach(function (event) {
                if (event.startStr === selectedEndDate) {
                    event.setProp('backgroundColor', '#9b59b6');
                    event.setProp('borderColor', '#9b59b6');
                }
            });
        }
    }

    // Resetear la selección de fechas
    function resetSelection() {
        selectedStartDate = null;
        selectedEndDate = null;
        pickupInput.value = '';
        returnInput.value = '';
        highlightSelectedDates();
    }

    // Recargar eventos cuando se seleccione un puerto
    portSelect.addEventListener('change', function () {
        selectedStartDate = null;
        selectedEndDate = null;
        pickupInput.value = '';
        returnInput.value = '';
        highlightSelectedDates();
        calendar.refetchEvents();  // Recargar eventos según el puerto seleccionado
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

