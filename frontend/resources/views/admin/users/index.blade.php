<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Admin</title>
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

        /* Table moderne */
        .table-container {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 1px solid #e2e8f0;
        }

        .table-header th {
            color: #475569;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px 24px;
        }

        .table-row {
            transition: var(--transition);
            border-bottom: 1px solid #f1f5f9;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        .table-cell {
            padding: 20px 24px;
            color: #334155;
            font-weight: 500;
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

        /* Actions */
        .action-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            font-size: 14px;
        }

        .action-edit {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
        }

        .action-edit:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
        }

        .action-delete {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .action-delete:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-1px);
        }

        /* État vide */
        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed #cbd5e1;
        }

        .empty-icon {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .badge-default {
            background: #f1f5f9;
            color: #64748b;
        }

        .badge-admin {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .badge-user {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        /* Formulaires */
        input, select {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 10px 16px;
            transition: var(--transition);
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Animation des lignes du tableau */
        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-row {
            animation: fadeInRow 0.5s ease-out;
            animation-fill-mode: both;
        }

        .table-row:nth-child(1) { animation-delay: 0.1s; }
        .table-row:nth-child(2) { animation-delay: 0.2s; }
        .table-row:nth-child(3) { animation-delay: 0.3s; }
        .table-row:nth-child(4) { animation-delay: 0.4s; }
        .table-row:nth-child(5) { animation-delay: 0.5s; }

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
                <a href="{{ route('admin.users.index') }}" class="nav-item active">
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
                            <h1 class="text-2xl font-bold text-gray-800">Gestion des Utilisateurs</h1>
                            <p class="text-gray-600 mt-1">Administration des comptes utilisateurs</p>
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
                <div class="max-w-7xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert-success px-6 py-4 mb-8 flex items-center gap-3" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 12px; box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1); animation: slideIn 0.5s ease-out;">
                            <i class="fas fa-check-circle text-lg"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 mb-8 rounded-lg flex items-center gap-3">
                            <i class="fas fa-exclamation-circle text-lg"></i>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Header Actions -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Liste des Utilisateurs</h2>
                            <p class="text-gray-600 mt-1">{{ $users->total() }} utilisateur(s) au total</p>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i>
                            Nouvel Utilisateur
                        </a>
                    </div>

                    <!-- Cartes de statistiques -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="card p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Total Utilisateurs</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</h3>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Administrateurs</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['admin_users'] }}</h3>
                                </div>
                                <div class="p-3 bg-red-100 rounded-full">
                                    <i class="fas fa-crown text-red-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Utilisateurs Normaux</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['regular_users'] }}</h3>
                                </div>
                                <div class="p-3 bg-green-100 rounded-full">
                                    <i class="fas fa-user text-green-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="card p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm">Inscriptions Aujourd'hui</p>
                                    <h3 class="text-2xl font-bold text-gray-800">{{ $stats['today_registrations'] }}</h3>
                                </div>
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <i class="fas fa-calendar-day text-purple-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="card p-6 mb-6">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Rechercher par nom ou email..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                    <option value="">Tous les rôles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn btn-primary flex-1">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-gray">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Tableau des utilisateurs -->
                    <div class="table-container">
                        @if($users->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="table-header">
                                        <tr>
                                            <th class="text-left">Utilisateur</th>
                                            <th class="text-left">Email</th>
                                            <th class="text-left">Rôle</th>
                                            <th class="text-left">Inscription</th>
                                            <th class="text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr class="table-row">
                                                <td class="table-cell">
                                                    <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                                </td>
                                                <td class="table-cell">
                                                    <div class="text-gray-700">{{ $user->email }}</div>
                                                    @if($user->email_verified_at)
                                                        <div class="text-sm text-green-600 mt-1">
                                                            <i class="fas fa-check-circle"></i> Vérifié
                                                        </div>
                                                    @else
                                                        <div class="text-sm text-yellow-600 mt-1">
                                                            <i class="fas fa-exclamation-circle"></i> Non vérifié
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="table-cell">
                                                    <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-user' }}">
                                                        <i class="fas {{ $user->role == 'admin' ? 'fa-crown' : 'fa-user' }} mr-1"></i>
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>
                                                <td class="table-cell">
                                                    <div class="text-sm text-gray-600">
                                                        {{ $user->created_at->format('d/m/Y') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $user->created_at->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td class="table-cell">
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('admin.users.show', $user) }}" 
                                                           class="action-link action-edit">
                                                            <i class="fas fa-eye"></i>
                                                            Détails
                                                        </a>
                                                        
                                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                                           class="action-link action-edit">
                                                            <i class="fas fa-edit"></i>
                                                            Modifier
                                                        </a>

                                                        <!-- Menu déroulant pour changer le rôle -->
                                                        <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="role" onchange="this.form.submit()" 
                                                                    class="text-xs border rounded px-2 py-1"
                                                                    {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                            </select>
                                                        </form>

                                                        <!-- Bouton Supprimer -->
                                                        @if($user->id !== auth()->id())
                                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="action-link action-delete"
                                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')">
                                                                    <i class="fas fa-trash"></i>
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="p-4 border-t">
                                {{ $users->links() }}
                            </div>
                        @else
                            <div class="empty-state rounded-2xl p-12 text-center">
                                <div class="max-w-sm mx-auto">
                                    <i class="fas fa-users text-6xl empty-icon mb-4"></i>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun utilisateur trouvé</h3>
                                    <p class="text-gray-600 mb-6">
                                        @if(request('search') || request('role'))
                                            Aucun utilisateur ne correspond à vos critères de recherche.
                                        @else
                                            Aucun utilisateur n'est enregistré dans le système.
                                        @endif
                                    </p>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i>
                                        Ajouter un utilisateur
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
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

            // Effet de hover sur les lignes du tableau
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
        });

        // Animation pour les messages de succès
        @if(session('success'))
            setTimeout(() => {
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        @endif

        // Menu mobile (optionnel)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        // Animation slideIn pour les messages
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>