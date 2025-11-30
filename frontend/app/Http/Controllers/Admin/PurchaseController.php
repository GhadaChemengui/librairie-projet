<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PurchaseController extends Controller
{
    public function index()
    {
        $search = request('search');
        $status = request('status');
        $date = request('date');

        $purchases = Purchase::with(['user', 'book'])
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%');
                })->orWhereHas('book', function($q) use ($search) {
                    $q->where('title', 'like', '%'.$search.'%')
                      ->orWhere('author', 'like', '%'.$search.'%');
                });
            })
            ->when($status, function($query) use ($status) {
                // Vérifier si la colonne status existe avant de filtrer
                if (Schema::hasColumn('purchases', 'status')) {
                    $query->where('status', $status);
                }
            })
            ->when($date, function($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(20);

        // Statistiques avec vérification de la colonne status
        $stats = [
            'total_sales' => Purchase::count(),
            'total_revenue' => Purchase::sum('price'),
            'today_sales' => Purchase::whereDate('created_at', today())->count(),
            'month_revenue' => Purchase::whereMonth('created_at', now()->month)->sum('price'),
        ];

        // Si la colonne status existe, utiliser les scopes
        if (Schema::hasColumn('purchases', 'status')) {
            $stats = [
                'total_sales' => Purchase::completed()->count(),
                'total_revenue' => Purchase::completed()->sum('price'),
                'today_sales' => Purchase::completed()->whereDate('created_at', today())->count(),
                'month_revenue' => Purchase::completed()->whereMonth('created_at', now()->month)->sum('price'),
            ];
        }

        return view('admin.purchases.index', compact('purchases', 'stats'));
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['user', 'book']);
        
        return view('admin.purchases.show', compact('purchase'));
    }

    public function updateStatus(Request $request, Purchase $purchase)
    {
        // Vérifier si la colonne status existe
        if (!Schema::hasColumn('purchases', 'status')) {
            return back()->with('error', 'La colonne status n\'existe pas encore dans la base de données.');
        }

        $request->validate([
            'status' => 'required|in:completed,pending,cancelled,refunded'
        ]);

        $purchase->update(['status' => $request->status]);

        return back()->with('success', 'Statut de l\'achat mis à jour avec succès');
    }

    // Méthode pour annuler une vente
    public function cancelSale(Purchase $purchase)
    {
        // Vérifier que c'est bien un admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }

        // Sauvegarder les infos pour le message
        $userName = $purchase->user->name;
        $bookTitle = $purchase->book->title;

        // Annuler la vente (changer le statut)
        $purchase->update(['status' => 'cancelled']);

        return redirect()->route('admin.purchases.index')
            ->with('success', "Vente annulée : $bookTitle a été retiré des achats de $userName");
    }

    // Statistiques des ventes
    public function statistics()
    {
        // Vérifier si la colonne status existe
        $hasStatusColumn = Schema::hasColumn('purchases', 'status');

        // Ventes des 30 derniers jours
        $query = Purchase::query();
        if ($hasStatusColumn) {
            $query->where('status', 'completed');
        }
        
        $recentSales = $query->where('created_at', '>=', now()->subDays(30))
            ->get()
            ->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function($group) {
                return [
                    'count' => $group->count(),
                    'revenue' => $group->sum('price')
                ];
            });

        // Livres les plus vendus
        $topBooksQuery = Book::query();
        if ($hasStatusColumn) {
            $topBooksQuery->withCount(['purchases as sales_count' => function($query) {
                $query->where('status', 'completed');
            }])->withSum(['purchases as total_revenue' => function($query) {
                $query->where('status', 'completed');
            }], 'price');
        } else {
            $topBooksQuery->withCount('purchases as sales_count')
                         ->withSum('purchases as total_revenue', 'price');
        }

        $topBooks = $topBooksQuery->orderBy('sales_count', 'desc')
            ->limit(10)
            ->get();

        // Clients les plus actifs
        $topCustomersQuery = User::query();
        if ($hasStatusColumn) {
            $topCustomersQuery->withCount(['purchases as purchases_count' => function($query) {
                $query->where('status', 'completed');
            }])->withSum(['purchases as total_spent' => function($query) {
                $query->where('status', 'completed');
            }], 'price');
        } else {
            $topCustomersQuery->withCount('purchases as purchases_count')
                             ->withSum('purchases as total_spent', 'price');
        }

        $topCustomers = $topCustomersQuery->orderBy('total_spent', 'desc')
            ->limit(10)
            ->get();

        return view('admin.purchases.statistics', compact('recentSales', 'topBooks', 'topCustomers'));
    }
}