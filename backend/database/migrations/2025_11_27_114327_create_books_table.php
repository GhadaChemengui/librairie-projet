<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // Dans la migration create_books_table
public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->text('description');
        $table->decimal('price', 8, 2);
        $table->string('category')->nullable();
        $table->string('isbn')->nullable();
        $table->date('published_date')->nullable();
        $table->string('image')->nullable(); // Champ pour l'image
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('books');
    }
};