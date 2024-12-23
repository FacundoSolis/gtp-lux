@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    
    <!-- Resumen principal -->
    <div class="row">
        <!-- Tarjeta de Reservas -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Reservas</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalReservations ?? 0 }}</h5>
                    <p class="card-text">Reservas activas en el sistema.</p>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-light btn-sm">Ver Reservas</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pagos -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Pagos</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($totalPayments ?? 0, 2) }}</h5>
                    <p class="card-text">Pagos procesados este mes.</p>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-light btn-sm">Ver Pagos</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Usuarios -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers ?? 0 }}</h5>
                    <p class="card-text">Usuarios registrados.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">Gestionar Usuarios</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tarjeta de Barcos -->
    <div class="row">
        <!-- Tarjeta de Barcos -->
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Barcos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalBoats ?? 0 }}</h5>
                    <p class="card-text">Barcos registrados en el sistema.</p>
                    <a href="{{ route('boats.index') }}" class="btn btn-light btn-sm">Gestionar Barcos</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Puertos -->
        <div class="col-md-6">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">Puertos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPorts ?? 0 }}</h5>
                    <p class="card-text">Puertos registrados en el sistema.</p>
                    <a href="{{ route('ports.index') }}" class="btn btn-light btn-sm">Gestionar Puertos</a>
                </div>
            </div>
        </div>

    <!-- Accesos rápidos y notificaciones -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Accesos Rápidos</div>
                <div class="card-body">
                    <a href="{{ route('admin.reservations.create') }}" class="btn btn-primary btn-sm">Nueva Reserva</a>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary btn-sm">Procesar Pago</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Notificaciones</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">5 reservas pendientes de confirmación.</li>
                        <li class="list-group-item">2 pagos retrasados.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Estadísticas Mensuales</div>
                <div class="card-body">
                    <canvas id="monthlyStatsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyStatsChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril'], // Cambia según datos reales
            datasets: [{
                label: 'Reservas',
                data: [12, 19, 3, 5], // Datos reales
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }, {
                label: 'Pagos',
                data: [5, 15, 10, 7],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Permite personalizar el tamaño
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

</script>
@endsection