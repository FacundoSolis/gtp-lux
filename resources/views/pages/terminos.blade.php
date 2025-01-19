@extends('layouts.public')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('title', 'Términos del Servicio')

@section('content')
<header class="header">
    <div class="topbar__logo">
        <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <nav class="navbar">
        <!-- Menú igual que en las otras páginas -->
    </nav>
</header>

<div class="container mt-5">
    <h2 class="text-center">Términos del Servicio</h2>
    <p class="text-center">Aquí encontrarás los términos y condiciones para el uso de nuestro sitio web.</p>
    <!-- Contenido adicional aquí -->
</div>

<footer class="footer">
    <!-- Footer igual que en las otras páginas -->
</footer>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endpush
