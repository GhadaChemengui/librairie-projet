<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Utilisateur - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        /* Sidebar moderne */
        .sidebar {
            background: var(--dark);
            background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: var(--transition);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
            margin-bottom: 4px;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
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

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-item:hover::before {
            transform: scaleY(1);
        }

        .nav-item.active {
            background: rgba(99, 102, 241, 0.2);
            color: white;
        }

        .nav-item.active::before {
            transform: scaleY(1);
        }

        .nav-section {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 24px 0 12px 0;
            padding: 0 16px;
        }

        /* Contenu principal */
        .main-content {
            margin-left: 256px;
            min-height: 100vh;
        }

        /* Header moderne */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            background: var(--gradient);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        /* Cartes modernes */
        .card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
        }

        /* Boutons modernes */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
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

        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-gray {
            background: #6b7280;
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-gray:hover {
            background: #4b5563;
            transform: translateY(-2px);
        }

        /* Formulaires */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: var(--transition);
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: var(--transition);
            font-size: 1rem;
            background: white;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-admin {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .badge-user {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.active {
                transform: translateX(0);
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
    </style>
</head>
<body class="min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64">
            <div class="sidebar-header p-6">
                <h1 class="text-xl font-bold sidebar-logo">
                    <i class="fas fa-book-open mr-3"></i>Admin Panel
                </h1>
            </div>
            
            <nav class="p-4">
                <div class="nav-section">Navigation</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="fas fa-home mr-3 w-5 text-center"></i>Tableau de bord
                </a>
                
                <div class="nav-section">Gestion des livres</div>
                <a href="{{ route('admin.books.create') }}" class="nav-item">
                    <i class="fas fa-plus-circle mr-3 w-5 text-center"></i>Ajouter un livre
                </a>
                <a href="{{ route('admin.books.index') }}" class="nav-item">
                    <i class="fas fa-edit mr-3 w-5 text-center"></i>Gérer les livres
                </a>

                <!-- SECTION : Gestion des Ventes -->
                <div class="nav-section">Gestion des Ventes</div>
                <a href="{{ route('admin.purchases.index') }}" class="nav-item">
                    <i class="fas fa-shopping-cart mr-3 w-5 text-center"></i>Achats & Ventes
                </a>
                <a href="{{ route('admin.purchases.statistics') }}" class="nav-item">
                    <i class="fas fa-chart-bar mr-3 w-5 text-center"></i>Statistiques
                </a>

                <!-- SECTION : Gestion des Utilisateurs -->
                <div class="nav-section">Gestion des Utilisateurs</div>
                <a href="{{ route('admin.users.index') }}" class="nav-item">
                    <i class="fas fa-users mr-3 w-5 text-center"></i>Liste des utilisateurs
                </a>
                <a href="{{ route('admin.users.create') }}" class="nav-item">
                    <i class="fas fa-user-plus mr-3 w-5 text-center"></i>Ajouter un utilisateur
                </a>
                <a href="{{ route('admin.users.statistics') }}" class="nav-item">
                    <i class="fas fa-chart-pie mr-3 w-5 text-center"></i>Statistiques
                </a>
                
                <div class="nav-section">Compte</div>
                <a href="{{ route('profile.edit') }}" class="nav-item">
                    <i class="fas fa-user-edit mr-3 w-5 text-center"></i>Modifier le profil
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-8">
                    @csrf
                    <button type="submit" class="nav-item w-full text-left bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>Déconnexion
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Header -->
            <header class="header">
                <div class="px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Modifier l'Utilisateur</h1>
                            <p class="text-gray-600 mt-1">Mettre à jour les informations de {{ $user->name }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500 flex items-center gap-1">
                                    <i class="fas fa-shield-alt text-green-500"></i>
                                    Administrateur
                                </div>
                            </div>
                            <div class="user-avatar w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-8">
                <div class="max-w-2xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 mb-8 rounded-lg flex items-center gap-3">
                            <i class="fas fa-check-circle text-lg"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Informations utilisateur -->
                    <div class="card p-6 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                    <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-user' }} mt-2">
                                        <i class="fas {{ $user->role == 'admin' ? 'fa-crown' : 'fa-user' }} mr-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Membre depuis</p>
                                <p class="font-semibold text-gray-700">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="card p-8">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Nom -->
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user mr-2 text-blue-500"></i>Nom complet
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}"
                                           class="form-input @error('name') border-red-500 @enderror"
                                           placeholder="Entrez le nom complet"
                                           required>
                                    @error('name')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope mr-2 text-blue-500"></i>Adresse email
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}"
                                           class="form-input @error('email') border-red-500 @enderror"
                                           placeholder="entrez@email.com"
                                           required>
                                    @error('email')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Mot de passe -->
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock mr-2 text-blue-500"></i>Nouveau mot de passe
                                    </label>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-input @error('password') border-red-500 @enderror"
                                           placeholder="Laissez vide pour ne pas changer">
                                    @error('password')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-1">Minimum 8 caractères</p>
                                </div>

                                <!-- Confirmation mot de passe -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock mr-2 text-blue-500"></i>Confirmer le mot de passe
                                    </label>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-input"
                                           placeholder="Confirmez le nouveau mot de passe">
                                </div>
                            </div>

                            <!-- Rôle -->
                            <div class="form-group mb-8">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-tag mr-2 text-blue-500"></i>Rôle de l'utilisateur
                                </label>
                                <select id="role" 
                                        name="role" 
                                        class="form-select @error('role') border-red-500 @enderror"
                                        required>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                </select>
                                @error('role')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-between items-center pt-6 border-t">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-gray">
                                        <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
                                    </a>
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn bg-blue-100 text-blue-700 hover:bg-blue-200">
                                        <i class="fas fa-eye mr-2"></i>Voir détails
                                    </a>
                                </div>
                                <div class="flex space-x-3">
                                    <button type="reset" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                                        <i class="fas fa-undo mr-2"></i>Réinitialiser
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Section danger -->
                    @if($user->id !== auth()->id())
                    <div class="card p-6 mt-6 border-red-200 bg-red-50">
                        <h3 class="text-lg font-semibold text-red-800 mb-4 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Zone de danger
                        </h3>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-red-700 mb-2">Supprimer définitivement cet utilisateur</p>
                                <p class="text-red-600 text-sm">Cette action est irréversible. Toutes les données de l'utilisateur seront perdues.</p>
                            </div>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">
                                    <i class="fas fa-trash mr-2"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="card p-6 mt-6 border-yellow-200 bg-yellow-50">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-yellow-600 text-xl mr-4"></i>
                            <div>
                                <h3 class="font-semibold text-yellow-800 mb-1">Information</h3>
                                <p class="text-yellow-700 text-sm">Vous ne pouvez pas modifier votre propre rôle ou supprimer votre propre compte depuis cette interface.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des cartes
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Menu mobile (optionnel)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        // Validation en temps réel du mot de passe
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');

            function validatePassword() {
                if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
                    confirmPassword.style.borderColor = '#ef4444';
                } else if (password.value && confirmPassword.value) {
                    confirmPassword.style.borderColor = '#10b981';
                } else {
                    confirmPassword.style.borderColor = '#e5e7eb';
                }
            }

            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);
        });
    </script>
</body>
</html>