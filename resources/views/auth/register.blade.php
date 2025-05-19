<x-guest-layout>
    <style>
    body {
        background: #f4f6fa !important;
    }
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6fa;
    }
    .register-card {
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(60,60,60,0.10);
        max-width: 400px;
        width: 100%;
        text-align: center;
        margin-left: 0;
    }
    .register-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    .register-card label {
        font-weight: 500;
        color: #222;
        text-align: left;
        display: block;
    }
    .register-card input[type="text"],
    .register-card input[type="email"],
    .register-card input[type="password"] {
        width: 100%;
        padding: .75rem 1rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-bottom: 1rem;
        background: #f7fafc;
        font-size: 1rem;
    }
    .register-card .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.2rem;
    }
    .register-card .login-link {
        font-size: .98rem;
        color: #888;
        text-align: left;
        margin-top: 1rem;
    }
    .register-card .login-link a {
        color: #1976d2;
        text-decoration: none;
        font-weight: 500;
    }
    .register-card .login-link a:hover {
        text-decoration: underline;
    }
    .register-card button, .register-card .btn-register {
        width: 100%;
        padding: .85rem;
        border-radius: 8px;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        background: #1976d2;
        color: #fff;
        transition: background 0.2s;
    }
    .register-card button:hover, .register-card .btn-register:hover {
        background: #125ea2;
    }
    .register-illustration {
        display: none;
    }
    @media (min-width: 900px) {
        .register-container {
            flex-direction: row;
        }
        .register-illustration {
            display: block;
            margin-right: 40px;
        }
    }
</style>
<div class="register-container">
    <div class="register-illustration">
        <img src="https://cdn.dribbble.com/users/1787323/screenshots/14072577/media/1f2c8f6f8e4e0c9e9f5b4b4e0e3e1f4c.png" alt="Inscription Illustration" style="width:300px;max-width:100%;">
    </div>
    <div class="register-card">
        <div class="register-title">Créer un compte</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Nom</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <button type="submit" class="btn-register">Créer un compte</button>
        </form>
        <div class="login-link">
            Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </div>
</div>

</x-guest-layout>
