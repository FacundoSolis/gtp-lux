<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GtpLux')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">


    <!-- Metaetiquetas para SEO -->
    <meta name="description" content="@yield('meta_description', 'Descripción predeterminada de GtpLux')">
    <meta name="keywords" content="@yield('meta_keywords', 'barco, alquiler, yate, Denia')">
    <meta name="author" content="GtpLux">

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>
    @yield('content')

    <!-- Scripts personalizados -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/loadMoreDescription.js') }}"></script>
    <script src="{{ asset('js/loadMoreDescription2.js') }}"></script>
    <script src="{{ asset('js/loadMoreImages.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>

    @stack('scripts')
</body>
</html>
