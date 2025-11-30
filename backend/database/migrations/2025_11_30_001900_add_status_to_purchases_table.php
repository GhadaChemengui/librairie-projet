<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    if (!Schema::hasColumn('purchases', 'status')) {
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('status')->default('completed')->after('price');
        });
    }
}

    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn(['status', 'payment_method', 'transaction_id']);
        });
    }
};