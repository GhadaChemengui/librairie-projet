<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_purchases_table.php
public function up()
{
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('book_id')->constrained()->onDelete('cascade');
        $table->decimal('price', 8, 2);
        $table->integer('quantity')->default(1);
        $table->string('status')->default('completed'); // completed, pending, cancelled
        $table->string('payment_method')->nullable();
        $table->string('transaction_id')->nullable();
        $table->timestamps();
        
        $table->index(['user_id', 'book_id']);
        $table->index('created_at');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
