<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Perintah ini untuk MEMBUAT tabel 'profiles'.
     */
    public function up(): void
    {
        // Gunakan Schema::create() untuk MEMBUAT tabel baru
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            
            // Kolom-kolom yang Anda definisikan
            $table->string('profile_picture')->nullable();
            $table->string('headline')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('bio')->nullable();
            
            // Tambahkan ini jika Anda perlu relasi ke tabel users
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     * * Perintah ini untuk MENGHAPUS tabel 'profiles' jika di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};