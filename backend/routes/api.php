<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/health', [ApiController::class, 'health']);
Route::get('/books', [ApiController::class, 'books']);

// Routes API pour les livres
Route::apiResource('books', BookController::class)->except(['create', 'edit']);
