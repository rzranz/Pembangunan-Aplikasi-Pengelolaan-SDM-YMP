<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalMembers = User::where('role', 'anggota')->count();

        $showcasedQuery = User::where('role', 'anggota')
                                ->has('profile')
                                ->with('profile.category');

        if ($request->filled('search')) {
            $showcasedQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $showcasedMembers = $showcasedQuery->latest()->paginate(8);

        $categoryStats = Category::withCount('profiles')->get();

        return view('dashboard', [
            'totalMembers' => $totalMembers,
            'showcasedMembers' => $showcasedMembers,
            'searchQuery' => $request->search,
            'categoryStats' => $categoryStats, 
        ]);
    }
}

