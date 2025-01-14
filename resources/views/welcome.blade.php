@extends('layouts.public')

@push('styles')
@vite('resources/css/menuhome.css')
@vite('resources/css/style.css')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css">

  
  <!-- CSS embebido para rutas dinámicas -->
  <style>
    .slider-container {
      background: linear-gradient(
          rgba(0, 0, 0, 0.8),
          rgba(0, 0, 0, 0.5)
        ),url('{{ asset('img/fondo-mar.jpg') }}');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
    }
    .form-container {
      background: linear-gradient(
          rgba(0, 0, 0, 0.8),
          rgba(0, 0, 0, 0.5)
        ),
        url('{{ asset('img/fondo-form.jpg') }}'); /* Ruta actualizada con asset() */
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
    }
    .map-form {
      background: linear-gradient(
          rgba(0, 0, 0, 0.8),
          rgba(0, 0, 0, 0.5)
        ),
        url('{{ asset('img/lineas-mapa.jpg') }}');
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
@endpush

  <!-- Banner Section -->
@section('content')

<header class="header">
    <nav class="navbar">
        <!-- Menú hamburguesa -->
        <label class="label_hamburguesa" for="menu_hamburguesa">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="list_icon" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </label>
        <input class="menu_hamburguesa" type="checkbox" id="menu_hamburguesa">

        <!-- Enlaces de navegación -->
        <ul class="ul_links">
            <li class="li_links"><a href="#" class="link">Inicio</a></li>
            <li class="li_links"><a href="#contacto" class="link">Contacto</a></li>
            <li class="li_links"><a href="#quienes-somos" class="link">Quiénes somos</a></li>
            <li class="li_links settingsDropdown">
            <div class="dropdown">
                <span class="value">
                    <img id="currentLanguageFlag" src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                </span>
                <ul class="dropdown-menu" id="languageDropdown">
                    @foreach (config('languages') as $code => $language)
                        <li>
                            <a href="#" class="language" data-lang="{{ $code }}">
                                <span class="flag-icon">{{ $language['flag'] }}</span> {{ $language['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        </ul>
    </nav>
</header>


<section class="banner">
  <video class="banner-video" autoplay muted loop>
    <source src="{{ asset('img/video-banner.mp4') }}" type="video/mp4">
  </video>
  <div class="overlay"></div>
  <div class="banner-content">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    <h1>Alquiler de Barco en Denia</h1>
    <h2>GTP LUX | Sun & Mediterranean Sea</h2>
  </div>
</section>

<!-- Formulario de reserva en forma de card centrado -->
<div class="reservation-form-wrapper">
    <div class="container">
        <div class="card mx-auto" style="width: 70%;">
            <div class="card-body">
                <!-- El formulario ahora se dirige a la ruta 'available.boats' -->
                <form action="{{ route('available.boats') }}" method="GET">
                    @csrf
                    <div class="mb-3">
                        <label for="port_id" class="form-label">Puerto:</label>
                        <select id="port_id" name="port_id" class="form-control" required style="display: block !important;">
                        <option value="">Lugar de salida</option>
                        <option value="1">Marina De Denia</option>
                        </select>
                    </div>
                    
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
                            <input type="text" id="pickup_date" name="pickup_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                        </div>
                        <div class="col">
                            <label for="return_date" class="form-label">Fecha de Entrega:</label>
                            <input type="text" id="return_date" name="return_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                        </div>
                    </div>

                    <!-- Contenedor para el calendario -->
                    <div id="availability-calendar" style="width: 100%; height: 300px; display: none;"></div>
                    <button type="submit" class="btn-form">Buscar barco</button>
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
      <div class="luxury-icon" style="background-image: url('img/icon-diamonds.svg');"></div>
      <h3>Luxury Yachts &amp; Boats</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <!-- Columna 2 -->
    <div class="luxury-iconCard">
    <div class="luxury-icon" style="background-image: url('img/icono-boat.svg');"></div>
    <h3>Charter Guide</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <!-- Columna 3 -->
    <div class="luxury-iconCard">
    <div class="luxury-icon" style="background-image: url('img/icon.copa.svg');"></div>
    <h3>Party &amp; Events</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <!-- Columna 4 -->
    <div class="luxury-iconCard">
    <div class="luxury-icon" style="background-image: url('img/icono-timon.svg');"></div>
    <h3>Private Trips</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
    <a href="{{ route('sunseeker') }}">
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
        <img src="{{ asset('img/yates3.png') }}" alt="Imagen 4">
      </div>
      </div>
     <button class="next">&gt;</button>
  </div>
  <div class="info-text">
    <h3>Princess V65</h3>
    <p>Navegue en el exclusivo Princess V65, un lujoso barco abierto de día diseñado para el confort y la relajación. Con capacidad para 10 invitados, este yate ofrece 3 baños completos y camarotes. 
      Un salón de planta abierta y una cocina completa, perfecta para una experiencia inolvidable.</p>
      <a href="{{ route('available.boats.no.dates', ['port_id' => 1, 'from_welcome' => true]) }}">
      <button id="reservation-btn" class="btn">MÁS INFORMACIÓN</button>
      </a>
  </div>
</div>
</section>

<!-- Mapa -->
<section class="map-form">
  <div class="map-container">
    <h3 class="map-title">Nuestra Ubicación</h3>
    <!-- Aquí está el iframe con el mapa de Google -->
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5445.977921593649!2d0.1118068481771686!3d38.84382343783137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m3!3e0!4m0!4m0!5e0!3m2!1ses!2ses!4v1734613497037!5m2!1ses!2ses"
      width="600" 
      height="450" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>
<section>
  <div class="form-container">
    <div class="form-card">
      <h3>¿Tienes alguna duda?</h3>
      <form>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ejemplo: Juan">

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" placeholder="Ejemplo: Pérez">

        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Ejemplo: +34 600 000 000">

        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" placeholder="Ejemplo: juan.perez@correo.com">

        <label for="motivo">Asunto</label>
        <textarea id="motivo" name="motivo" placeholder="Cuéntanos cómo podemos ayudarte..."></textarea>

        <button class="form-button">Enviar</button>
      </form>
    </div>
  </div>
</section>

<!-- Footer personalizado -->
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

<!-- Scripts -->
@section('scripts')
<script src="{{ asset('build/assets/slider-DKNDmEBG.js') }}"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <!-- jQuery UI CSS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form'); 
      const calendarEl = document.getElementById('availability-calendar');
      const portSelect = document.getElementById('port_id');
      const pickupInput = document.getElementById('pickup_date');
      const returnInput = document.getElementById('return_date');
      const languageDropdown = document.getElementById('languageDropdown');
      const currentLanguageFlag = document.getElementById('currentLanguageFlag');
      const currentLanguageText = document.getElementById('currentLanguageText');

    // Evitar que el dropdown se cierre al hacer clic dentro de él
    languageDropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Manejar clics en las opciones del dropdown
    languageDropdown.querySelectorAll('.language').forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Evitar la recarga de la página

            const selectedLang = this.dataset.lang; // Idioma seleccionado
            const selectedFlag = this.querySelector('img').src; // Ruta de la bandera seleccionada
            const selectedText = this.textContent.trim(); // Nombre del idioma seleccionado

            // Actualizar la bandera y el texto del idioma actual
            currentLanguageFlag.src = selectedFlag;
            currentLanguageText.textContent = selectedText;

            // Cambiar idioma en el backend
            fetch(`/set-language?lang=${selectedLang}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cerrar el dropdown después de seleccionar
                        languageDropdown.style.display = 'none';

                        // Opcional: Recargar la página para actualizar traducciones
                        location.reload();
                    }
                })
                .catch(error => console.error('Error al cambiar el idioma:', error));
        });
    });

    // Cerrar el dropdown si se hace clic fuera de él
    document.addEventListener('click', function (event) {
        const dropdownContainer = languageDropdown.closest('.dropdown');
        if (!dropdownContainer.contains(event.target)) {
            dropdownContainer.querySelector('.dropdown-menu').style.display = 'none'; // Oculta el dropdown
        }
    });

    // Mostrar el dropdown al hacer clic en el contenedor
    const dropdownContainer = languageDropdown.closest('.dropdown');
    dropdownContainer.addEventListener('click', function () {
        const menu = this.querySelector('.dropdown-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

      // Obtener las fechas seleccionadas, si existen
      const selectedStartDate = '{{ request()->pickup_date }}'; // Fecha de recogida
      const selectedEndDate = '{{ request()->return_date }}'; // Fecha de entrega
      
      if (form) {
        form.addEventListener('submit', function (e) {
            console.log('Formulario enviado');
          });

      // Establecer las fechas en los campos de fecha si ya están en la URL
      if (selectedStartDate) pickupInput.value = selectedStartDate;
      if (selectedEndDate) returnInput.value = selectedEndDate;

      // Inicializa FullCalendar
      const calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap',
          locale: 'es',
          initialView: 'dayGridMonth',
          headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: "",
          },
          events: async function (fetchInfo, successCallback, failureCallback) {
              try {
                  const portId = portSelect.value;
                  if (!portId || !selectedStartDate || !selectedEndDate) {
                      successCallback([]);
                      return;
                  }

                  const response = await axios.get(`/reservations/calendar/${portId}`, {
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

              // Si no se ha seleccionado fecha de recogida, selecciona la fecha de recogida
              if (!pickupInput.value) {
                  pickupInput.value = clickedDate;
                  // Establece la fecha mínima para la fecha de entrega
                  const pickupDate = new Date(clickedDate);
                  returnInput.setAttribute('min', pickupDate.toISOString().split('T')[0]);
              }
              // Si ya se ha seleccionado la fecha de recogida, selecciona la fecha de entrega
              else if (!returnInput.value) {
                  returnInput.value = clickedDate;
              }
              // Si ya se han seleccionado ambas fechas, reiniciar la selección
              else {
                  pickupInput.value = clickedDate;
                  returnInput.value = ''; // Limpiar la fecha de entrega
                  returnInput.removeAttribute('min'); // Remover la restricción mínima
              }
          },
      });

      // Mostrar el calendario cuando se hace clic en los campos de fecha
      pickupInput.addEventListener('click', function () {
          calendarEl.style.display = 'block';  // Muestra el calendario
          calendar.render();  // Renderiza el calendario
      });

      returnInput.addEventListener('click', function () {
          calendarEl.style.display = 'block';  // Muestra el calendario
          calendar.render();  // Renderiza el calendario
      });

      // Validación del formulario antes de enviarlo
      form.addEventListener('submit', function (e) {
          // Restablecer mensaje de error
          errorMessage.textContent = '';

          // Verificar si el puerto, las fechas de recogida y entrega están vacíos
          if (!portSelect.value || !pickupInput.value || !returnInput.value) {
              e.preventDefault(); // Evitar el envío del formulario
              errorMessage.textContent = '¡Por favor, selecciona un puerto y ambas fechas (recogida y entrega)!'; // Mostrar mensaje de error
          }
      });

      // Cerrar el calendario si se hace clic fuera de él
      document.addEventListener('click', function (event) {
          if (!calendarEl.contains(event.target) && !event.target.matches('#pickup_date, #return_date')) {
              calendarEl.style.display = 'none';  // Oculta el calendario
          }
      });

      calendar.render();
}});

</script>
@endsection
