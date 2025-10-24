<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $query = User::where('role', 'anggota')->with('profile.category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        
        $members = $query->latest()->paginate(8);
        
        $totalMembers = User::where('role', 'anggota')->count();

        return view('admin.members.index', [
            'members' => $members,
            'totalMembers' => $totalMembers,
            'categories' => $categories,
            'selectedCategory' => $request->category_id,
            'searchQuery' => $request->search
        ]);
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.members.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'anggota',
            ]);

            Profile::create([
                'user_id' => $user->id,
                'category_id' => $request->category_id,
            ]);
        });
        
        return redirect()->route('admin.members.index')->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    public function edit(User $member)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.members.edit', compact('member', 'categories'));
    }

    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($member->id)],
            'category_id' => ['required', 'exists:categories,id'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
    
        DB::transaction(function () use ($request, $member) {
            $member->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            if ($request->filled('password')) {
                $member->update(['password' => Hash::make($request->password)]);
            }
    
            $member->profile()->update([
                'category_id' => $request->category_id,
            ]);
        });
        
        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(User $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}

