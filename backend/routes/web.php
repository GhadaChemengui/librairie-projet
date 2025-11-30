<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes d'authentification Breeze
require __DIR__.'/auth.php';

// Routes publiques (accessibles sans authentification)
Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/{book}', [BookController::class, 'show'])->name('books.show');
});

// Routes pour utilisateurs connectés
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard - Redirige les utilisateurs normaux vers les livres
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('books.index');
        }
    })->name('dashboard');

    // Routes profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes d'achat et paiement pour les utilisateurs connectés
    Route::prefix('books')->group(function () {
        Route::post('/{book}/purchase', [BookController::class, 'purchase'])->name('books.purchase');
    });

    // Routes de paiement
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::post('/{book}/process', [BookController::class, 'processPayment'])->name('process');
        Route::get('/{book}/success', [BookController::class, 'paymentSuccess'])->name('success');
        Route::get('/{book}/cancel', [BookController::class, 'paymentCancel'])->name('cancel');
    });
});

// Routes ADMIN uniquement
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Books complet pour les admins
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'adminIndex'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });

    // Routes pour la gestion des achats
    Route::prefix('purchases')->name('purchases.')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('index');
        Route::get('/{purchase}', [PurchaseController::class, 'show'])->name('show');
        Route::patch('/{purchase}/status', [PurchaseController::class, 'updateStatus'])->name('update-status');
        Route::post('/{purchase}/cancel-sale', [PurchaseController::class, 'cancelSale'])->name('cancel-sale');
        Route::get('/statistics', [PurchaseController::class, 'statistics'])->name('statistics');
    });

    // Routes pour la gestion des utilisateurs
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::patch('/{user}/role', [UserController::class, 'updateRole'])->name('update-role');
        Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::get('/statistics', [UserController::class, 'statistics'])->name('statistics');
    });
});

// Route de test/debug (À RETIRER EN PRODUCTION)
Route::get('/test-debug', function() {
    echo "<h1>Debug Info</h1>";
    echo "Authentifié: " . (auth()->check() ? 'OUI' : 'NON') . "<br>";
    
    if (auth()->check()) {
        $user = auth()->user();
        echo "Utilisateur: " . $user->name . "<br>";
        echo "Email: " . $user->email . "<br>";
        echo "Rôle: " . $user->role . "<br>";
        echo "Est admin: " . ($user->role === 'admin' ? 'OUI' : 'NON') . "<br>";
    }
    
    echo "<h2>Test des vues</h2>";
    if (view()->exists('admin.books.create')) {
        echo "✅ La vue admin.books.create existe<br>";
    } else {
        echo "❌ La vue admin.books.create n'existe pas<br>";
    }
    
    if (view()->exists('books.create')) {
        echo "✅ La vue books.create existe<br>";
    } else {
        echo "❌ La vue books.create n'existe pas<br>";
    }
    
    echo "<h2>Routes disponibles pour books</h2>";
    $routes = Route::getRoutes();
    foreach ($routes as $route) {
        if (strpos($route->uri(), 'books') !== false || strpos($route->getName() ?? '', 'books') !== false) {
            echo $route->uri() . " → " . ($route->getName() ?? 'No name') . "<br>";
        }
    }
})->name('test.debug');

// Route de test ADMIN
Route::get('/test-admin-books', function() {
    \Log::info('🎯 === TEST ADMIN BOOKS ROUTE CALLED === 🎯');
    return app()->make(\App\Http\Controllers\BookController::class)->adminIndex();
})->middleware(['auth', 'verified', 'admin']);

// Route fallback pour les pages 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});