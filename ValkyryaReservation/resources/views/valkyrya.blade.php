@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reserva Valkyrya</h1>
    <form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <input type="hidden" name="boat_id" value="3"> <!-- ID de Valkyrya -->

    <label for="fname">Nombre:</label>
    <input type="text" id="fname" name="name" placeholder="Nombre" required>

    <label for="lname">Apellido:</label>
    <input type="text" id="lname" name="lastname" placeholder="Apellido">

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" placeholder="Correo" required>

    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="phone" placeholder="Teléfono" required>

    <label for="port">Puerto:</label>
    <select id="port" name="port_id" required>
        <option value="">Selecciona un puerto</option>
        @foreach($ports as $port)
            <option value="{{ $port->id }}">{{ $port->name }}</option>
        @endforeach
    </select>

    <label for="pickup-date">Fecha de Recogida:</label>
    <input type="date" id="pickup-date" name="pickup_date" required>

    <label for="return-date">Fecha de Entrega:</label>
    <input type="date" id="return-date" name="return_date" required>

    <button type="submit" class="btn btn-primary">Reservar</button>
</form>


    <section class="availability">
        <h3>Disponibilidad</h3>
        <div id="calendar-container">
            <div id="calendar"></div>
        </div>
    </section>
</div>

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
                try {
                    const response = await axios.get(`/reservations/calendar/{{ $boatId }}`);
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
    });
</script>
@endsection
