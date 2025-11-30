<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email', 
    'password',
    'role',
    'is_active' // Ajoutez ceci si vous voulez gérer l'activation
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
  protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean', // Ajoutez ceci
    ];
}

    /**
     * Relation avec les achats
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Relation avec les livres achetés (tous statuts)
     */
    public function purchasedBooks()
    {
        return $this->belongsToMany(Book::class, 'purchases')
                    ->withPivot('price', 'status', 'created_at')
                    ->withTimestamps();
    }

    /**
     * Achats valides (seulement les achats complets)
     */
    public function validPurchases()
    {
        return $this->hasMany(Purchase::class)->where('status', 'completed');
    }

    /**
     * Livres achetés valides (seulement les achats complets)
     */
    public function validPurchasedBooks()
    {
        return $this->belongsToMany(Book::class, 'purchases')
                    ->withPivot('price', 'status', 'created_at')
                    ->wherePivot('status', 'completed')
                    ->withTimestamps();
    }

    /**
     * Vérifie si l'utilisateur a acheté un livre spécifique (statut complet)
     */
    public function hasPurchasedBook($bookId)
    {
        return $this->validPurchases()->where('book_id', $bookId)->exists();
    }

    /**
     * Vérifie si l'utilisateur est un administrateur
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Total dépensé par l'utilisateur (achats complets seulement)
     */
    public function getTotalSpentAttribute()
    {
        return $this->validPurchases()->sum('price');
    }

    /**
     * Nombre d'achats valides
     */
    public function getPurchasesCountAttribute()
    {
        return $this->validPurchases()->count();
    }
}