@extends('layouts.public')

@section('title', 'Confirm Password')

@section('content')
<div class="card shadow p-4" style="max-width: 400px; margin: auto; background: linear-gradient(120deg, #e0eafc, #cfdef3);">
    <h3 class="text-center mb-4">{{ __('Confirm Password') }}</h3>
    <p class="text-center">{{ __('Please confirm your password before continuing.') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required>
            </div>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">{{ __('Confirm Password') }}</button>
        </div>
    </form>
</div>
@endsection
