<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Ajoutez price d'abord
            if (!Schema::hasColumn('books', 'price')) {
                $table->decimal('price', 8, 2)->default(0)->after('description');
            }
            
            // Puis category
            if (!Schema::hasColumn('books', 'category')) {
                $table->string('category')->nullable()->after('price');
            }
            
            // Puis isbn
            if (!Schema::hasColumn('books', 'isbn')) {
                $table->string('isbn', 20)->nullable()->after('category');
            }
            
            // Puis published_date
            if (!Schema::hasColumn('books', 'published_date')) {
                $table->date('published_date')->nullable()->after('isbn');
            }
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['price', 'category', 'isbn', 'published_date']);
        });
    }
};