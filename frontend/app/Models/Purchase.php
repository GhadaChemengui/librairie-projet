<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'price',
        'quantity',
        'status',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Scope pour les achats complets - VÉRIFIEZ CETTE MÉTHODE
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Scope pour les statistiques
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}