<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'GtpLux')</title>

    <!-- CSS y JS de Vite -->
    @vite([
    'resources/css/available-boats.css',
    'resources/css/confirmation.css',
    'resources/css/menu.css',
    'resources/css/menuhome.css',
    'resources/css/normalize.css',
    'resources/css/opiniones.css',
    'resources/css/payment.css',
    'resources/css/portofino.css',
    'resources/css/princess.css',
    'resources/css/public.css',
    'resources/css/style.css',
])

    <!-- CSS de Bootstrap y otros frameworks externos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/daygrid/main.min.css" rel="stylesheet">
    
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-wrapper">
        <div class="admin-sidebar">
            <h3>Panel de Administración</h3>
            <ul>
                <li><a href="{{ route('admin.reservations.index') }}">Listado de Reservas</a></li>
                <li><a href="{{ route('admin.payments.index') }}">Pagos</a></li>
                <!-- Agrega más secciones según sea necesario -->
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="admin-content" style="margin-left: 250px;">
            @yield('content') <!-- Aquí se carga el contenido dinámico -->
        </div>
    </div>

    @vite (['resources/js/listapreciosportofino.js',
    'resources/js/listapreciosprincess.js',
    'resources/js/loadMoreDescription.js',
    'resources/js/loadMoreDescription2.js',
    'resources/js/loadMoreImages.js',
    'resources/js/loadMoreImages2.js',
    'resources/js/menu.js',
    'resources/js/menuhome.js',
    'resources/js/opiniones.js',
    'resources/js/slider.js',
    'resources/js/syncddate.js',
    'resources/js/componentes/app.jsx',])

    <!-- Scripts de Bootstrap y externos -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
