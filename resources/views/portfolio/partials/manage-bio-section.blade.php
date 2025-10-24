<div x-data="{ open: false }">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-lg font-medium text-gray-100">
                Informasi Utama & Bio
            </h2>
            <p class="mt-1 text-sm text-gray-400">
                Perbarui informasi dasar dan kontak profesional Anda.
            </p>
        </div>
        <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
            <span x-show="!open">Edit</span>
            <span x-show="open">Tutup</span>
        </button>
    </div>

    <div x-show="open" x-collapse class="mt-6 border-t border-gray-700 pt-6">
        <form method="post" action="{{ route('bio.update') }}" class="space-y-6">
            @csrf
            @method('patch')

            <div>
                <label for="headline" class="block mb-2 text-sm font-medium text-gray-300">Headline</label>
                <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full" :value="old('headline', $profile->headline)" />
            </div>

            <div>
                <label for="bio" class="block mb-2 text-sm font-medium text-gray-300">Deskripsi Diri (Bio)</label>
                <textarea id="bio" name="bio" rows="4" class="border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm block w-full">{{ old('bio', $profile->bio) }}</textarea>
            </div>
            
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-300">Nomor Telepon</label>
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $profile->phone)" />
            </div>

            <div>
                <label for="linkedin_url" class="block mb-2 text-sm font-medium text-gray-300">URL LinkedIn</label>
                <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $profile->linkedin_url)" placeholder="https://www.linkedin.com/in/..." />
            </div>

            <div>
                <label for="github_url" class="block mb-2 text-sm font-medium text-gray-300">URL GitHub</label>
                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $profile->github_url)" placeholder="https://github.com/..." />
            </div>

            <div>
                <label for="portfolio_url" class="block mb-2 text-sm font-medium text-gray-300">URL Portofolio Pribadi</label>
                <x-text-input id="portfolio_url" name="portfolio_url" type="url" class="mt-1 block w-full" :value="old('portfolio_url', $profile->portfolio_url)" placeholder="https://website-pribadi.com" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>

