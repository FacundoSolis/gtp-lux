@extends('layouts.public')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px; background: linear-gradient(120deg, #e0eafc, #cfdef3);">
        <div class="card-body">
            <h3 class="text-center mb-4">{{ __('Two-Factor Authentication') }}</h3>
            <form method="POST" action="{{ route('2fa.verify') }}">
                @csrf

                <div class="mb-3">
                    <label for="token" class="form-label">{{ __('Enter the token sent to your email') }}</label>
                    <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" 
                        name="token" required autofocus>
                    @error('token')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('Verify Token') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
