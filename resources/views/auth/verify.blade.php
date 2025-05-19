@extends('layouts.app')

@section('content')
<div class = "auth-container">
<div class = "auth-box">
<h2  class = "neon-title">{{ __('Reset Password') }}</h2>

        <form method = "POST" action = "{{ route('password.update') }}">
            @csrf
            <input type = "hidden" name = "token" value = "{{ $token }}">

            <div   class = "input-group">
            <label for   = "email">{{ __('Email Address') }}</label>
            <input id    = "email" type = "email" class = "@error('email') is-invalid @enderror" name = "email" value = "{{ $email ?? old('email') }}" required autocomplete = "email" autofocus>
                @error('email')
                    <span class = "error-message">
                    <i    class = "fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <div   class = "input-group">
            <label for   = "password">{{ __('Password') }}</label>
            <input id    = "password" type = "password" class = "@error('password') is-invalid @enderror" name = "password" required autocomplete = "new-password">
                @error('password')
                    <span class = "error-message">
                    <i    class = "fas fa-exclamation-circle"></i> {{ $message }}
                    </span>
                @enderror
            </div>

            <div   class = "input-group">
            <label for   = "password-confirm">{{ __('Confirm Password') }}</label>
            <input id    = "password-confirm" type = "password" name = "password_confirmation" required autocomplete = "new-password">
            </div>

            <button type = "submit" class = "btn-main">
                {{ __('Reset Password') }}
                <i class = "fas fa-sync-alt"></i>
            </button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
  /* Styles de base cohérents */
.auth-container {
    display        : flex;
    justify-content: center;
    align-items    : center;
    min-height     : 100vh;
    background     : linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #1a1a2e);
    background-size: 400% 400%;
    animation      : gradientBG 15s ease infinite;
    padding        : 20px;
    position       : relative;
    overflow       : hidden;
}

.auth-container::before {
    content   : "";
    position  : absolute;
    top       : 0;
    left      : 0;
    width     : 100%;
    height    : 100%;
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.15'/%3E%3C/svg%3E");
    opacity   : 0.3;
}

.auth-box {
    background             : rgba(5, 10, 48, 0.7);
    -webkit-backdrop-filter: blur(12px);
    backdrop-filter        : blur(12px);
    border-radius          : 15px;
    padding                : 40px;
    width                  : 100%;
    max-width              : 500px;
    box-shadow             : 0 8px 32px rgba(2, 12, 86, 0.5);
    border                 : 1px solid rgba(100, 149, 237, 0.3);
    animation              : fadeIn 0.8s ease-out;
    position               : relative;
    z-index                : 1;
}

.neon-title {
    color         : #fff;
    text-align    : center;
    font-size     : 2.2rem;
    margin-bottom : 30px;
    text-shadow   : 0 0 8px #4d7cff, 0 0 15px #4d7cff, 0 0 25px #4d7cff;
    animation     : neonGlow 2s infinite alternate;
    letter-spacing: 1px;
    font-weight   : 600;
}

  /* Styles spécifiques au formulaire */
.input-group {
    margin-bottom: 25px;
}

.input-group label {
    display      : block;
    color        : #b3d1ff;
    margin-bottom: 8px;
    font-size    : 1rem;
    font-weight  : 500;
}

.input-group input {
    width        : 100%;
    padding      : 14px 16px;
    background   : rgba(0, 0, 0, 0.2);
    border       : 1px solid rgba(138, 180, 255, 0.3);
    border-radius: 8px;
    color        : #fff;
    font-size    : 1rem;
    transition   : all 0.3s ease;
}

.input-group input:focus {
    outline     : none;
    border-color: #4d7cff;
    box-shadow  : 0 0 0 3px rgba(77, 124, 255, 0.2);
    background  : rgba(0, 0, 0, 0.3);
}

.error-message {
    display    : flex;
    align-items: center;
    color      : #ff6b6b;
    font-size  : 0.85rem;
    margin-top : 8px;
}

.error-message i {
    margin-right: 6px;
}

.btn-main {
    width          : 100%;
    padding        : 14px;
    background     : linear-gradient(135deg, #4d7cff 0%, #2a52d1 100%);
    color          : white;
    border         : none;
    border-radius  : 8px;
    font-size      : 1.05rem;
    font-weight    : 600;
    cursor         : pointer;
    transition     : all 0.3s ease;
    display        : flex;
    align-items    : center;
    justify-content: center;
    gap            : 10px;
    margin-top     : 10px;
}

.btn-main:hover {
    background: linear-gradient(135deg, #5a87ff 0%, #3366ff 100%);
    transform : translateY(-2px);
    box-shadow: 0 5px 15px rgba(77, 124, 255, 0.4);
}

.btn-main i {
    transition: transform 0.3s ease;
}

.btn-main:hover i {
    transform: rotate(180deg);
}

  /* Animations */
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes neonGlow {
    from {
        text-shadow: 0 0 8px #4d7cff, 0 0 15px #4d7cff, 0 0 25px #4d7cff;
    }
    to {
        text-shadow: 0 0 12px #4d7cff, 0 0 25px #4d7cff, 0 0 40px #4d7cff;
    }
}

@keyframes fadeIn {
    from {
        opacity  : 0;
        transform: translateY(15px);
    }
    to {
        opacity  : 1;
        transform: translateY(0);
    }
}

  /* Responsive */
@media (max-width: 576px) {
    .auth-box {
        padding: 30px 20px;
    }

    .neon-title {
        font-size: 1.8rem;
    }

    .input-group input {
        padding: 12px 14px;
    }
}
</style>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
