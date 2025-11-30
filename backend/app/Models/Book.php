<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'author', 
        'description', 
        'price', 
        'category', 
        'isbn', 
        'published_date', 
        'image'
    ];

    protected $appends = ['sales_count', 'total_revenue'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function buyers()
    {
        return $this->belongsToMany(User::class, 'purchases')
                    ->withPivot('price', 'created_at')
                    ->withTimestamps();
    }

    // Nombre d'achats pour ce livre
    public function getSalesCountAttribute()
    {
        return $this->purchases()->completed()->count();
    }

    // Revenus totaux pour ce livre
    public function getTotalRevenueAttribute()
    {
        return $this->purchases()->completed()->sum('price');
    }

    // Accessor pour l'URL complète de l'image
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-book.jpg');
    }

    // Scope pour les livres populaires (plus vendus)
    public function scopePopular($query)
    {
        return $query->withCount(['purchases as sales_count' => function($q) {
            $q->where('status', 'completed');
        }])->orderBy('sales_count', 'desc');
    }

    // Scope pour la recherche
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('author', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
    }
}