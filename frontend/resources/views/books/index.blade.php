<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie - {{ config('app.name') }}</title>
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
            --shadow-hover: 0 20px 40px -4px rgba(0, 0, 0, 0.15), 0 8px 10px -4px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }

        /* Navigation moderne */
        nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .logo {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Cartes modernes */
        .card {
            background: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        .card-purchased {
            border: 2px solid var(--secondary);
            position: relative;
        }

        /* Boutons modernes */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
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
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--secondary) 0%, #059669 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-google {
            background: linear-gradient(135deg, #4285F4 0%, #357AE8 100%);
            color: white;
        }

        .btn-google:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* En-tête moderne */
        .header {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Barre de recherche moderne */
        .search-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .search-input {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(99, 102, 241, 0.1);
            transition: var(--transition);
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: white;
        }

        /* Badge moderne */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, var(--secondary) 0%, #059669 100%);
            color: white;
        }

        .badge-admin {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }

        /* Image container moderne */
        .image-container {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        }

        .image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.6s;
        }

        .card:hover .image-container::before {
            left: 100%;
        }

        /* État vide moderne */
        .empty-state {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Pagination moderne */
        .pagination-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Footer moderne */
        footer {
            background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        /* Animations */
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

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #4338ca 100%);
        }

        /* Utilitaires */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-book-open text-2xl mr-3 text-gradient"></i>
                    <h1 class="text-xl font-bold logo">{{ config('app.name') }}</h1>
                </div>
                <div class="flex items-center space-x-3">
                    @auth
                        <span class="text-sm font-medium text-gray-700 bg-white/80 px-3 py-1 rounded-full">
                            👋 Bonjour, {{ auth()->user()->name }}
                        </span>
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('books.index') }}" class="btn btn-success text-sm">
                                <i class="fas fa-bookmark mr-1"></i>Mes Livres
                            </a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="btn btn-outline text-sm">
                            <i class="fas fa-chart-pie mr-1"></i>Tableau de bord
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm">
                                <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline text-sm">
                            <i class="fas fa-sign-in-alt mr-1"></i>Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-sm">
                            <i class="fas fa-user-plus mr-1"></i>Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 pt-20">
        <div class="px-4 py-6 sm:px-0">
            <!-- Header -->
            <div class="header rounded-2xl mb-8 p-8 animate-fade-in-up">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        @auth
                            @if(auth()->user()->role !== 'admin')
                                📚 Ma Librairie Personnelle
                            @else
                                🎯 Collection de Livres
                            @endif
                        @else
                            📖 Découvrez Notre Collection
                        @endauth
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        @auth
                            @if(auth()->user()->role !== 'admin')
                                Explorez de nouveaux horizons littéraires et retrouvez vos précieuses acquisitions
                            @else
                                Gérer l'ensemble du catalogue avec des outils d'administration puissants
                            @endif
                        @else
                            Plongez dans un univers de connaissances et de divertissement sans limites
                        @endauth
                    </p>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-container rounded-2xl mb-8 p-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                <form action="{{ route('books.index') }}" method="GET" class="flex gap-4 items-center">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Rechercher un livre par titre, auteur, catégorie..."
                               class="search-input w-full pl-12 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <button type="submit" class="btn btn-primary px-8 py-3">
                        <i class="fas fa-search mr-2"></i>Rechercher
                    </button>
                    @if(request('search'))
                        <a href="{{ route('books.index') }}" class="btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3">
                            <i class="fas fa-times mr-2"></i>Effacer
                        </a>
                    @endif
                </form>
            </div>

            <!-- Books Grid -->
            @if($books->count() > 0)
                @php
                    // Filtrer les livres : seulement les achats avec statut "completed"
                    $unpurchasedBooks = $books->filter(function($book) {
                        if (!auth()->check() || auth()->user()->role === 'admin') {
                            return true;
                        }
                        
                        $userPurchase = auth()->user()->purchases()
                            ->where('book_id', $book->id)
                            ->where('status', 'completed')
                            ->first();
                            
                        return !$userPurchase;
                    });
                    
                    $purchasedBooks = $books->filter(function($book) {
                        if (!auth()->check() || auth()->user()->role === 'admin') {
                            return false;
                        }
                        
                        $userPurchase = auth()->user()->purchases()
                            ->where('book_id', $book->id)
                            ->where('status', 'completed')
                            ->first();
                            
                        return $userPurchase;
                    });
                @endphp

                <!-- Livres NON Achetés -->
                @if($unpurchasedBooks->count() > 0)
                    <div class="mb-12 animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">
                                @auth
                                    @if(auth()->user()->role !== 'admin')
                                        🚀 Livres Disponibles
                                    @else
                                        📦 Tous les Livres
                                    @endif
                                @else
                                    🌟 Notre Collection
                                @endauth
                            </h2>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $unpurchasedBooks->count() }} livre(s)
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($unpurchasedBooks as $book)
                                <div class="card group">
                                    <!-- Book Image -->
                                    <div class="image-container h-48 rounded-t-2xl flex items-center justify-center">
                                        @if($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}" 
                                                 alt="{{ $book->title }}" 
                                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="text-center text-gray-400">
                                                <i class="fas fa-book text-5xl mb-2"></i>
                                                <p class="text-sm">Aucune image</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Book Details -->
                                    <div class="p-5">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                            {{ $book->title }}
                                        </h3>
                                        
                                        <p class="text-gray-600 text-sm mb-2 flex items-center">
                                            <i class="fas fa-user-edit mr-2 text-blue-500"></i>
                                            {{ $book->author }}
                                        </p>
                                        
                                        @if($book->category)
                                            <p class="text-gray-500 text-xs mb-3 flex items-center">
                                                <i class="fas fa-tag mr-2 text-green-500"></i>
                                                {{ $book->category }}
                                            </p>
                                        @endif
                                        
                                        <p class="text-gray-700 text-sm mb-4 line-clamp-2">
                                            {{ Str::limit($book->description, 100) }}
                                        </p>
                                        
                                        <div class="flex justify-between items-center">
                                            <span class="text-2xl font-bold text-gradient">
                                                {{ number_format($book->price, 2) }} €
                                            </span>
                                            
                                            <div class="flex space-x-2">
                                                @if($book->google_books_link)
                                                    <a href="{{ $book->google_books_link }}" 
                                                       target="_blank"
                                                       class="btn btn-google px-3 py-2 text-sm">
                                                        <i class="fab fa-google mr-1"></i>Lire
                                                    </a>
                                                @else
                                                    <a href="{{ route('books.show', $book) }}" 
                                                       class="btn bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 text-sm">
                                                        <i class="fas fa-eye mr-1"></i>Détails
                                                    </a>
                                                @endif
                                                
                                                @auth
                                                    @if(auth()->user()->role !== 'admin')
                                                        <form action="{{ route('books.purchase', $book) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" 
                                                                    class="btn btn-success px-3 py-2 text-sm">
                                                                <i class="fas fa-shopping-cart mr-1"></i>Acheter
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="badge badge-admin px-3 py-2">
                                                            <i class="fas fa-crown mr-1"></i>Admin
                                                        </span>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" 
                                                       class="btn btn-success px-3 py-2 text-sm">
                                                        <i class="fas fa-shopping-cart mr-1"></i>Acheter
                                                    </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Livres Achetés -->
                @if($purchasedBooks->count() > 0)
                    <div class="mt-12 animate-fade-in-up" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">🎉 Mes Acquisitions</h2>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $purchasedBooks->count() }} livre(s) acheté(s)
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($purchasedBooks as $book)
                                <div class="card card-purchased group">
                                    <!-- Book Image -->
                                    <div class="image-container h-48 rounded-t-2xl flex items-center justify-center">
                                        @if($book->image)
                                            <img src="{{ asset('storage/' . $book->image) }}" 
                                                 alt="{{ $book->title }}" 
                                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="text-center text-gray-400">
                                                <i class="fas fa-book text-5xl mb-2"></i>
                                                <p class="text-sm">Aucune image</p>
                                            </div>
                                        @endif
                                        <div class="absolute top-3 right-3">
                                            <span class="badge badge-success">
                                                <i class="fas fa-check mr-1"></i>Acheté
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Book Details -->
                                    <div class="p-5">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors">
                                            {{ $book->title }}
                                        </h3>
                                        
                                        <p class="text-gray-600 text-sm mb-2 flex items-center">
                                            <i class="fas fa-user-edit mr-2 text-blue-500"></i>
                                            {{ $book->author }}
                                        </p>
                                        
                                        @if($book->google_books_link)
                                            <a href="{{ $book->google_books_link }}" 
                                               target="_blank"
                                               class="btn btn-google w-full justify-center py-2.5 mt-3">
                                                <i class="fab fa-google mr-2"></i>Commencer la lecture
                                            </a>
                                        @else
                                            <a href="{{ route('books.show', $book) }}" 
                                               class="btn btn-primary w-full justify-center py-2.5 mt-3">
                                                <i class="fas fa-book-open mr-2"></i>Voir le livre
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                @if(method_exists($books, 'hasPages') && $books->hasPages())
                    <div class="pagination-container rounded-2xl mt-8 p-6 animate-fade-in-up" style="animation-delay: 0.4s;">
                        {{ $books->links() }}
                    </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="empty-state rounded-2xl p-12 text-center animate-fade-in-up">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-3xl text-gradient"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Aucun livre trouvé</h3>
                        <p class="text-gray-600 mb-6">
                            @if(request('search'))
                                Aucun résultat ne correspond à "{{ request('search') }}"
                            @else
                                @auth
                                    @if(auth()->user()->role !== 'admin')
                                        Votre bibliothèque est vide pour le moment
                                    @else
                                        Le catalogue est actuellement vide
                                    @endif
                                @else
                                    Notre collection est en cours de préparation
                                @endauth
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('books.index') }}" class="btn btn-primary">
                                <i class="fas fa-undo mr-2"></i>Afficher tous les livres
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-book-open text-2xl mr-3 text-white"></i>
                    <h2 class="text-xl font-bold text-white">{{ config('app.name') }}</h2>
                </div>
                <p class="text-gray-300 mb-6">Votre bibliothèque numérique moderne et élégante</p>
                <p class="text-gray-400">&copy; 2024 {{ config('app.name') }}. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation au scroll
        document.addEventListener('DOMContentLoaded', function() {
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

            // Observer les cartes
            document.querySelectorAll('.card').forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.transitionDelay = (index * 0.1) + 's';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>