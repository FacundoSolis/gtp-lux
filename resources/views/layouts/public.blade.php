<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GtpLux')</title>
    
    <!-- Metaetiquetas para SEO -->
    <meta name="description" content="@yield('meta_description', 'Descripción predeterminada de GtpLux')">
    <meta name="keywords" content="@yield('meta_keywords', 'barco, alquiler, yate, Denia')">
    <meta name="author" content="GtpLux">

    <!-- CSS Global -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <!-- jQuery UI -->

    <!-- Estilos específicos -->
    @stack('styles') <!-- Importante para incluir los estilos de las vistas -->
</head>
<body>
    <div class="page-container">
        <header>
            <!-- Puedes incluir un header aquí si es necesario -->
        </header>
        
        <!-- Contenedor principal -->
        <main class="content">
            @yield('content')
        </main>

        <!-- Footer siempre al final -->
        <footer class="footer">
            <!-- Contenido del footer -->
            <p>&copy; 2024 GtpLux. Todos los derechos reservados.</p>
        </footer>
    </div>

    <!-- Scripts globales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Scripts específicos -->
    @yield('scripts')

    <!-- Incluir React solo si es necesario -->
    @vite('resources/js/componentes/app.jsx')
</body>
</html>
