<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Profile;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateCategoryData extends Command
{
    protected $signature = 'app:migrate-category-data';
    protected $description = 'Migrates old string categories to the new structured categories table.';

    public function handle()
    {
        $this->info('Memulai migrasi data kategori...');

        if (!Schema::hasColumn('profiles', 'category_id')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('category');
            });
            $this->info('Kolom `category_id` sementara telah ditambahkan.');
        }

        $oldCategoryNames = Profile::whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category');

        if ($oldCategoryNames->isEmpty()) {
            $this->warn('Tidak ada data kategori lama untuk dimigrasi.');
            return 0;
        }
        $this->info("Ditemukan " . $oldCategoryNames->count() . " kategori unik.");

        $categoryMap = [];
        foreach ($oldCategoryNames as $name) {
            $category = Category::firstOrCreate(['name' => trim($name)]);
            $categoryMap[$name] = $category->id;
        }
        $this->info('Tabel `categories` berhasil diisi.');

        foreach ($categoryMap as $name => $id) {
            Profile::where('category', $name)->update(['category_id' => $id]);
        }
        $this->info('Semua profil telah diperbarui dengan `category_id` yang benar.');

        $this->comment('Migrasi data selesai. Anda sekarang bisa membuat migrasi baru untuk menghapus kolom `category` lama.');
        return 0;
    }
}
