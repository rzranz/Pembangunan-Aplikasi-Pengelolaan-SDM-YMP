<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class ProfileImage extends Component
{
    public $imageUrl;

    /**
     * Create a new component instance.
     */
    public function __construct($user)
    {
        $path = $user->profile?->profile_picture;
        $name = $user->name ?? 'User';

        // ==========================================================
        // PERBAIKAN ALUR LOGIKA
        // ==========================================================
        // 1. Periksa dulu apakah path adalah sebuah URL.
        if ($path && (str_starts_with($path, 'http://') || str_starts_with($path, 'https://'))) {
            // KASUS 1: Jika path adalah URL, coba konversi jika itu link Google Drive.
            $this->imageUrl = $this->convertGoogleDriveUrl($path);
        } 
        // 2. Hanya jika bukan URL, periksa sebagai file lokal.
        elseif ($path && Storage::disk('public')->exists($path)) {
            // KASUS 2: Jika path adalah file lokal yang ada, gunakan Storage::url().
            $this->imageUrl = Storage::url($path);
        } 
        // 3. Jika semua gagal, gunakan avatar default.
        else {
            // KASUS 3: Jika tidak ada foto atau path tidak valid, gunakan avatar default.
            $this->imageUrl = 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
        }
    }

    private function convertGoogleDriveUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        // Pola untuk mengekstrak ID file dari URL Google Drive
        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
            // Mengembalikan format URL yang bisa di-embed langsung oleh tag <img>
            return 'https://drive.google.com/uc?export=view&id=' . $fileId;
        }
        return $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.profile-image');
    }
}

