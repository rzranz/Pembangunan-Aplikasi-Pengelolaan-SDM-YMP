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
        Schema::table('profiles', function (Blueprint $table) {
            // Kita HANYA menambahkan kolom yang baru.
            // Kolom 'phone', 'linkedin_url', dan 'github_url' sudah ada.
            // Kita tambahkan 'portfolio_url' setelah 'github_url' (yang sudah ada).
            
            $table->string('portfolio_url')->nullable()->after('github_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Saat rollback, kita HANYA hapus kolom yang ditambahkan di file INI.
            
            $table->dropColumn(['portfolio_url']);
        });
    }
};