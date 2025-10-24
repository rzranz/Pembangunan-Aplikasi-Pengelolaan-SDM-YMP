<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use App\Models\Portfolio;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProfileService
{
    // ... (metode updateProfilePicture, convertGoogleDriveUrl, dll. ada di sini) ...
    public function updateProfilePicture(Request $request, Profile $profile): Profile
    {
        $request->validate([
            'upload_type' => 'required|in:file,url',
            'profile_picture_file' => [
                'exclude_if:upload_type,url',
                'required',
                'image',
                'max:5120'
            ],
            'profile_picture_url' => [
                'exclude_if:upload_type,file',
                'required',
                'url'
            ],
        ]);

        $newPicturePath = null;

        if ($profile->profile_picture && !str_starts_with($profile->profile_picture, 'http')) {
            Storage::disk('public')->delete($profile->profile_picture);
        }

        if ($request->upload_type === 'file' && $request->hasFile('profile_picture_file')) {
            $newPicturePath = $request->file('profile_picture_file')->store('profile-pictures', 'public');
        
        } elseif ($request->upload_type === 'url') {
            
            $imageUrl = $this->convertGoogleDriveUrl($request->profile_picture_url);

            try {
                $response = Http::timeout(10)->get($imageUrl); 

                if (!$response->successful()) {
                    throw ValidationException::withMessages([
                        'profile_picture_url' => 'Gagal mengambil gambar dari URL. Pastikan URL publik dan dapat diakses.'
                    ]);
                }

                $imageContents = $response->body();
                $contentType = $response->header('Content-Type');
                $extension = $this->getExtensionFromMimeType($contentType);

                if (!$extension) {
                    throw ValidationException::withMessages([
                        'profile_picture_url' => 'URL tidak mengarah ke tipe gambar yang valid (jpg, png, gif, webp).'
                    ]);
                }

                $filename = 'profile-pictures/' . Str::random(40) . '.' . $extension;
                Storage::disk('public')->put($filename, $imageContents);
                $newPicturePath = $filename;

            } catch (ValidationException $e) {
                throw $e; 
            } catch (\Exception $e) {
                Log::error('Gagal unduh profile picture dari URL: ' . $e->getMessage());
                throw ValidationException::withMessages([
                    'profile_picture_url' => 'Terjadi kesalahan saat mengunduh gambar. Silakan coba lagi.'
                ]);
            }
        }

        if ($newPicturePath) {
            $profile->update(['profile_picture' => $newPicturePath]);
        }

        return $profile;
    }

    private function convertGoogleDriveUrl(string $url): string
    {
        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
            return 'https://drive.google.com/uc?export=view&id=' . $fileId;
        }
        return $url;
    }

    private function getExtensionFromMimeType(?string $mimeType): ?string
    {
        if (!$mimeType) return null;
        
        $map = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
        ];
        $mimeType = explode(';', $mimeType)[0];
        
        return $map[$mimeType] ?? null;
    }

    // --- PERBAIKAN LOGIKA PENGAMBILAN DATA ---
    public function getPortfolioData(User $user)
    {
        // 1. Muat relasi profil
        $user->load('profile');

        // 2. Jika profil ada, muat semua relasi DARI PROFIL
        // Ini memastikan kita menggunakan sumber data yang sama dengan halaman 'manage'
        if ($user->profile) {
            $user->profile->load([
                'portfolios' => fn($q) => $q->latest(),
                'experiences' => fn($q) => $q->latest(),
                'educations' => fn($q) => $q->latest(),
                'certifications' => fn($q) => $q->latest(),
            ]);
        }

        // 3. Kembalikan user dengan data yang sudah dimuat di profile
        return $user;
    }

    public function getManagementData(User $user)
    {
        $profile = $user->profile;
        return [
            'profile' => $profile,
            'portfolios' => $profile->portfolios()->latest()->get(),
            'experiences' => $profile->experiences()->latest()->get(),
            'educations' => $profile->educations()->latest()->get(),
            'certifications' => $profile->certifications()->latest()->get(),
        ];
    }

    public function updateBio(Request $request, Profile $profile): Profile
    {
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
        ]);

        $profile->update($validated);
        return $profile;
    }
    
    // ... (sisa metode store/destroy Anda) ...
    public function storePortfolio(Request $request, Profile $profile): void
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skills_used' => 'required|string',
            'project_url' => 'nullable|url',
        ]);
        $profile->portfolios()->create($request->all());
    }

    public function destroyPortfolio(Portfolio $portfolio): void
    {
        $portfolio->delete();
    }

    public function storeExperience(Request $request, Profile $profile): void
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $profile->experiences()->create($request->all());
    }

    public function destroyExperience(Experience $experience): void
    {
        $experience->delete();
    }
    
    public function storeEducation(Request $request, Profile $profile): void
    {
        $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $profile->educations()->create($request->all());
    }

    public function destroyEducation(Education $education): void
    {
        $education->delete();
    }

    public function storeCertification(Request $request, Profile $profile): void
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'credential_url' => 'nullable|url',
            'file' => ['nullable', File::types(['jpg', 'jpeg', 'png', 'pdf'])->max(2048)],
        ]);

        $data = $validated;
        
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('certifications', 'public');
            $data['file_path'] = $path;
        }

        $profile->certifications()->create($data);
    }

    public function destroyCertification(Certification $certification): void
    {
        if ($certification->file_path) {
            Storage::disk('public')->delete($certification->file_path);
        }
        $certification->delete();
    }
}