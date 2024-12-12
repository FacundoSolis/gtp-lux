<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Estilos específicos del panel -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-wrapper">
        <div class="admin-sidebar">
            <h3>Panel de Administración</h3>
            <ul>
                <li><a href="{{ route('admin.reservations.index') }}">Listado de Reservas</a></li>
                <li><a href="{{ route('admin.payments.index') }}">Pagos</a></li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="admin-content" style="margin-left: 250px;">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') <!-- Para scripts adicionales -->
</body>
</html>
