<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Bento Grid untuk Statistik Interaktif --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                {{-- Kartu Utama: Total Anggota (lebih besar dan bisa diklik) --}}
                <a href="{{ route('admin.members.index') }}" class="group sm:col-span-2 lg:col-span-2 p-6 bg-white dark:bg-gray-800/50 dark:hover:bg-gray-700/50 overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-400">Total Anggota Terdaftar</h3>
                            <p class="mt-1 text-5xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalMembers }}</p>
                        </div>
                        <div class="p-2 bg-indigo-500/10 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                    </div>
                </a>

                {{-- Kartu Statistik Kategori (lebih kecil dan bisa diklik) --}}
                @foreach ($categoryStats as $stat)
                    <a href="{{ route('admin.members.index', ['category_id' => $stat->id]) }}" class="group p-6 bg-white dark:bg-gray-800/50 dark:hover:bg-gray-700/50 overflow-hidden shadow-sm sm:rounded-lg transition-all duration-300">
                         <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-base font-medium text-gray-500 dark:text-gray-400">{{ $stat->name }}</h3>
                                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $stat->profiles_count }}</p>
                            </div>
                             <div class="p-2 bg-gray-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" /></svg>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Bagian Galeri Anggota --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h3 class="text-xl font-semibold">Galeri Anggota</h3>
                        <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full md:w-1/3">
                            <div class="flex gap-2">
                                <input type="text" name="search" id="search" value="{{ $searchQuery ?? '' }}" placeholder="Cari nama anggota..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">Cari</button>
                            </div>
                        </form>
                    </div>

                    @if($showcasedMembers->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach ($showcasedMembers as $member)
                                <a href="{{ route('public.portfolio.show', $member) }}" class="block group">
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg overflow-hidden shadow transition-transform duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                        <img src="{{ $member->profile->profile_picture ? Storage::url($member->profile->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&color=7F9CF5&background=EBF4FF' }}"
                                             alt="Foto profil {{ $member->name }}"
                                             class="w-full h-40 object-cover bg-gray-300 dark:bg-gray-600">
                                        
                                        <div class="p-4">
                                            <h4 class="font-bold text-lg text-gray-900 dark:text-white truncate">{{ $member->name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member->profile->category->name ?? 'Belum ada kategori' }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $showcasedMembers->appends(request()->query())->links() }}
                        </div>
                        
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400">Tidak ada anggota yang ditemukan dengan nama tersebut.</p>
                             @if($searchQuery)
                                <a href="{{ route('admin.dashboard') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">Reset Pencarian</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

