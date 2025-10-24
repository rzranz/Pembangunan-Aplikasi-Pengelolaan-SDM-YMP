<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // <-- Tambahkan ini

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user()->profile;
        $portfolios = $profile->portfolios()->latest()->get();
        return view('portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for managing portfolio items.
     */
    public function manage() 
    {
        $profile = Auth::user()->profile;
        $portfolios = $profile->portfolios()->latest()->get();
        return view('portfolio.manage', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'skills_used' => 'required|string',
            'project_url' => 'nullable|url',
        ]);

        $profile = Auth::user()->profile;
        $profile->portfolios()->create($request->all());

        return redirect()->route('portfolio.manage')->with('success', 'Portofolio berhasil ditambahkan.');
    }
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->profile->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $portfolio->delete();
        return redirect()->route('portfolio.manage')->with('success', 'Portofolio berhasil dihapus.');
    }
}
