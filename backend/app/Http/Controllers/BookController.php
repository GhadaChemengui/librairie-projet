<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // IMPORT AJOUTÉ

class BookController extends Controller
{
    // LISTE - Différencie admin et utilisateur
    public function index()
    {
        $search = request('search');
        
        $books = Book::when($search, function($query) use ($search) {
            $query->where('title', 'like', '%'.$search.'%')
                  ->orWhere('author', 'like', '%'.$search.'%');
        })->latest()->paginate(12);
        
        // FORCER la détection de la route admin
        $isAdminRoute = request()->is('admin/*') || request()->routeIs('admin.books.*');
        
        // Si c'est une route admin ET utilisateur est admin
        if ($isAdminRoute && auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.books.index', compact('books'));
        }
        
        return view('books.index', compact('books'));
    }

    // LISTE ADMIN - Uniquement pour les admins
    public function adminIndex()
    {
        \Log::info('🎯 === ADMIN INDEX METHOD CALLED === 🎯');
        \Log::info('User: ' . auth()->user()->name);
        \Log::info('Role: ' . auth()->user()->role);
        
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }
        
        $books = Book::latest()->get();
        
        \Log::info('✅ Returning admin.books.index view');
        \Log::info('📚 Books count: ' . $books->count());
        
        return view('admin.books.index', compact('books'));
    }

    // FORM AJOUT - Uniquement admin
    public function create()
    {
        // Vérification supplémentaire de sécurité
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('admin.books.create');
    }

    // AJOUT - Uniquement admin
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'published_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre créé avec succès!');
    }

    // AFFICHER - Accessible à tous
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // FORM EDIT - Uniquement admin
    public function edit(Book $book)
    {
        // Vérification supplémentaire de sécurité
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }
        
        return view('admin.books.edit', compact('book'));
    }

    // UPDATE - Uniquement admin
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'published_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Livre modifié avec succès!');
    }

    // DELETE - Uniquement admin
    public function destroy(Book $book)
    {
        // Vérification supplémentaire de sécurité
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }

        // Supprimer l'image si elle existe
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Livre supprimé avec succès');
    }

    // ACHAT (pour les users normaux)
    public function purchase(Book $book)
    {
        return view('payment.checkout', compact('book'));
    }

    public function processPayment(Book $book)
    {
        // Vérifier si l'utilisateur a déjà acheté ce livre
        if (auth()->user()->purchases()->where('book_id', $book->id)->exists()) {
            return redirect()->route('books.show', $book)
                ->with('error', 'Vous avez déjà acheté ce livre.');
        }

        // Enregistrer l'achat
        auth()->user()->purchases()->create([
            'book_id' => $book->id,
            'price' => $book->price
        ]);

        return redirect()->route('payment.success', $book);
    }

    public function paymentSuccess(Book $book)
    {
        return view('payment.success', compact('book'));
    }

    public function paymentCancel(Book $book)
    {
        return view('payment.cancel', compact('book'));
    }
}