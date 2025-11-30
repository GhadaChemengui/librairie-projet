<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #06d6a0;
            --accent: #f59e0b;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            --gradient-accent: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Navbar */
        nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-light);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .logo a {
            font-size: 26px;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .logo a:hover {
            transform: scale(1.05);
        }

        .logo i {
            font-size: 30px;
        }

        .menu {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .menu a, .menu button {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 12px;
            transition: var(--transition);
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .menu a:hover, .menu button:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .menu a.active {
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow-light);
        }

        /* Hero Section */
        .hero {
            padding: 180px 20px 120px;
            text-align: center;
            background: var(--gradient);
            color: white;
            margin-bottom: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 24px;
            line-height: 1.1;
            background: linear-gradient(135deg, #fff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 40px;
            opacity: 0.9;
            line-height: 1.6;
            font-weight: 400;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 32px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: var(--shadow);
        }

        .btn-primary {
            background: white;
            color: var(--primary);
            box-shadow: var(--shadow-light);
        }

        .btn-secondary {
            background: var(--gradient-accent);
            color: white;
            box-shadow: var(--shadow-light);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary);
            border-color: white;
        }

        /* Features Section */
        .features {
            max-width: 1200px;
            margin: 0 auto 120px;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 60px;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background: white;
            border-radius: var(--border-radius-lg);
            padding: 40px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
            font-size: 32px;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--gray);
            line-height: 1.6;
            font-size: 16px;
        }

        /* Image Gallery Scroll Section */
        .gallery-scroll {
            margin: 80px 0;
            overflow: hidden;
            padding: 60px 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(6, 214, 160, 0.05) 100%);
        }

        .scroll-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            padding: 20px 0;
        }

        .scroll-container::before,
        .scroll-container::after {
            content: '';
            position: absolute;
            top: 0;
            width: 100px;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .scroll-container::before {
            left: 0;
            background: linear-gradient(90deg, rgba(248, 250, 252, 1) 0%, transparent 100%);
        }

        .scroll-container::after {
            right: 0;
            background: linear-gradient(270deg, rgba(248, 250, 252, 1) 0%, transparent 100%);
        }

        .scroll-track {
            display: flex;
            gap: 30px;
            animation: scroll 30s linear infinite;
            width: max-content;
        }

        .scroll-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .book-item {
            width: 280px;
            height: 400px;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            position: relative;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            cursor: pointer;
        }

        .book-item:hover {
            transform: scale(1.05) translateY(-10px);
            box-shadow: var(--shadow);
        }

        .book-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .book-item:hover img {
            transform: scale(1.1);
        }

        .book-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
            padding: 30px 20px 20px;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .book-item:hover .book-overlay {
            transform: translateY(0);
        }

        .book-overlay h4 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
        }

        /* Stats Section */
        .stats {
            background: var(--dark);
            color: white;
            padding: 80px 20px;
            margin-bottom: 80px;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }

        .stat-card {
            text-align: center;
            padding: 30px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--gray-light);
            font-size: 18px;
            font-weight: 500;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 60px 20px 30px;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .footer-description {
            color: var(--gray-light);
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links h4 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: white;
        }

        .footer-links a {
            color: var(--gray-light);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .copyright {
            text-align: center;
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--gray-light);
        }

        /* Floating Elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .menu {
                gap: 12px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero {
                padding: 140px 20px 80px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            .btn {
                padding: 14px 28px;
                font-size: 14px;
            }

            .book-item {
                width: 240px;
                height: 340px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="glass">
        <div class="logo">
            <a href="{{ url('/') }}">
                <i class="fas fa-book-open floating"></i>
                {{ config('app.name') }}
            </a>
        </div>
        <div class="menu">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.books.index') }}" class="active">
                        <i class="fas fa-cog"></i> Administration
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-link">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('books.index') }}" class="active">
                        <i class="fas fa-book"></i> Bibliothèque
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-link">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Inscription</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Révolutionnez Votre Expérience Littéraire</h1>
            <p>Plongez dans un univers où la technologie rencontre la passion des livres. Une plateforme moderne, intuitive et puissante pour les lecteurs du 21ème siècle.</p>
            <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                @auth
                    <a href="{{ route('books.index') }}" class="btn btn-primary">
                        <i class="fas fa-rocket"></i> Explorer la Bibliothèque
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-secondary">
                        <i class="fas fa-sparkles"></i> Démarrer l'Aventure
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-key"></i> Accéder à mon Espace
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Une Expérience Unique</h2>
        <div class="features-grid">
            <div class="feature-card floating">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3>Intelligence Artificielle</h3>
                <p>Recommandations personnalisées grâce à notre algorithme d'IA avancé qui comprend vos préférences de lecture.</p>
            </div>
            <div class="feature-card floating" style="animation-delay: 2s;">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Performance Ultime</h3>
                <p>Interface ultra-rapide avec chargement instantané, conçue pour une expérience utilisateur fluide et réactive.</p>
            </div>
            <div class="feature-card floating" style="animation-delay: 4s;">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Sécurité Avancée</h3>
                <p>Protection des données avec chiffrement de bout en bout et authentification multi-facteurs pour votre tranquillité d'esprit.</p>
            </div>
        </div>
    </section>

    <!-- Image Gallery Scroll Section -->
    <section class="gallery-scroll">
        <h2 class="section-title">Découvrez Notre Collection</h2>
        <div class="scroll-container">
            <div class="scroll-track">
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400" alt="Livre 1">
                    <div class="book-overlay">
                        <h4>Romans Classiques</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400" alt="Livre 2">
                    <div class="book-overlay">
                        <h4>Science-Fiction</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400" alt="Livre 3">
                    <div class="book-overlay">
                        <h4>Littérature Moderne</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=400" alt="Livre 4">
                    <div class="book-overlay">
                        <h4>Romans Policiers</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400" alt="Livre 5">
                    <div class="book-overlay">
                        <h4>Philosophie</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400" alt="Livre 6">
                    <div class="book-overlay">
                        <h4>Biographies</h4>
                    </div>
                </div>
                <!-- Duplicate for seamless loop -->
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400" alt="Livre 1">
                    <div class="book-overlay">
                        <h4>Romans Classiques</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400" alt="Livre 2">
                    <div class="book-overlay">
                        <h4>Science-Fiction</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400" alt="Livre 3">
                    <div class="book-overlay">
                        <h4>Littérature Moderne</h4>
                    </div>
                </div>
                <div class="book-item">
                    <img src="https://images.unsplash.com/photo-1519682337058-a94d519337bc?w=400" alt="Livre 4">
                    <div class="book-overlay">
                        <h4>Romans Policiers</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Livres Disponibles</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">95%</div>
                <div class="stat-label">Satisfaction Utilisateurs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Disponible</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">99.9%</div>
                <div class="stat-label">Uptime Garanti</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div>
                <div class="footer-logo">
                    <i class="fas fa-book-open"></i>
                    {{ config('app.name') }}
                </div>
                <p class="footer-description">
                    Plateforme innovante dédiée aux passionnés de lecture. 
                    Nous repoussons les limites de l'expérience littéraire numérique.
                </p>
            </div>
            <div class="footer-links">
                <h4>Navigation</h4>
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Accueil</a>
                <a href="{{ route('books.index') }}"><i class="fas fa-book"></i> Bibliothèque</a>
                <a href="#"><i class="fas fa-star"></i> Collections</a>
                <a href="#"><i class="fas fa-trending-up"></i> Tendances</a>
            </div>
            <div class="footer-links">
                <h4>Support</h4>
                <a href="#"><i class="fas fa-question-circle"></i> Centre d'Aide</a>
                <a href="#"><i class="fas fa-envelope"></i> Contact</a>
                <a href="#"><i class="fas fa-shield-alt"></i> Confidentialité</a>
                <a href="#"><i class="fas fa-gavel"></i> Conditions</a>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} {{ config('app.name') }} - Innovation & Excellence
        </div>
    </footer>

    <script>
        // Animations avancées
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des cartes au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observer les cartes de features
            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Effet de particules sur le hero
            const hero = document.querySelector('.hero');
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = Math.random() * 4 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = 'rgba(255, 255, 255, 0.3)';
                particle.style.borderRadius = '50%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animation = `float ${Math.random() * 6 + 4}s ease-in-out infinite`;
                particle.style.animationDelay = Math.random() * 5 + 's';
                hero.appendChild(particle);
            }

            // Effet de typing sur le titre
            const title = document.querySelector('.hero h1');
            const text = title.textContent;
            title.textContent = '';
            let i = 0;
            
            function typeWriter() {
                if (i < text.length) {
                    title.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            }
            
            setTimeout(typeWriter, 1000);
        });

        // Effet de parallaxe
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        });
    </script>

</body>
</html>