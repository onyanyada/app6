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
        Schema::create('payment_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 決済手段を持つユーザーID
            $table->string('method_name'); // 決済手段の名称（例: 'credit_card', 'paypal'）
            $table->string('provider'); // 決済プロバイダー（例: 'Visa', 'MasterCard', 'PayPal'）
            $table->string('account_number')->nullable(); // 決済手段に関連するアカウント番号など（暗号化推奨）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_method');
    }
};
