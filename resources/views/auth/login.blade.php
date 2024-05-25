@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-wrapper">
        <div class="form-header">{{ __('Вход') }}</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('Адрес электронной почты') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Пароль') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Запомнить меня') }}
                </label>
            </div>

            <div class="form-group form-actions">
                <button type="submit" class="btn btn-primary">
                    {{ __('Войти') }}
                </button>
                <!-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
                @endif -->
            </div>
        </form>
    </div>
</div>

<style>

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .form-wrapper {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .form-header {
        font-size: 2rem;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #555;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        color: #e3342f;
    }

    .form-check {
        display: flex;
        align-items: center;
    }

    .form-check-input {
        margin-right: 0.5rem;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary {
        background: #198754;
        color: white;
    }

    .btn-primary:hover {
        background: #053921;
    }

    .btn-link {
        background: none;
        color: #007bff;
        text-decoration: none;
        padding: 0;
    }

    .btn-link:hover {
        text-decoration: underline;
    }
</style>
@endsection