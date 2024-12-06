@extends('layouts.app')


@section('content')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('node_modules/normalize.css/normalize.css') }}">
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

  <!-- Texto de bienvenida -->
  <section class="text-home">
    <div class="container">
      <!-- Columna de texto -->
      <div class="text-column">
        <h2>¡Bienvenido a GTP LUX!</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum quis autem saepe rem ab incidunt maxime provident modi fuga doloribus, ducimus ut id ipsa, eum tempora! Perspiciatis dolor velit veniam?
        </p>
      </div>

      <!-- Columna de imagen -->
      <div class="image-column">
        <img src="{{ asset('img/yates.png') }}" alt="Yate elegante" class="oval-image">
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
        <h3>VALKYRYA</h3>
        <p>Valkyrya es el inicio de una experiencia exclusiva en el mar. 
          Con un diseño elegante, solarium, toldo retráctil, música de alta calidad y nevera, es el yate perfecto para explorar las aguas cristalinas de la isla. 
          Su motor de 200CV garantiza una navegación suave, permitiéndote disfrutar de cada parada con lujo y confort.</p>
        <a href="{{ route('valkyrya') }}">
          <button id="reservation-btn" class="btn">VER DISPONIBILIDAD</button>
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
        <h3>NADINE</h3>
        <p>Nadine es el barco perfecto para una experiencia inolvidable. 
          Con dos potentes motores de 300CV, toldo retráctil, solarium, música y nevera, te ofrece el máximo confort y personalización para recorrer los rincones más exclusivos del mar. 
          Disfruta de una jornada de lujo adaptada a tus deseos.</p>
        <a href="{{ route('nadine') }}">
          <button id="reservation-btn" class="btn">VER DISPONIBILIDAD</button>
        </a>
      </div>
    </div>
  </section>
<!-- Formulario de Reserva -->
<div class="container">
    <h1>Reserva de Barco</h1>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('welcome') }}" method="GET">
    @csrf
    <div class="mb-3">
        <label for="port_id" class="form-label">Puerto:</label>
        <select id="port_id" name="port_id" class="form-control" required>
            <option value="">Seleccione un puerto</option>
            @foreach($ports as $port)
                <option value="{{ $port->id }}">{{ $port->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="boat_id" class="form-label">Selecciona un Barco:</label>
        <select id="boat_id" name="boat_id" class="form-control" required>
            <option value="">Seleccione un barco</option>
            <option value="3">Valkyrya</option> <!-- ID correcto según tu base de datos -->
            <option value="2">Nadine</option>
        </select>
    </div>

    <!-- Fechas de recogida y entrega -->
    <div class="mb-3 row">
        <div class="col">
            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
            <input type="text" id="pickup_date" name="pickup_date" class="form-control" readonly required>
        </div>
        <div class="col">
            <label for="return_date" class="form-label">Fecha de Entrega:</label>
            <input type="text" id="return_date" name="return_date" class="form-control" readonly required>
        </div>
    </div>

    <div id="availability-calendar" style="display: none; min-height: 300px; border: 1px solid #ccc; margin-top: 20px;"></div>

    <button type="submit" class="btn btn-primary">Reservar</button>
    </form>
</div>




  <!-- Mapa -->
  <section class="map-form">
    <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=..." width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="form-container">
      <h3>¿Tienes alguna duda?</h3>
      <form>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido">

        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono">

        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo">

        <label for="motivo">Asunto</label>
        <textarea id="motivo" name="motivo"></textarea>

        <button class="form-button">Enviar</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
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
      const portId = document.getElementById('port_id');
      const boatId = document.getElementById('boat_id');
      const startDate = document.getElementById('pickup_date');
      const endDate = document.getElementById('return_date');
      const availableBoatsDiv = document.getElementById('available-boats');

      let selectedStartDate = startDate.value;
      let selectedEndDate = endDate.value;

      // Initialize FullCalendar for displaying availability
      const calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap',
          locale: 'es',
          initialView: 'dayGridMonth',
          headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: async function (fetchInfo, successCallback, failureCallback) {
              try {
                  const response = await axios.get(`/reservations/calendar/${boatId.value || ''}/${portId.value || ''}/${selectedStartDate || ''}/${selectedEndDate || ''}`);
                  const reservations = response.data;

                  const events = reservations.map(reservation => ({
                      title: reservation.title || reservation.boat_name || 'Disponible',
                      start: reservation.start,
                      end: reservation.end,
                      color: reservation.color || 'red',
                      price: reservation.price || '',
                  }));

                  successCallback(events);
              } catch (error) {
                  console.error('Error al cargar las reservas:', error);
                  failureCallback(error);
              }
          },
          dateClick: function(info) {
              // Logic for selecting pickup and return dates
              if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
                  selectedStartDate = info.dateStr;
                  startDate.value = selectedStartDate;
              } else {
                  selectedEndDate = info.dateStr;
                  endDate.value = selectedEndDate;
              }

              highlightSelectedDates();
          }
      });

      // Show calendar when start date is clicked
      startDate.addEventListener('click', function() {
          calendarEl.style.display = 'block';
          calendar.render();
      });

      // Show calendar when end date is clicked
      endDate.addEventListener('click', function() {
          calendarEl.style.display = 'block';
          calendar.render();
      });

      // Close calendar when clicking outside
      document.addEventListener('click', function(event) {
          if (!calendarEl.contains(event.target) && !event.target.matches('#pickup_date, #return_date')) {
              calendarEl.style.display = 'none';
          }
      });

      function highlightSelectedDates() {
          // Highlight selected dates
          calendar.getEvents().forEach(function(event) {
              event.setProp('backgroundColor', '');
              event.setProp('borderColor', '');
          });

          if (selectedStartDate) {
              calendar.getEvents().forEach(function(event) {
                  if (event.startStr === selectedStartDate) {
                      event.setProp('backgroundColor', '#9b59b6');
                      event.setProp('borderColor', '#9b59b6');
                  }
              });
          }

          if (selectedEndDate) {
              calendar.getEvents().forEach(function(event) {
                  if (event.startStr === selectedEndDate) {
                      event.setProp('backgroundColor', '#9b59b6');
                      event.setProp('borderColor', '#9b59b6');
                  }
              });
          }
      }

      // Fetch available boats based on selected dates and port
      async function fetchAvailableBoats() {
          try {
              const response = await axios.get(`/available-boats?port_id=${portId.value}&start_date=${selectedStartDate}&end_date=${selectedEndDate}`);
              const availableBoats = response.data;

              availableBoatsDiv.innerHTML = '';
              if (availableBoats.length > 0) {
                  availableBoats.forEach(boat => {
                      const boatDiv = document.createElement('div');
                      boatDiv.classList.add('boat-info');
                      boatDiv.innerHTML = `
                          <h3>${boat.name}</h3>
                          <p>Precio: ${boat.price} EUR por día</p>
                          <button class="btn btn-primary" data-boat-id="${boat.id}">Reservar</button>
                      `;
                      availableBoatsDiv.appendChild(boatDiv);
                  });
              } else {
                  availableBoatsDiv.innerHTML = '<p>No hay barcos disponibles para esas fechas.</p>';
              }
          } catch (error) {
              console.error('Error al obtener los barcos disponibles:', error);
          }
      }

      // Call fetchAvailableBoats on form submission
      document.getElementById('reservation-form').addEventListener('submit', function(event) {
          event.preventDefault();
          fetchAvailableBoats();
      });
  });
</script>

@endsection
