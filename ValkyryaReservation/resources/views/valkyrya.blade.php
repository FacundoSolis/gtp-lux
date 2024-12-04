@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Valkyrya</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="boat_id" value="{{ $boatId }}"> <!-- Establecer el ID del barco -->

        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="form-control" required>
        </div>

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
            <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
            <input type="date" id="pickup_date" name="pickup_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Fecha de Entrega:</label>
            <input type="date" id="return_date" name="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>

    <!-- Calendario de Disponibilidad -->

    <div class="card shadow-sm mt-5">
    <div class="card-header bg-info text-white">
        <h5>Calendario de Disponibilidad</h5>
    </div>
    <div class="card-body">
        <div id="availability-calendar" style="min-height: 500px; border: 1px solid red;" data-boat-id="{{ $boatId }}"></di>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('availability-calendar'); // ID del div del calendario
        const boatId = @json($boatId); // Pasar el ID del barco desde PHP

        const calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap', // Opcional para temas de Bootstrap
            locale : 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: async function (fetchInfo, successCallback, failureCallback) {
                try {
                    const response = await axios.get(`/reservations/calendar/${boatId}`);
                    const reservations = response.data;

                    const events = reservations.map(reservation => ({
                        title: reservation.title || 'Reservado',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.color || 'red', // Rojo para reservados
                    }));

                    successCallback(events);
                } catch (error) {
                    console.error('Error al cargar las reservas:', error);
                    failureCallback(error);
                }
            }
        });

        calendar.render(); // Renderizar el calendario
    });
</script>
