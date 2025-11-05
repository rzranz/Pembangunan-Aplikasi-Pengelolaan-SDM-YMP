<div x-data="{ open: false }">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-lg font-medium text-gray-100">
                Portofolio Proyek
            </h2>
            <p class="mt-1 text-sm text-gray-400">
                Pamerkan proyek-proyek yang pernah Anda kerjakan.
            </p>
        </div>
        <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
            <span x-show="!open">Tambah Baru</span>
            <span x-show="open">Tutup Form</span>
        </button>
    </div>

    <!-- Form Tambah Baru (Collapsible) -->
    <div x-show="open" x-transition class="mt-6 border-t border-gray-700 pt-6">
        <form method="post" action="{{ route('portfolio.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="portfolio_title" class="block mb-2 text-sm font-medium text-gray-300">Judul Proyek</label>
                <x-text-input id="portfolio_title" name="title" type="text" class="mt-1 block w-full" required />
            </div>
            <div>
                <label for="portfolio_description" class="block mb-2 text-sm font-medium text-gray-300">Deskripsi</label>
                <textarea id="portfolio_description" name="description" rows="4" class="border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm block w-full" required></textarea>
            </div>
            <div>
                <label for="portfolio_skills" class="block mb-2 text-sm font-medium text-gray-300">Keahlian (pisahkan dengan koma)</label>
                <x-text-input id="portfolio_skills" name="skills_used" type="text" class="mt-1 block w-full" placeholder="Contoh: Laravel, Tailwind CSS" required />
            </div>
             <div>
                <label for="portfolio_url" class="block mb-2 text-sm font-medium text-gray-300">URL Proyek (Opsional)</label>
                <x-text-input id="portfolio_url" name="project_url" type="url" class="mt-1 block w-full" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Simpan Proyek') }}</x-primary-button>
            </div>
        </form>
    </div>

    <!-- Daftar Item yang Sudah Ada -->
    <div class="mt-6 border-t border-gray-700">
        <h3 class="text-md font-medium text-gray-200 pt-6">Daftar Proyek Anda</h3>
        <div class="mt-4 space-y-4">
            @forelse ($portfolios as $item)
                <div class="flex justify-between items-center p-4 border border-gray-700 rounded-lg">
                    <div>
                        <p class="font-bold text-white">{{ $item->title }}</p>
                        <p class="text-sm text-gray-400">{{ Str::limit($item->description, 100) }}</p>
                    </div>
                    <form action="{{ route('portfolio.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-400 text-sm" onclick="return confirm('Yakin ingin menghapus proyek ini?')">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada proyek ditambahkan.</p>
            @endforelse
        </div>
    </div>
</div>

