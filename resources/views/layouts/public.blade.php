<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'GtpLux')</title>
    
    <!-- Metaetiquetas para SEO -->
    <meta name="description" content="@yield('meta_description', 'Descripción predeterminada de GtpLux')">
    <meta name="keywords" content="@yield('meta_keywords', 'barco, alquiler, yate, Denia')">
    <meta name="author" content="GtpLux">

    <!-- CSS Global -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css">
    <!-- Estilos específicos de las vistas -->
    @stack('styles')

    
</head>
<body>
    <!-- Contenedor principal -->
    <main class="content">
        @yield('content')
    </main>
    </div>

    <!-- Scripts globales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 
    <!-- Scripts específicos -->
    @yield('scripts')
    

    <!-- Incluir React solo si es necesario -->
    @vite('resources/js/componentes/app.jsx') <!-- React con Vite -->
</body>
</html>