<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class PortfolioController extends Controller
{
    // ... method index() dan manage() Anda ...

    public function store(Request $request)
    {
        // 1. Validasi (termasuk validasi untuk file gambar)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skills_used' => 'required|string',
            'project_url' => 'nullable|url',
            // Tambahkan validasi untuk thumbnail
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $profile = Auth::user()->profile;
        $dataToCreate = $validated;

        // 2. Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // 3. Simpan file ke storage/app/public/portfolios
            // dan simpan path-nya ke variabel
            $path = $request->file('thumbnail')->store('portfolios', 'public');
            
            // 4. Masukkan path file ke data yang akan disimpan
            $dataToCreate['thumbnail'] = $path;
        }

        // 5. Buat portofolio menggunakan data yang sudah tervalidasi
        $profile->portfolios()->create($dataToCreate);

        return redirect()->route('portfolio.manage')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    // ... method destroy() Anda ...
}