<!DOCTYPE html>
<html lang = "{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset = "utf-8">
        <meta name    = "viewport" content   = "width=device-width, initial-scale=1">
        <meta name    = "csrf-token" content = "{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

        <!-- Fonts -->
        <link rel  = "preconnect" href                                                         = "https://fonts.bunny.net">
        <link href = "https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel = "stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" />
    </head>
    <body x-data="{ sidebarOpen: false }" class="font-sans antialiased">
        @include('partials.flash')

        <!-- Notifications -->
        @auth
            <div class = "notifications-container">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class   = "notification">
                    <a   href    = "{{ $notification->data['link'] ?? '#' }}"
                         onclick = "markAsRead('{{ $notification->id }}')">
                            {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                        </a>
                    </div>
                @empty
                    <!-- Aucune notification à afficher -->
                @endforelse
            </div>
        @endauth

        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4" role="alert">
                <strong class="font-bold">Succès :</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-4" role="alert">
                <strong class="font-bold">Erreur :</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <script>
            function markAsRead(notificationId) {
                fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
            }
        </script>
        <footer class="bg-gray-800 text-gray-300 py-8 mt-8">
            <div class="container mx-auto text-center">
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="https://www.facebook.com" target="_blank" class="hover:text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="https://twitter.com" target="_blank" class="hover:text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="https://wa.me/1234567890" target="_blank" class="hover:text-white"><i class="fab fa-whatsapp fa-lg"></i></a>
                </div>
                <p>&copy; {{ date('Y') }} Plateforme de Formation. Tous droits réservés.</p>
            </div>
        </footer>
        @stack('scripts')
    </body>
</html>
