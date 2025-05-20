<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institut des Savoirs Numériques</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    <!-- Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="/images/logo.jpeg" alt="Logo" class="h-8 w-8 object-cover">
                <span class="text-2xl font-bold text-blue-700">COURSE<span class="text-black">VIA</span></span>
            </div>
            <nav class="space-x-6 text-sm font-medium flex-1 flex justify-center">
                <a href="#" class="text-gray-700 hover:text-blue-700 transition">Page d'accueil</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition">Mon apprentissage</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition">Diplômes en ligne</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition">Carrières</a>
            </nav>
            <a href="#" class="flex items-center gap-2 bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a9 9 0 0 1 13 0"/></svg>
                <span>Se connecter</span>
            </a>
        </div>
    </header>

    <!-- Section Recommandations personnalisées -->
    <section class="bg-blue-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-blue-800 mb-3">Parce que vous voulez progresser dans votre rôle de Chef de projet informatique</h2>
            <div class="flex flex-wrap gap-6">
                <div class="bg-white rounded-xl shadow p-6 flex-1 min-w-[260px]">
                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs mb-2">Meilleure recommandation</span>
                    <h3 class="font-semibold text-lg mb-1">Introduction à la gestion de projet</h3>
                    <p class="text-sm text-gray-600 mb-1">Fondements de la gestion de projet, lancement et planification</p>
                    <span class="block text-xs text-gray-400 mb-1">Cours 1 sur 11</span>
                    <a href="#" class="text-blue-700 hover:underline text-sm">Voir le parcours</a>
                </div>
                <div class="bg-white rounded-xl shadow p-6 flex-1 min-w-[260px]">
                    <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs mb-2">Nouvelles compétences IA</span>
                    <h3 class="font-semibold text-lg mb-1">IA générative : Introduction et applications</h3>
                    <p class="text-sm text-gray-600 mb-1">IA générative : principes de base, prompts et gestion de projet</p>
                    <span class="block text-xs text-gray-400 mb-1">Cours 1 sur 3</span>
                    <a href="#" class="text-blue-700 hover:underline text-sm">Voir le parcours</a>
                </div>
                <div class="bg-white rounded-xl shadow p-6 flex-1 min-w-[260px]">
                    <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs mb-2">Populaire</span>
                    <h3 class="font-semibold text-lg mb-1">Introduction au développement back-end</h3>
                    <p class="text-sm text-gray-600 mb-1">Bases du développement d’API et programmation serveur</p>
                    <span class="block text-xs text-gray-400 mb-1">Cours 1 sur 7</span>
                    <a href="#" class="text-blue-700 hover:underline text-sm">Voir le parcours</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Produits récemment consultés -->
    <section class = "py-12">
    <div     class = "container mx-auto px-4">
    <h2      class = "text-xl font-bold text-blue-800 mb-6">Produits récemment consultés</h2>
    <div     class = "grid md:grid-cols-4 gap-6">
    <div     class = "bg-white p-4 shadow rounded-lg flex flex-col items-start">
    <span    class = "text-xs text-gray-400 mb-1">Meta</span>
    <span    class = "font-bold">Cadre Web Django</span>
    <span    class = "text-xs text-blue-700 mt-1">Cours</span>
                </div>
                <div class="bg-white p-4 shadow rounded-lg flex flex-col items-start">
                    <span class="text-xs text-gray-400 mb-1">Meta</span>
                    <span class="font-bold">Développeur Meta Back-End</span>
                    <span class="text-xs text-blue-700 mt-1">Préparer un diplôme</span>
                    <span class="text-xs text-gray-500">Certificat Professionnel</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Certificats les plus populaires -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-xl font-bold text-blue-800 mb-6">Certificats les plus populaires</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white p-4 shadow rounded-lg flex flex-col items-start">
                    <span class="text-xs text-gray-400 mb-1">DeepLearning.AI</span>
                    <span class="font-bold">Apprentissage automatique</span>
                    <span class="text-xs text-blue-700 mt-1">Préparer un diplôme</span>
                    <span class="text-xs text-gray-500">Spécialisation</span>
                </div>
                <div class="bg-white p-4 shadow rounded-lg flex flex-col items-start">
                    <span class="text-xs text-gray-400 mb-1">Google</span>
                    <span class="font-bold">Google Digital Marketing & E-commerce</span>
                    <span class="text-xs text-blue-700 mt-1">Préparer un diplôme</span>
                    <span class="text-xs text-gray-500">Certificat Professionnel</span>
                </div>
                <div class="bg-white p-4 shadow rounded-lg flex flex-col items-start">
                    <span class="text-xs text-gray-400 mb-1">Google</span>
                    <span class="font-bold">Google IT Support</span>
                    <span class="text-xs text-blue-700 mt-1">Préparer un diplôme</span>
                    <span class="text-xs text-gray-500">Certificat Professionnel</span>
                </div>
                <div class="bg-white p-4 shadow rounded-lg flex flex-col items-start">
                    <span class="text-xs text-gray-400 mb-1">Google</span>
                    <span class="font-bold">Google Cybersécurité</span>
                    <span class="text-xs text-blue-700 mt-1">Préparer un diplôme</span>
                    <span class="text-xs text-gray-500">Certificat Professionnel</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer riche -->
    <footer class="bg-white border-t py-8 mt-12">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-8 text-sm text-gray-700">
            <div>
                <div class="font-bold text-blue-700 mb-2">COURSEVIA</div>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">À propos</a></li>
                    <li><a href="#" class="hover:underline">Ce que nous proposons</a></li>
                    <li><a href="#" class="hover:underline">Direction</a></li>
                    <li><a href="#" class="hover:underline">Carrières</a></li>
                    <li><a href="#" class="hover:underline">Catalogue</a></li>
                    <li><a href="#" class="hover:underline">Coursera Plus</a></li>
                    <li><a href="#" class="hover:underline">Certificats Professionnels</a></li>
                    <li><a href="#" class="hover:underline">Certificats MasterTrack®</a></li>
                    <li><a href="#" class="hover:underline">Diplômes</a></li>
                </ul>
            </div>
            <div>
                <div class="font-bold text-blue-700 mb-2">Pour le campus</div>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Pour l'entreprise</a></li>
                    <li><a href="#" class="hover:underline">Pour les gouvernements</a></li>
                    <li><a href="#" class="hover:underline">Pour le campus</a></li>
                    <li><a href="#" class="hover:underline">Devenir un partenaire</a></li>
                    <li><a href="#" class="hover:underline">Impact social</a></li>
                </ul>
            </div>
            <div>
                <div class="font-bold text-blue-700 mb-2">Communauté</div>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Étudiants</a></li>
                    <li><a href="#" class="hover:underline">Partenaires</a></li>
                    <li><a href="#" class="hover:underline">Testeurs bêta</a></li>
                    <li><a href="#" class="hover:underline">Blog</a></li>
                    <li><a href="#" class="hover:underline">Le podcast Coursevia</a></li>
                    <li><a href="#" class="hover:underline">Blog Tech</a></li>
                    <li><a href="#" class="hover:underline">Centre d'enseignement</a></li>
                </ul>
            </div>
            <div>
                <div class="font-bold text-blue-700 mb-2">Plus</div>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:underline">Presse</a></li>
                    <li><a href="#" class="hover:underline">Investisseurs</a></li>
                    <li><a href="#" class="hover:underline">Conditions</a></li>
                    <li><a href="#" class="hover:underline">Confidentialité</a></li>
                    <li><a href="#" class="hover:underline">Aide</a></li>
                    <li><a href="#" class="hover:underline">Accessibilité</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-8 flex flex-col md:flex-row items-center justify-between text-xs text-gray-500">
            <div class="flex items-center gap-3 mb-2 md:mb-0">
                <img src="/images/logo.jpeg" alt="Logo" class="h-6 w-6 object-cover">
                <span> 2025 Coursevia. Tous droits réservés.</span>
            </div>
            <div class="flex gap-4">
                <a href="#" title="Facebook" class="hover:text-blue-700"><svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.326 24h11.495v-9.294H9.692v-3.622h3.129V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.92.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z"/></svg></a>
                <a href="#" title="LinkedIn" class="hover:text-blue-700"><svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M22.23 0H1.77C.792 0 0 .771 0 1.723v20.555C0 23.229.792 24 1.77 24h20.46c.978 0 1.77-.771 1.77-1.723V1.723C24 .771 23.208 0 22.23 0zM7.12 20.452H3.56V9.048h3.56v11.404zM5.34 7.691a2.07 2.07 0 1 1 0-4.139 2.07 2.07 0 0 1 0 4.139zm15.112 12.761h-3.56v-5.569c0-1.328-.027-3.037-1.85-3.037-1.853 0-2.135 1.445-2.135 2.939v5.667h-3.56V9.048h3.418v1.561h.049c.476-.899 1.637-1.849 3.37-1.849 3.602 0 4.267 2.369 4.267 5.455v6.237z"/></svg></a>
                <a href="#" title="Twitter" class="hover:text-blue-700"><svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195a4.916 4.916 0 0 0-8.38 4.482C7.691 8.094 4.066 6.13 1.64 3.161c-.542.929-.856 2.006-.857 3.163 0 2.18 1.111 4.102 2.807 5.229a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.209c9.057 0 14.009-7.496 14.009-13.986 0-.21 0-.423-.016-.634A10.012 10.012 0 0 0 24 4.557z"/></svg></a>
            </div>
        </div>
    </footer>


    <!-- Hero Section -->
    <section class="bg-indigo-50 py-20 text-center">
        <div class="container mx-auto px-4 animate-fadeInUp">
            <h2 class="text-3xl md:text-4xl font-bold text-indigo-700 mb-4">Excellence et savoirs numériques à portée de main</h2>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                Institut des Savoirs Numériques est une plateforme de formation en ligne dédiée à l’apprentissage sérieux et approfondi des compétences numériques et informatiques.
            </p>
            <p class="text-md text-gray-600 max-w-2xl mx-auto mt-4">
                Nous proposons des parcours adaptés aux étudiants, professionnels et adultes souhaitant développer leurs connaissances en informatique, programmation, cybersécurité, data science, et bien plus encore.
            </p>
            <p class="text-md text-gray-600 max-w-2xl mx-auto mt-4">
                Grâce à nos formateurs experts et à nos ressources pédagogiques de qualité, vous accédez à une formation flexible, pratique et reconnue pour réussir dans le monde digital.
            </p>
            <div class="mt-8">
                <a href="#" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition transform hover:scale-105 shadow-lg">Commencer maintenant</a>
            </div>
        </div>
    </section>

    <!-- Appel à l'action -->
    <section class="text-center py-12 animate-fadeInUp">
        <h3 class="text-2xl font-bold mb-4">Transformez votre avenir grâce à l’apprentissage en ligne</h3>
        <p class="text-gray-700 mb-6 max-w-xl mx-auto">
            Découvrez des centaines de cours, certifications et diplômes conçus avec des universités et entreprises partenaires. Progressez à votre rythme, développez de nouvelles compétences, et accédez à de nouvelles opportunités professionnelles.
        </p>
        <a href="#" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 transition transform hover:scale-105 shadow-lg">Explorer les cours</a>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t py-6 mt-12">
        <div class="container mx-auto px-4 text-sm flex flex-col md:flex-row justify-between text-gray-600">
            <div class="mb-4 md:mb-0">
                <p>© 2025 PLATFORM DE FORMATION. Tous droits réservés.</p>
            </div>
            <div class="space-x-4">
                <a href="#" class="hover:underline">A propos</a>
                <a href="#" class="hover:underline">Contact</a>
                <a href="#" class="hover:underline">Conditions</a>
                <a href="#" class="hover:underline">Confidentialité</a>
            </div>
        </div>
    </footer>
</body>
</html>
