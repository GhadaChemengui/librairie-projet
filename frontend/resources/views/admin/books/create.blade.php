<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="fas fa-book-open text-2xl mr-3"></i>
                    <h1 class="text-xl font-bold">Admin - {{ config('app.name') }}</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-blue-200">Bonjour, {{ auth()->user()->name }}</span>
                    <a href="{{ route('admin.books.index') }}" class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded transition duration-200">
                        <i class="fas fa-list mr-2"></i>Liste des livres
                    </a>
                    <a href="{{ route('books.index') }}" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded transition duration-200">
                        <i class="fas fa-store mr-2"></i>Voir la boutique
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-blue-800 hover:bg-blue-900 px-4 py-2 rounded transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                                <i class="fas fa-plus-circle mr-3 text-blue-600"></i>
                                Ajouter un Nouveau Livre
                            </h1>
                            <p class="text-gray-600">Remplissez les informations pour ajouter un livre à la bibliothèque</p>
                        </div>
                        <a href="{{ route('admin.books.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="p-6 space-y-6">
                        <!-- Informations de base -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Titre -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Titre du livre <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title"
                                       value="{{ old('title') }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                       placeholder="Entrez le titre du livre">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Auteur -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Auteur <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="author" 
                                       id="author"
                                       value="{{ old('author') }}"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('author') border-red-500 @enderror"
                                       placeholder="Entrez le nom de l'auteur">
                                @error('author')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Prix et Catégorie -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Prix -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                    Prix (€) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       value="{{ old('price') }}"
                                       required
                                       min="0"
                                       step="0.01"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('price') border-red-500 @enderror"
                                       placeholder="0.00">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Catégorie -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Catégorie
                                </label>
                                <input type="text" 
                                       name="category" 
                                       id="category"
                                       value="{{ old('category') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror"
                                       placeholder="Ex: Roman, Science-fiction, etc.">
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ISBN et Date de publication -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
                                    ISBN
                                </label>
                                <input type="text" 
                                       name="isbn" 
                                       id="isbn"
                                       value="{{ old('isbn') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('isbn') border-red-500 @enderror"
                                       placeholder="Numéro ISBN">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date de publication -->
                            <div>
                                <label for="published_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de publication
                                </label>
                                <input type="date" 
                                       name="published_date" 
                                       id="published_date"
                                       value="{{ old('published_date') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('published_date') border-red-500 @enderror">
                                @error('published_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image du livre
                            </label>
                            <input type="file" 
                                   name="image" 
                                   id="image"
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">
                                Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Aperçu de l'image -->
                            <div id="imagePreview" class="mt-3 hidden">
                                <p class="text-sm text-gray-700 mb-2">Aperçu de l'image:</p>
                                <img id="preview" class="h-32 w-auto object-cover rounded-lg border">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      required
                                      rows="6"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                      placeholder="Décrivez le livre...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('admin.books.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                                <i class="fas fa-times mr-2"></i>Annuler
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                                <i class="fas fa-save mr-2"></i>Créer le livre
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Informations -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Informations</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires.</p>
                            <p class="mt-1">Le livre sera immédiatement disponible dans la boutique après création.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Aperçu de l'image avant upload
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        });

        // Validation du prix
        document.getElementById('price').addEventListener('input', function(e) {
            if (this.value < 0) {
                this.value = 0;
            }
        });

        // Confirmation avant de quitter si des données sont saisies
        window.addEventListener('beforeunload', function(e) {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            let hasData = false;
            
            for (let [key, value] of formData.entries()) {
                if (value && key !== '_token') {
                    hasData = true;
                    break;
                }
            }
            
            if (hasData) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
</body>
</html>