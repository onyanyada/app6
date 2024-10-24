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
        Schema::table('bios', function (Blueprint $table) {
            $table->string('img_url')->nullable();  // プロフィール画像のURLを追加

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bios', function (Blueprint $table) {
            $table->dropColumn('img_url');  // カラムを元に戻す処理
        });
    }
};
