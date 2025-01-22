<link rel="stylesheet" href="{{ asset('css/progress.css') }}">

<div class="card progress-card">
    <div class="card-body">
        <nav aria-label="progress-bar" class="step">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <!-- Paso 1 -->
                    <a class="nav-link {{ $step == 1 ? 'active' : '' }}" tabindex="-1">
                        1. Selecciona las fechas
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 2 -->
                    <a class="nav-link {{ $step == 2 ? 'active' : '' }}" tabindex="-1">
                        2. Datos personales
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 3 -->
                    <a class="nav-link {{ $step == 3 ? 'active' : '' }}" tabindex="-1">
                        3. Ir al Pago
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 4 -->
                    <a class="nav-link {{ $step == 4 ? 'active' : '' }}" tabindex="-1">
                        4. Confirmación
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
