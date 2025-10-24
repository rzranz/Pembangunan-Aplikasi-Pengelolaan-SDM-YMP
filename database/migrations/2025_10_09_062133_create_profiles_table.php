<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // 1. TAMBAHKAN kolom baru 'category_id' sebagai penghubung
            $table->foreignId('category_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            
            // 2. HAPUS kolom 'category' yang lama
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Perintah untuk membatalkan perubahan jika diperlukan
            $table->string('category')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};

