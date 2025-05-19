<x-guest-layout>
    @push('styles')
    <style>
        :root {
            --accent: #00c853;
            --dark: #1a1a1a;
        }
        body {
            background: url('/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .navbar {
            position       : fixed;
            top            : 0;
            left           : 0;
            right          : 0;
            display        : flex;
            justify-content: space-between;
            align-items    : center;
            padding        : 1.5rem 5%;
            z-index        : 100;
            background     : rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .btn-nav {
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-login:hover {
            background: white;
            color: var(--dark);
            transform: translateY(-3px);
        }

        .btn-register {
            background: var(--accent);
            color: white;
            border: 2px solid var(--accent);
        }

        .btn-register:hover {
            background: transparent;
            color: var(--accent);
            transform: translateY(-3px);
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 5%;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: pulse 15s infinite alternate;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            animation: slideUp 1s ease;
        }

        .neon-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #a5f3fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 0 0 10px rgba(165, 243, 252, 0.3);
            animation: glow 2s infinite alternate;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            opacity: 0;
            animation: fadeIn 1s ease 0.5s forwards;
        }

        .auth-buttons {
            display: flex;
            gap: 1.5rem;
            opacity: 0;
            animation: fadeIn 1s ease 1s forwards;
        }

        .btn-main {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 200, 83, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 200, 83, 0.6);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--dark);
            transform: translateY(-5px);
        }

        @keyframes glow {
            0% { text-shadow: 0 0 10px rgba(165, 243, 252, 0.3); }
            100% { text-shadow: 0 0 20px rgba(165, 243, 252, 0.6), 0 0 30px rgba(165, 243, 252, 0.4); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .nav-links {
                margin: 1rem 0;
                flex-wrap: wrap;
                justify-content: center;
            }

            .neon-title {
                font-size: 2.5rem;
            }

            .auth-buttons {
                flex-direction: column;
            }
        }
    </style>
    @endpush
    <!-- Navigation -->
    <nav   class = "navbar">
    <ul    class = "nav-links">
    <li><a href  = "{{ url('/home') }}">Accueil</a></li>
    <li><a href  = "{{ route('courses.index') }}" class = "text-blue-600 hover:underline">Voir les formations</a>
    </li>
    <li><a href  = "{{ route('about') }}">À propos</a></li>
    <li><a href  = "{{ route('contact.index') }}" class = "text-blue-500 hover:underline">Nous contacter !</a></li>

     </ul>
        <div class="nav-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-nav btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav btn-login">Se connecter</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-nav btn-register">S'inscrire</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" style="position:relative;">
        <img src="/images/background.jpg" alt="Arrière-plan" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:0;opacity:0.45;pointer-events:none;" aria-hidden="true">
        <div class="hero-content" style="position:relative;z-index:1;">
            <h1 class="neon-title">Bienvenue sur notre Plateforme de Formation</h1>
            <p>Apprenez à votre rythme, où que vous soyez. Accédez à des centaines de cours dispensés par des experts.</p>
            <div class="auth-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-main btn-primary">Accéder aux cours</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-main btn-primary">Commencer maintenant</a>
                        <a href="{{ route('login') }}" class="btn-main btn-outline">Déjà membre ?</a>
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <script>
        // Animation de la barre de navigation au défilement
        const navbar = document.querySelector('.navbar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll <= 0) {
                navbar.style.transform = 'translateY(0)';
                return;
            }

            if (currentScroll > lastScroll && !navbar.style.transform) {
                navbar.style.transform = 'translateY(-100%)';
            } else if (currentScroll < lastScroll && navbar.style.transform) {
                navbar.style.transform = 'translateY(0)';
            }

            lastScroll = currentScroll;
        });
    </script>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Plateforme de Formation</h4>
                <p>&copy; 2025 Plateforme de Formation. Tous droits réservés.</p>
            </div>
            <div class="footer-section">
                <h4>Liens rapides</h4>
                <ul>
                    <li><a href="{{ url('/home') }}">Accueil</a></li>
                    <li><a href="{{ route('admin.courses.index') }}">Formations</a></li>
                    <li><a href="{{ route('about') }}">À propos</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Suivez-nous</h4>
                <div class="footer-socials">
                    <a href="#" title="Facebook" aria-label="Facebook"><svg width="24" height="24" fill="white"><use xlink:href="#icon-facebook"/></svg></a>
                    <a href="#" title="Twitter" aria-label="Twitter"><svg width="24" height="24" fill="white"><use xlink:href="#icon-twitter"/></svg></a>
                    <a href="#" title="LinkedIn" aria-label="LinkedIn"><svg width="24" height="24" fill="white"><use xlink:href="#icon-linkedin"/></svg></a>
                </div>
            </div>
        </div>
        <style>
            .main-footer {
                background: rgba(30,30,30,0.95);
                color: #fff;
                padding: 2rem 0 1rem 0;
                margin-top: 2rem;
                font-size: 1rem;
            }
            .footer-content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                align-items: flex-start;
                max-width: 1200px;
                margin: 0 auto;
                gap: 2rem;
            }
            .footer-section {
                flex: 1 1 200px;
                min-width: 180px;
            }
            .footer-section h4 {
                margin-bottom: 0.7rem;
                font-size: 1.15rem;
                color: #00c853;
            }
            .footer-section ul {
                list-style: none;
                padding: 0;
            }
            .footer-section ul li {
                margin-bottom: 0.5rem;
            }
            .footer-section ul li a {
                color: #fff;
                text-decoration: none;
                transition: color 0.2s;
            }
            .footer-section ul li a:hover {
                color: #00c853;
            }
            .footer-socials a {
                display: inline-block;
                margin-right: 1rem;
                color: #fff;
                transition: color 0.2s;
            }
            .footer-socials a:hover {
                color: #00c853;
            }
            @media (max-width: 768px) {
                .footer-content {
                    flex-direction: column;
                    align-items: center;
                    gap: 1.5rem;
                }
                .main-footer {
                    font-size: 0.95rem;
                }
            }
        </style>
        <!-- SVG icons (hidden, used with <use>) -->
        <svg style="display:none;">
            <symbol id="icon-facebook" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.495v-9.294H9.692v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.92.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z"/></symbol>
            <symbol id="icon-twitter" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195a4.916 4.916 0 0 0-8.38 4.482C7.691 8.094 4.066 6.13 1.64 3.161c-.542.929-.856 2.006-.857 3.163 0 2.18 1.111 4.102 2.807 5.229a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.209c9.057 0 14.009-7.496 14.009-13.986 0-.21 0-.423-.016-.634A10.012 10.012 0 0 0 24 4.557z"/></symbol>
            <symbol id="icon-linkedin" viewBox="0 0 24 24"><path d="M22.23 0H1.77C.792 0 0 .771 0 1.723v20.555C0 23.229.792 24 1.77 24h20.46c.978 0 1.77-.771 1.77-1.723V1.723C24 .771 23.208 0 22.23 0zM7.12 20.452H3.56V9.048h3.56v11.404zM5.34 7.691a2.07 2.07 0 1 1 0-4.139 2.07 2.07 0 0 1 0 4.139zm15.112 12.761h-3.56v-5.569c0-1.328-.027-3.037-1.85-3.037-1.853 0-2.135 1.445-2.135 2.939v5.667h-3.56V9.048h3.418v1.561h.049c.476-.899 1.637-1.849 3.37-1.849 3.602 0 4.267 2.369 4.267 5.455v6.237z"/></symbol>
        </svg>
    </footer>
    </footer>
</x-guest-layout>
