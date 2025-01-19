@extends('layouts.public')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('title', 'Política de Cookies')

@section('content')
<header class="header">
    <!-- Menú igual que en las otras páginas -->
</header>

<div class="container mt-5">
    <h2 class="text-center">Política de Cookies</h2>
    <p class="text-center">Explicamos cómo usamos cookies para mejorar tu experiencia en nuestro sitio web.</p>
    <!-- Contenido adicional aquí -->
</div>

<footer class="footer">
    <!-- Footer igual que en las otras páginas -->
</footer>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endpush
