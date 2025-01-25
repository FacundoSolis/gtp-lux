<link rel="stylesheet" href="{{ asset('css/progress.css') }}">

<div class="card progress-card">
    <div class="card-body">
        <nav aria-label="progress-bar" class="step">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <!-- Paso 1 -->
                    <a class="nav-link {{ $step == 1 ? 'active' : '' }}" tabindex="-1">
                        {{ __('nav_step_1') }}
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 2 -->
                    <a class="nav-link {{ $step == 2 ? 'active' : '' }}" tabindex="-1">
                        {{ __('nav_step_2') }}
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 3 -->
                    <a class="nav-link {{ $step == 3 ? 'active' : '' }}" tabindex="-1">
                        {{ __('nav_step_3') }}
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Paso 4 -->
                    <a class="nav-link {{ $step == 4 ? 'active' : '' }}" tabindex="-1">
                        {{ __('nav_step_4') }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
