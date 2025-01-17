<nav aria-label="progress-bar" class="step">
    <ul class="nav nav-pills justify-content-center">
        <li class="nav-item">
            <a class="nav-link {{ $step == 1 ? 'active' : 'disabled' }}" href="#">1. Selecciona las fechas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $step == 2 ? 'active' : ($step > 2 ? '' : 'disabled') }}" href="#">2. Datos personales</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $step == 3 ? 'active' : ($step > 3 ? '' : 'disabled') }}" href="#">3. Ir al Pago</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $step == 4 ? 'active' : 'disabled' }}" href="#">4. Confirmación</a>
        </li>
    </ul>
</nav>
