<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="max-w-2xl w-full mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mb-6">
                        <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Paiement Réussi !</h1>
                        <p class="text-gray-600 mb-4">Merci pour votre achat</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Détails de votre achat</h3>
                        <div class="text-left max-w-md mx-auto">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Livre :</span>
                                <span class="font-semibold">{{ $book->title }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Auteur :</span>
                                <span class="font-semibold">{{ $book->author }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Prix :</span>
                                <span class="font-semibold text-green-600">{{ number_format($book->price, 2) }} €</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('books.show', $book) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-200">
                            <i class="fas fa-book mr-2"></i>Voir le livre
                        </a>
                        <a href="{{ route('books.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-200">
                            <i class="fas fa-home mr-2"></i>Retour à la librairie
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>