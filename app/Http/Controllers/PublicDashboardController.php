<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicDashboardController extends Controller
{
    public function index(Request $request)
    {
     
        $categories = Category::orderBy('name')->get();


        $query = User::where('role', 'anggota')
                        ->has('profile')
                        ->with(['profile.category']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        $members = $query->latest()->paginate(8);

      
        return view('public.index', [
            'members' => $members,
            'categories' => $categories,
            'selectedCategory' => $request->category_id,
            'searchQuery' => $request->search,
        ]);
    }
}

