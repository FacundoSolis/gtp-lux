@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reserva de Barco</h1>

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

        <!-- Fecha de Recogida y Entrega -->
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

        <!-- Calendario de Disponibilidad -->
        <div id="availability-calendar" style="display: none; min-height: 300px; border: 1px solid #ccc; margin-top: 20px;"></div>

        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('availability-calendar');
        const boatId = @json($boatId);
        const portId = @json($portId ?? 'null');
        const startDate = @json($startDate ?? now()->format('Y-m-d'));
        const endDate = @json($endDate ?? now()->addMonths(1)->format('Y-m-d'));

        let selectedPickupDate = null;
        let selectedReturnDate = null;

        // Configuración del calendario
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
                    const response = await axios.get(`/reservations/calendar/${boatId || ''}/${portId || ''}/${startDate || ''}/${endDate || ''}`);
                    const reservations = response.data;

                    const events = reservations.map(reservation => ({
                        title: reservation.title || reservation.boat_name || 'Disponible',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.color || 'red', // Rojo para reservado
                        price: reservation.price || '', // Mostrar el precio si existe
                    }));

                    successCallback(events);
                } catch (error) {
                    console.error('Error al cargar las reservas:', error);
                    failureCallback(error);
                }
            },
            dateClick: function(info) {
                // Reiniciar si se hace clic en una fecha ya seleccionada
                if (selectedPickupDate === info.dateStr || selectedReturnDate === info.dateStr) {
                    selectedPickupDate = null;
                    selectedReturnDate = null;
                    document.getElementById('pickup_date').value = '';
                    document.getElementById('return_date').value = '';
                    highlightSelectedDates();  // Reiniciar la selección de fechas
                    return;
                }

                // Seleccionar fecha de recogida o entrega
                if (!selectedPickupDate) {
                    selectedPickupDate = info.dateStr;
                    document.getElementById('pickup_date').value = selectedPickupDate;
                } else if (!selectedReturnDate) {
                    selectedReturnDate = info.dateStr;
                    document.getElementById('return_date').value = selectedReturnDate;
                }

                highlightSelectedDates();  // Resaltar las fechas seleccionadas
            },
            eventRender: function(info) {
                // Siempre mostrar eventos reservados en rojo
                info.el.style.backgroundColor = 'red'; // Rojo para reservas existentes
                info.el.style.borderColor = 'red'; // Rojo para reservas existentes
            }
        });

        // Mostrar calendario cuando el usuario haga clic en cualquier campo de fecha
        document.getElementById('pickup_date').addEventListener('click', function() {
            calendarEl.style.display = 'block';
            calendar.render();
        });

        document.getElementById('return_date').addEventListener('click', function() {
            calendarEl.style.display = 'block';
            calendar.render();
        });

        // Cerrar el calendario si el usuario hace clic fuera de él
        document.addEventListener('click', function(event) {
            if (!calendarEl.contains(event.target) && !event.target.matches('#pickup_date, #return_date')) {
                calendarEl.style.display = 'none';
            }
        });

        // Función para resaltar las fechas seleccionadas
        function highlightSelectedDates() {
            // Reiniciar el estilo de todos los eventos
            calendar.getEvents().forEach(function(event) {
                event.setProp('backgroundColor', '');  // Reiniciar color
                event.setProp('borderColor', '');  // Reiniciar borde
            });

            // Resaltar la fecha de recogida en morado
            if (selectedPickupDate) {
                calendar.getEvents().forEach(function(event) {
                    if (event.startStr === selectedPickupDate) {
                        event.setProp('backgroundColor', '#9b59b6'); // Morado para la fecha de recogida
                        event.setProp('borderColor', '#9b59b6');
                    }
                });
            }

            // Resaltar la fecha de entrega en morado
            if (selectedReturnDate) {
                calendar.getEvents().forEach(function(event) {
                    if (event.startStr === selectedReturnDate) {
                        event.setProp('backgroundColor', '#9b59b6'); // Morado para la fecha de entrega
                        event.setProp('borderColor', '#9b59b6');
                    }
                });
            }

            // Resaltar el rango de fechas seleccionadas en morado
            if (selectedPickupDate && selectedReturnDate) {
                let currentDate = new Date(selectedPickupDate);
                let returnDate = new Date(selectedReturnDate);
                while (currentDate <= returnDate) {
                    let currentDateStr = currentDate.toISOString().split('T')[0]; // Convertir a formato Y-m-d
                    calendar.getEvents().forEach(function(event) {
                        if (event.startStr === currentDateStr) {
                            event.setProp('backgroundColor', '#9b59b6'); // Resaltar todos los días seleccionados en morado
                            event.setProp('borderColor', '#9b59b6');
                        }
                    });
                    currentDate.setDate(currentDate.getDate() + 1); // Sumar un día
                }
            }
        }
    });
</script>
@endsection
