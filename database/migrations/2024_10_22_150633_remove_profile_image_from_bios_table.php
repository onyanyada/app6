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
            $table->dropColumn('profile_image'); // カラムを削除

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bios', function (Blueprint $table) {
            $table->string('profile_image')->nullable(); // カラムを再作成

        });
    }
};
