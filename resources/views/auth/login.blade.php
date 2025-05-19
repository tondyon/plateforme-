<x-guest-layout>
    <style>
        body {
            background: #f4f6fa !important;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f6fa;
        }
        .login-card {
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(60,60,60,0.10);
            max-width: 370px;
            width: 100%;
            text-align: center;
        }
        .login-card h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }
        .login-card p {
            color: #888;
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .login-card form {
            text-align: left;
        }
        .login-card label {
            font-weight: 500;
            color: #222;
        }
        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100%;
            padding: .75rem 1rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            margin-bottom: 1rem;
            background: #f7fafc;
            font-size: 1rem;
        }
        .login-card .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }
        .login-card .remember {
            font-size: .97rem;
            color: #555;
        }
        .login-card .forgot {
            font-size: .97rem;
            color: #1976d2;
            text-decoration: none;
        }
        .login-card .forgot:hover {
            text-decoration: underline;
        }
        .login-card button, .login-card .btn-google {
            width: 100%;
            padding: .85rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .login-card button {
            background: #1976d2;
            color: #fff;
            transition: background 0.2s;
        }
        .login-card button:hover {
            background: #125ea2;
        }
        .login-card .btn-google {
            background: #fff;
            color: #222;
            border: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .login-card .btn-google img {
            width: 22px;
        }
        .login-card .signup-link {
            font-size: .98rem;
            color: #888;
        }
        .login-card .signup-link a {
            color: #1976d2;
            text-decoration: none;
            font-weight: 500;
        }
        .login-card .signup-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .login-card { padding: 1.5rem 0.5rem; }
        }
    </style>
    <div class="login-container">
        <div class="login-card">
            <div style="text-align:left;margin-bottom:1rem;">
                <img src="/images/logo.png" alt="Logo" style="height:32px;vertical-align:middle;">
            </div>
            <p style="margin-bottom:0.5rem;">Veuillez entrer vos identifiants</p>
            <h2>Bon retour !</h2>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <div class="actions">
                    <div class="remember">
                        <input id="remember_me" type="checkbox" name="remember" style="vertical-align:middle;margin-right:5px;"> Se souvenir pendant 30 jours
                    </div>
                    @if (Route::has('password.request'))
                        <a class="forgot" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    @endif
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <a href="{{ route('google.login') }}" class="btn-google">
    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Logo Google"> Se connecter avec Google
</a>
            <div class="signup-link">
                Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a>
            </div>
        </div>
    </div>
</x-guest-layout>

