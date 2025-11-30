<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #f1f5f9;
            --border-radius: 16px;
            --border-radius-lg: 24px;
            --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 15% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: backgroundShift 8s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.05) rotate(0.5deg); }
        }

        /* Sidebar moderne */
        .sidebar {
            width: 300px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            color: white;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            transition: var(--transition);
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-hover);
        }

        .sidebar-header {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-logo {
            width: 48px;
            height: 48px;
            background: var(--gradient);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            box-shadow: var(--shadow);
        }

        .sidebar-header h2 {
            font-weight: 700;
            font-size: 22px;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-menu {
            padding: 24px 0;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 24px 16px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 16px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            margin: 4px 16px;
            border-radius: var(--border-radius);
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary);
            transform: scaleY(0);
            transition: var(--transition);
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(8px);
        }

        .menu-item:hover::before, .menu-item.active::before {
            transform: scaleY(1);
        }

        .menu-item i {
            margin-right: 16px;
            font-size: 18px;
            width: 24px;
            text-align: center;
            transition: var(--transition);
        }

        .menu-item:hover i, .menu-item.active i {
            transform: scale(1.1);
        }

        .logout-btn {
            width: calc(100% - 32px);
            margin: 16px;
            text-align: left;
            background: rgba(239, 68, 68, 0.1);
            border: none;
            color: rgba(255, 255, 255, 0.8);
            padding: 16px 24px;
            cursor: pointer;
            transition: var(--transition);
            border-radius: var(--border-radius);
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: white;
            transform: translateX(8px);
        }

        .logout-btn i {
            margin-right: 16px;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 300px;
            padding: 40px;
            position: relative;
            z-index: 1;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: 32px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--gray);
            font-size: 18px;
            font-weight: 500;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(255, 255, 255, 0.8);
            padding: 16px 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .user-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .user-avatar:hover {
            transform: scale(1.05) rotate(5deg);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 32px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: 32px;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 28px;
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-value {
            font-size: 42px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-label {
            color: var(--gray);
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .trend-up { color: var(--secondary); }
        .trend-down { color: #ef4444; }

        /* Quick Actions */
        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: 32px;
            text-align: center;
            transition: var(--transition);
            text-decoration: none;
            color: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: var(--transition);
        }

        .action-card:hover::before {
            left: 100%;
        }

        .action-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: var(--shadow-hover);
            color: var(--primary);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            background: var(--gradient);
            color: white;
            font-size: 24px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .action-card:hover .action-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .action-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .action-card small {
            color: var(--gray);
            font-size: 14px;
        }

        /* Recent Activity */
        .activity-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: 32px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            transition: var(--transition);
        }

        .activity-item:hover {
            transform: translateX(8px);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 18px;
            background: var(--gradient);
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }

        .activity-details h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--dark);
        }

        .activity-details p {
            font-size: 14px;
            color: var(--gray);
        }

        .activity-time {
            margin-left: auto;
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
            background: var(--gray-light);
            padding: 6px 12px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar {
                width: 260px;
            }
            .main-content {
                margin-left: 260px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            .stats-grid, .actions-grid {
                grid-template-columns: 1fr;
            }
            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }

        /* Scrollbar personnalisée */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 3px;
        }

        /* Animations d'entrée */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-book-open"></i>
            </div>
            <h2>Admin Pro</h2>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-title">Navigation</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                <i class="fas fa-home"></i>
                <span>Tableau de bord</span>
            </a>
            
            <div class="menu-title">Gestion des livres</div>
            <a href="/admin/books/create" class="menu-item">
                <i class="fas fa-plus-circle"></i>
                <span>Ajouter un livre</span>
            </a>
            <a href="/admin/books" class="menu-item">
                <i class="fas fa-edit"></i>
                <span>Gérer les livres</span>
            </a>
            
            <div class="menu-title">Compte</div>
            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i class="fas fa-user-edit"></i>
                <span>Modifier le profil</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div>
                    <h1>Bonjour, Administrateur 👋</h1>
                    <p>Voici un aperçu de votre activité aujourd'hui</p>
                </div>
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight: 700; font-size: 16px;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 14px; color: var(--gray); display: flex; align-items: center; gap: 4px;">
                            <i class="fas fa-shield-alt" style="color: var(--secondary);"></i>
                            {{ auth()->user()->role }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card animate-fade-in-up">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-value">{{ \App\Models\Book::count() }}</div>
                <div class="stat-label">Livres total</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% ce mois</span>
                </div>
            </div>
            
            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">{{ \App\Models\User::where('role', 'user')->count() }}</div>
                <div class="stat-label">Utilisateurs actifs</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>8% cette semaine</span>
                </div>
            </div>
            
            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value">189</div>
                <div class="stat-label">Ventes ce mois</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>23% croissance</span>
                </div>
            </div>
            
            <div class="stat-card animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value">€4,256</div>
                <div class="stat-label">Revenus totaux</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>15% ce trimestre</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <h2 class="section-title">Actions rapides</h2>
        <div class="actions-grid">
            <a href="/admin/books/create" class="action-card animate-fade-in-up">
                <div class="action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <h3>Ajouter un livre</h3>
                <small>Créer un nouveau livre</small>
            </a>
            
            <a href="/admin/books" class="action-card animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="action-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h3>Gérer les livres</h3>
                <small>Modifier ou supprimer</small>
            </a>
            
            <a href="{{ route('books.index') }}" class="action-card animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="action-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Voir boutique</h3>
                <small>Vue utilisateur</small>
            </a>
            
            <a href="{{ route('profile.edit') }}" class="action-card animate-fade-in-up" style="animation-delay: 0.3s;">
                <div class="action-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3>Profil</h3>
                <small>Modifier le compte</small>
            </a>
        </div>

        <!-- Recent Activity -->
        <h2 class="section-title">Activité récente</h2>
        <div class="activity-container animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="activity-details">
                    <h4>Nouveau livre ajouté</h4>
                    <p>"Le Petit Prince" a été ajouté à la bibliothèque</p>
                </div>
                <div class="activity-time">Il y a 2h</div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="activity-details">
                    <h4>Nouvel utilisateur</h4>
                    <p>Marie Dupont s'est inscrite</p>
                </div>
                <div class="activity-time">Il y a 5h</div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="activity-details">
                    <h4>Vente effectuée</h4>
                    <p>"1984" a été acheté par Jean Martin</p>
                </div>
                <div class="activity-time">Il y a 1j</div>
            </div>
        </div>
    </div>

    <script>
        // Animation des cartes au chargement
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des statistiques
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Animation des actions
            const actionCards = document.querySelectorAll('.action-card');
            actionCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Effet de hover sur les cartes de statistiques
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-12px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-8px)';
                });
            });

            // Menu mobile (optionnel)
            function toggleSidebar() {
                document.querySelector('.sidebar').classList.toggle('active');
            }

            // Ajouter un bouton menu mobile pour les petits écrans
            if (window.innerWidth <= 992) {
                const menuBtn = document.createElement('button');
                menuBtn.innerHTML = '<i class="fas fa-bars"></i>';
                menuBtn.style.cssText = `
                    position: fixed;
                    top: 20px;
                    left: 20px;
                    z-index: 1001;
                    background: var(--primary);
                    color: white;
                    border: none;
                    width: 50px;
                    height: 50px;
                    border-radius: 12px;
                    font-size: 20px;
                    cursor: pointer;
                    box-shadow: var(--shadow);
                `;
                menuBtn.onclick = toggleSidebar;
                document.body.appendChild(menuBtn);
            }
        });

        // Effet de particules flottantes en arrière-plan
        function createFloatingParticles() {
            const particlesContainer = document.createElement('div');
            particlesContainer.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 0;
            `;
            document.body.appendChild(particlesContainer);

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: absolute;
                    width: ${Math.random() * 6 + 2}px;
                    height: ${Math.random() * 6 + 2}px;
                    background: rgba(255, 255, 255, 0.1);
                    border-radius: 50%;
                    animation: floatParticle ${Math.random() * 10 + 10}s linear infinite;
                    animation-delay: ${Math.random() * 10}s;
                `;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particlesContainer.appendChild(particle);
            }

            const style = document.createElement('style');
            style.textContent = `
                @keyframes floatParticle {
                    0% { transform: translateY(0) rotate(0deg); opacity: 0; }
                    10% { opacity: 1; }
                    90% { opacity: 1; }
                    100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        }

        createFloatingParticles();
    </script>

</body>
</html>