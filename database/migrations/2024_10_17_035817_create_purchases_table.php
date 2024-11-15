<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 購入者のユーザーID
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // 購入した記事のID
            $table->decimal('amount', 8, 2); // 購入金額
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null'); // 決済手段ID
            $table->timestamps();
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
