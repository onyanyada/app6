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
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            // 追加したカラムを削除
            $table->dropForeign(['payment_method_id']); // 外部キー制約を削除
            $table->dropColumn('payment_method_id');    // カラム自体を削除
        });
    }
};
