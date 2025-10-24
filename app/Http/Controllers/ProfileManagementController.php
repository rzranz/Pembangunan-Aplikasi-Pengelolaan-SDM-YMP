<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Services\ProfileService; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileManagementController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $user = $this->profileService->getPortfolioData(Auth::user());
        return view('portfolio.index', compact('user'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'anggota') {
            abort(404);
        }
        $user = $this->profileService->getPortfolioData($user);
        return view('portfolio.index', compact('user'));
    }

    public function manage()
    {
        $data = $this->profileService->getManagementData(Auth::user());
        return view('portfolio.manage', $data);
    }

    public function updateBio(Request $request)
    {
        $this->profileService->updateBio($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updateProfilePicture(Request $request)
    {
        $this->profileService->updateProfilePicture($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function storePortfolio(Request $request)
    {
        $this->profileService->storePortfolio($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Proyek portofolio berhasil ditambahkan.');
    }

    public function destroyPortfolio(Portfolio $portfolio)
    {
        if ($portfolio->profile->user_id !== Auth::id()) {
            abort(403);
        }
        $this->profileService->destroyPortfolio($portfolio);
        return redirect()->route('portfolio.manage')->with('success', 'Proyek portofolio berhasil dihapus.');
    }

    public function storeExperience(Request $request)
    {
        $this->profileService->storeExperience($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    public function destroyExperience(Experience $experience)
    {
        if ($experience->profile->user_id !== Auth::id()) {
            abort(403);
        }
        $this->profileService->destroyExperience($experience);
        return redirect()->route('portfolio.manage')->with('success', 'Pengalaman kerja berhasil dihapus.');
    }

    public function storeEducation(Request $request)
    {
        $this->profileService->storeEducation($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    public function destroyEducation(Education $education)
    {
        if ($education->profile->user_id !== Auth::id()) {
            abort(403);
        }
        $this->profileService->destroyEducation($education);
        return redirect()->route('portfolio.manage')->with('success', 'Pendidikan berhasil dihapus.');
    }
    
    public function storeCertification(Request $request)
    {
        $this->profileService->storeCertification($request, Auth::user()->profile);
        return redirect()->route('portfolio.manage')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function destroyCertification(Certification $certification)
    {
        if ($certification->profile->user_id !== Auth::id()) {
            abort(403);
        }
        $this->profileService->destroyCertification($certification);
        return redirect()->route('portfolio.manage')->with('success', 'Sertifikat berhasil dihapus.');
    }
}

