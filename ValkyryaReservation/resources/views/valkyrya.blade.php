<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<form action="{{ route('reservations.store') }}" method="POST" id="reservation-form">
  @csrf
  <label for="fname">Nombre:</label>
  <input type="text" id="fname" name="name" placeholder="Nombre" required>

  <label for="lname">Apellido:</label>
  <input type="text" id="lname" name="lastname" placeholder="Apellido">

  <label for="email">Correo Electrónico:</label>
  <input type="email" id="email" name="email" placeholder="Correo" required>

  <label for="phone">Teléfono:</label>
  <input type="tel" id="phone" name="phone" placeholder="Teléfono" required>

  <label for="port">Puerto:</label>
  <select id="port" name="port_id" onchange="updateBoats(this.value)" required>
    <option value="">Selecciona un puerto</option>
    @foreach($ports as $port)
      <option value="{{ $port->id }}">{{ $port->name }}</option>
    @endforeach
  </select>

  <label for="boat">Barco:</label>
  <select id="boat" name="boat_id" required>
    <option value="">Selecciona un barco</option>
  </select>

  <label for="pickup-date">Fecha de Recogida:</label>
  <input type="date" id="pickup-date" name="pickup_date" required>

  <label for="return-date">Fecha de Entrega:</label>
  <input type="date" id="return-date" name="return_date" required>

  <button type="submit" class="btn">Reservar</button>
</form>

<section class="availability">
  <h3>Disponibilidad</h3>
  <div id="calendar-container">
    <div id="calendar"></div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: async function (fetchInfo, successCallback, failureCallback) {
        const boatId = document.getElementById('boat').value;
        if (!boatId) {
          successCallback([]); // Si no hay barco seleccionado, no muestra eventos.
          return;
        }
        try {
          const response = await axios.get(`/reservations/calendar/${boatId}`);
          const reservations = response.data.map(reservation => ({
            title: 'Reservado',
            start: reservation.pickup_date,
            end: reservation.return_date,
            color: 'red'
          }));
          successCallback(reservations);
        } catch (error) {
          console.error('Error al cargar las reservas:', error);
          failureCallback(error);
        }
      }
    });

    calendar.render();

    // Actualizar el calendario cuando se seleccione un barco
    document.getElementById('boat').addEventListener('change', () => {
      calendar.refetchEvents();
    });
  });

  function updateBoats(portId) {
    axios.get(`/boats/by-port/${portId}`)
      .then(response => {
        const boatSelect = document.getElementById('boat');
        boatSelect.innerHTML = '<option value="">Selecciona un barco</option>';
        response.data.forEach(boat => {
          const option = document.createElement('option');
          option.value = boat.id;
          option.text = boat.name;
          boatSelect.add(option);
        });
      })
      .catch(error => {
        console.error('Error al cargar los barcos:', error);
      });
  }
</script>
