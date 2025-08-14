<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poissonnerie 3D - Dieu Donne Davantage @yield('title', 'Bienvenue')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->

    <link rel="shortcut icon" href="{{ asset('images/image1.png') }}" type="image/x-icon">
    <style>
        /* Icone utilisateur */
        .user-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: var(--dark-color);
            margin-left: 15px;
            transition: all 0.3s;
        }

        .user-icon:hover {
            background-color: var(--primary-color);
            color: white;
        }

        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --dark-color: #1a1a1a;
            --light-color: #f8f9fa;
        }

        button,
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        button:hover,
        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        html,
        body {
            height: 100%;
            scroll-behavior: smooth;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-wrapper main {
            flex-grow: 1;
            padding-top: 120px;
            /* Augmenté pour le nouveau header */
        }

        /* Header Styles */
        .site-header {
            position: fixed;
            top: 0;
            width: 100%;
            background: white;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .site-header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            font-weight: bold;
            color: var(--dark-color);
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        /* Navigation principale */
        .main-nav {
            display: flex;
            align-items: center;
        }

        .main-nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .main-nav li {
            margin: 0 15px;
            position: relative;
        }

        .main-nav a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            padding: 5px 0;
            position: relative;
            transition: color 0.3s;
        }

        .main-nav a:hover {
            color: var(--primary-color);
        }

        .main-nav a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s;
        }

        .main-nav a:hover::after {
            width: 100%;
        }

        /* Boutons de connexion */
        .auth-buttons {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        .auth-buttons a {
            margin-left: 10px;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .auth-buttons .login-btn {
            color: var(--dark-color);
            border: 1px solid var(--dark-color);
        }

        .auth-buttons .login-btn:hover {
            background-color: #f0f0f0;
        }

        .auth-buttons .register-btn {
            background-color: var(--primary-color);
            color: white;
        }

        .auth-buttons .register-btn:hover {
            background-color: var(--secondary-color);
        }

        /* Menu mobile */
        .menu-toggle {
            display: none;
            cursor: pointer;
            padding: 10px;
        }

        .menu-toggle span {
            display: block;
            width: 25px;
            height: 2px;
            background-color: var(--dark-color);
            margin: 5px 0;
            transition: all 0.3s;
        }

        /* Navigation Mobile */
        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: white;
            z-index: 1100;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transition: right 0.3s;
            padding: 20px;
            overflow-y: auto;
        }

        .mobile-nav.open {
            right: 0;
        }

        .mobile-nav ul {
            list-style: none;
            padding: 0;
            margin-top: 60px;
        }

        .mobile-nav li {
            margin-bottom: 15px;
        }



        .mobile-nav a {
            color: var(--dark-color);
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .mobile-nav-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .mobile-nav-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .close-mobile-nav {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            height: 70vh;
            min-height: 400px;
            position: relative;
            overflow: hidden;
        }

        .hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            text-align: center;
            z-index: 2;
            color: white;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            transition: all 0.3s;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
        }

        .footer-links a {
            color: #ddd;
            transition: color 0.3s;
            display: block;
            margin-bottom: 8px;
        }

        .footer-links a:hover {
            color: white;
            text-decoration: none;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }


        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .user-icon {
                order: 2;
                /* Place après le logo */
                margin-left: auto;
                /* Pousse vers la droite */
                margin-right: 15px;
                /* Espace avant le menu burger */
            }

            .menu-toggle {
                order: 3;
                /* Place en dernier */
                display: block;
                padding: 10px;
                cursor: pointer;
            }

            .main-nav {
                display: none;
            }

            .auth-buttons {
                display: none;
            }

            .menu-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 50vh;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .product-image {
                height: 150px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                height: 40vh;
                min-height: 300px;
            }

            .hero-content .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .logo img {
                height: 40px;
            }

            .logo {
                font-size: 1.2rem;
            }
        }
    </style>
    <style>
        footer {
            background-color: #0d1b2a;
            /* Bleu foncé élégant */
            color: #ffffff;
            font-size: 14px;
        }

        footer h4,
        footer h5 {
            color: #f8f9fa;
            font-weight: 600;
        }

        footer p,
        footer li,
        footer a {
            color: #d1d1d1;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .footer-links a {
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #ffcc00;
            /* Couleur d'accent */
        }

        /* Icônes réseaux sociaux */
        .social-icon {
            display: inline-block;
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            background-color: #1b263b;
            border-radius: 50%;
            color: #ffffff;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: #ffcc00;
            color: #0d1b2a;
        }

        /* Ligne séparatrice */
        footer hr {
            border: none;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Responsive design */
        @media (max-width: 992px) {
            footer .row {
                text-align: center;
            }

            footer .d-flex {
                flex-direction: column;
                align-items: center;
            }

            .footer-links {
                align-items: center;
            }
        }

        @media (max-width: 576px) {
            footer {
                font-size: 13px;
            }

            .social-icon {
                width: 30px;
                height: 30px;
                line-height: 30px;
                margin-right: 5px;
            }
        }
    </style>

    <style>
        .menu-toggle {
            position: relative;
            width: 30px;
            height: 24px;
            cursor: pointer;
            z-index: 1100;
        }

        .menu-toggle span {
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: var(--dark-color);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .menu-toggle span:nth-child(1) {
            top: 0;
        }

        .menu-toggle span:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        .menu-toggle span:nth-child(3) {
            bottom: 0;
        }

        .menu-toggle.active span:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
        }

        @keyframes bubble {
            0% {
                transform: scale(0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20);
                opacity: 0;
            }
        }

        /* Animation des éléments du menu */
        .mobile-nav ul li {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .mobile-nav.open ul li {
            opacity: 1;
            transform: translateY(0);
        }

        /* Délais d'animation pour chaque élément */
        .mobile-nav.open ul li:nth-child(1) { transition-delay: 0.2s; }
        .mobile-nav.open ul li:nth-child(2) { transition-delay: 0.3s; }
        .mobile-nav.open ul li:nth-child(3) { transition-delay: 0.4s; }
        .mobile-nav.open ul li:nth-child(4) { transition-delay: 0.5s; }
        .mobile-nav.open ul li:nth-child(5) { transition-delay: 0.6s; }
        .mobile-nav.open ul li:nth-child(6) { transition-delay: 0.7s; }
        .mobile-nav.open ul li:nth-child(7) { transition-delay: 0.8s; }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container header-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/image1.png') }}" alt="Logo Poissonnerie 3D">
                Poissonnerie 3D
            </a>
            <!--<a href="{{ route('login') }}" class="user-icon" title="Connexion">
                <i class="fas fa-user"></i>
            </a>-->
            <!-- Navigation principale -->
            <nav class="main-nav">
                <ul>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="#products">Nos Produits</a></li>
                    <li><a href="#services">Nos Services</a></li>
                    <li><a href="#about">À propos</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>

            <!-- Boutons de connexion -->
            <div class="auth-buttons">
                @auth
                    <a href="{{ route('compte.edit') }}" class="login-btn">Mon compte</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="register-btn">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="login-btn">Connexion</a>
                    <a href="{{ route('register') }}" class="register-btn">Inscription</a>
                @endauth
            </div>

            <!-- Bouton menu mobile -->
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <!-- Navigation Mobile -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <nav class="mobile-nav" id="mobileNav">
        <div class="close-mobile-nav" id="closeMobileNav">
            <i class="fas fa-times"></i>
        </div>

        <ul>
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li><a href="#products">Nos Produits</a></li>
            <li><a href="#services">Nos Services</a></li>
            <li><a href="#about">À propos</a></li>
            <li><a href="#contact">Contact</a></li>
            @auth
                <li><a href="{{ route('compte.edit') }}">Mon compte</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-100 btn btn-primary">Se déconnecter</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Connexion</a></li>
                <li><a href="{{ route('register') }}">Inscription</a></li>
            @endauth
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="page-wrapper">
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-5">
            <div class="container">
                <div class="row g-4">
                    <!-- Logo & Infos -->
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/image1.png') }}" alt="Logo" height="50" class="me-2">
                            <h4 class="mb-0">Poissonnerie 3D</h4>
                        </div>
                        <p>Produits frais – Service local – Bénin 🇧🇯</p>
                        <div class="mt-3">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Liens rapides -->
                    <div class="col-lg-4">
                        <h5 class="mb-3">Liens rapides</h5>
                        <div class="footer-links">
                            <a href="{{ url('/') }}">Accueil</a>
                            <a href="#products">Nos produits</a>
                            <a href="#services">Nos services</a>
                            <a href="#contact">Contact</a>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="col-lg-4" id="contact">
                        <h5 class="mb-3">Contact</h5>
                        @php
                            $infos = \App\Models\Information::first();
                        @endphp

                        @if ($infos)
                            <p><i class="fas fa-envelope me-2"></i> {{ $infos->email }}</p>
                            <p><i class="fas fa-phone me-2"></i> {{ $infos->telephone }}</p>
                            <p><i class="fas fa-map-marker-alt me-2"></i> {{ $infos->adresse }}</p>
                        @endif

                        <h5 class="mt-4">Horaires</h5>
                        @php
                            $horaires = \App\Models\Horaire::all();
                        @endphp

                        @if ($horaires->count())
                            <ul class="list-unstyled">
                                @foreach ($horaires as $horaire)
                                    <li>{{ $horaire->jour }} : {{ $horaire->heure_ouverture }} -
                                        {{ $horaire->heure_fermeture }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <hr class="my-4 bg-light">

                <div class="text-center pt-3">
                    &copy; {{ date('Y') }} <strong>Poissonnerie 3D</strong> – Tous droits réservés.
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Initialiser AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Animation du menu mobile
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("menuToggle");
            const mobileNav = document.getElementById("mobileNav");
            const overlay = document.getElementById("mobileNavOverlay");
            const closeBtn = document.getElementById("closeMobileNav");
            const body = document.body;

            // Fonction pour créer des bulles
            function createBubble(x, y) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                bubble.style.left = `${x}px`;
                bubble.style.top = `${y}px`;
                bubble.style.width = '10px';
                bubble.style.height = '10px';
                
                document.body.appendChild(bubble);
                
                // Supprimer la bulle après l'animation
                setTimeout(() => {
                    bubble.remove();
                }, 800);
            }

            // Ouvrir le menu avec animation
            function openMenu() {
                // Animation du bouton burger
                toggle.classList.add('active');
                
                // Créer des bulles au point de clic
                const rect = toggle.getBoundingClientRect();
                const x = rect.left + rect.width/2;
                const y = rect.top + rect.height/2;
                createBubble(x, y);
                
                // Ouvrir le menu après un léger délai
                setTimeout(() => {
                    mobileNav.classList.add("open");
                    overlay.classList.add("open");
                    body.style.overflow = "hidden";
                    
                    // Activer les animations des éléments du menu
                    const menuItems = mobileNav.querySelectorAll('li');
                    menuItems.forEach((item, index) => {
                        item.style.transitionDelay = `${0.1 * (index + 2)}s`;
                    });
                }, 300);
            }

            // Fermer le menu avec animation
            function closeMenu() {
                // Animation du bouton burger
                toggle.classList.remove('active');
                
                // Fermer le menu
                mobileNav.classList.remove("open");
                overlay.classList.remove("open");
                body.style.overflow = "";
                
                // Réinitialiser les animations des éléments
                const menuItems = mobileNav.querySelectorAll('li');
                menuItems.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    item.style.transitionDelay = '0s';
                });
            }

            // Écouteurs d'événements
            if (toggle && mobileNav && overlay && closeBtn) {
                toggle.addEventListener("click", openMenu);
                closeBtn.addEventListener("click", closeMenu);
                overlay.addEventListener("click", closeMenu);
            }

            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.site-header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
