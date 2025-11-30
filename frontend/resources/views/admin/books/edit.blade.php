<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le livre - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white min-h-screen">
            <div class="p-4 border-b border-blue-700">
                <h1 class="text-xl font-bold"><i class="fas fa-book-open mr-2"></i>Admin Dashboard</h1>
            </div>
            <nav class="p-4">
                <div class="text-xs uppercase text-blue-300 mb-2">Navigation</div>
                <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 text-blue-200 hover:bg-blue-700 rounded">
                    <i class="fas fa-home mr-2"></i>Tableau de bord
                </a>
                
                <div class="text-xs uppercase text-blue-300 mb-2 mt-4">Gestion des livres</div>
                <a href="{{ route('admin.books.create') }}" class="block py-2 px-4 text-blue-200 hover:bg-blue-700 rounded">
                    <i class="fas fa-plus-circle mr-2"></i>Ajouter un livre
                </a>
                <a href="{{ route('admin.books.index') }}" class="block py-2 px-4 text-blue-200 hover:bg-blue-700 rounded">
                    <i class="fas fa-edit mr-2"></i>Gérer les livres
                </a>
                
                <div class="text-xs uppercase text-blue-300 mb-2 mt-4">Compte</div>
                <a href="{{ route('profile.edit') }}" class="block py-2 px-4 text-blue-200 hover:bg-blue-700 rounded">
                    <i class="fas fa-user-edit mr-2"></i>Modifier le profil
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 text-blue-200 hover:bg-red-600 rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Modifier le livre</h1>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-800">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500">Administrateur</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Form -->
            <main class="p-6">
                <div class="max-w-4xl mx-auto">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-white rounded-lg shadow-sm border p-6">
                        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Titre -->
                                <div class="md:col-span-2">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Titre du livre *
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                </div>

                                <!-- Auteur -->
                                <div>
                                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                        Auteur *
                                    </label>
                                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                </div>

                                <!-- Prix -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Prix (€) *
                                    </label>
                                    <input type="number" name="price" id="price" value="{{ old('price', $book->price) }}" step="0.01" min="0"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                </div>

                                <!-- Catégorie -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                        Catégorie
                                    </label>
                                    <input type="text" name="category" id="category" value="{{ old('category', $book->category) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- ISBN -->
                                <div>
                                    <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
                                        ISBN
                                    </label>
                                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Image actuelle -->
                                @if($book->image)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Image actuelle
                                        </label>
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" 
                                                 class="w-32 h-32 object-cover rounded-lg border">
                                            <div>
                                                <p class="text-sm text-gray-600">Image actuelle</p>
                                                <label class="flex items-center mt-2">
                                                    <input type="checkbox" name="remove_image" value="1" class="mr-2">
                                                    <span class="text-sm text-red-600">Supprimer cette image</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Nouvelle image -->
                                <div class="md:col-span-2">
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $book->image ? 'Changer l\'image' : 'Image du livre' }}
                                    </label>
                                    <input type="file" name="image" id="image" 
                                           accept="image/jpeg,image/png,image/jpg"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <p class="text-sm text-gray-500 mt-1">Formats acceptés: JPG, PNG, JPEG (max 2MB)</p>
                                </div>

                                <!-- Description -->
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description
                                    </label>
                                    <textarea name="description" id="description" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $book->description) }}</textarea>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                                <a href="{{ route('admin.books.index') }}" 
                                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition duration-200">
                                    Annuler
                                </a>
                                <button type="submit" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                                    <i class="fas fa-save mr-2"></i>
                                    Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>