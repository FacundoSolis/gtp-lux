<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'Panel de Administración')</title>
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Estilos personalizados -->
    @vite('resources/css/admin.css')

</head>
<body style="background: linear-gradient(120deg, #e0eafc, #cfdef3); min-height: 100vh;">

    <!-- Header -->
    <div class="admin-header d-flex justify-content-between align-items-center p-3" style="background-color: #2D353F; color: white;">
        <h3>Panel de Administración</h3>
        <div>
            @auth
                <span>Bienvenido, {{ auth()->user()->name }}</span>
                <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                    class="btn btn-sm btn-danger">Cerrar Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>
    </div>

    <!-- Wrapper -->
    <div class="admin-wrapper d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar" style="background: linear-gradient(180deg, #2D353F, #1c1e22); color: white; min-height: 100vh;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Admin Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reservations.index') }}" class="nav-link {{ request()->routeIs('admin.reservations.index') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check me-2"></i> Reservas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">
                        <i class="fas fa-credit-card me-2"></i> Pagos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('boats.index') }}" class="nav-link {{ request()->routeIs('boats.index') ? 'active' : '' }}">
                        <i class="fas fa-ship me-2"></i> Gestionar Barcos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ports.index') }}" class="nav-link {{ request()->routeIs('ports.index') ? 'active' : '' }}">
                        <i class="fas fa-anchor me-2"></i> Gestionar Puertos
                    </a>
                </li>
                    </ul>
                </div>
        <!-- Contenido Principal -->
        <div class="admin-content flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
