<section>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Pratinjau Foto Profil --}}
        <div class="md:col-span-1">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Foto Profil Saat Ini
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ini adalah foto yang ditampilkan di profil publik Anda.
            </p>
            <div class="mt-6">
                {{-- Menggunakan komponen x-profile-image untuk menampilkan foto --}}
                <x-profile-image :user="Auth::user()" class="w-48 h-48 rounded-lg object-cover mx-auto md:mx-0 shadow-md" />
            </div>
        </div>

        {{-- Kolom Kanan: Form Interaktif untuk Memperbarui Foto --}}
        <div class="md:col-span-2">
            <div x-data="{ uploadType: 'file' }" class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Perbarui Foto Profil
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Pilih untuk mengunggah file dari perangkat Anda atau gunakan link gambar eksternal (misal: dari Google Drive).
                    </p>
                </header>

                <form method="post" action="{{ route('profile_picture.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="upload_type" x-bind:value="uploadType">

                    <div class="flex border-b border-gray-200 dark:border-gray-700">
                        <button type="button" @click="uploadType = 'file'"
                            :class="uploadType === 'file' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                            class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 ease-in-out">
                            Unggah File
                        </button>
                        <button type="button" @click="uploadType = 'url'"
                            :class="uploadType === 'url' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600'"
                            class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 ease-in-out">
                            Gunakan URL
                        </button>
                    </div>

                    <div x-show="uploadType === 'file'" class="space-y-2 pt-4">
                        <x-input-label for="profile_picture_file" :value="__('Pilih file gambar (maks: 2MB)')" />
                        {{-- 
                            PERBAIKAN: Ganti :disabled menjadi x-bind:disabled 
                            untuk menghindari konflik dengan Blade.
                        --}}
                        <x-text-input id="profile_picture_file" name="profile_picture_file" type="file" class="block w-full" x-bind:disabled="uploadType !== 'file'" />
                        <x-input-error class="mt-2" :messages="$errors->get('profile_picture_file')" />
                    </div>

                    <div x-show="uploadType === 'url'" class="space-y-2 pt-4">
                        <x-input-label for="profile_picture_url" :value="__('Masukkan URL Gambar')" />
                        {{-- 
                            PERBAIKAN: Ganti :disabled menjadi x-bind:disabled 
                            untuk menghindari konflik dengan Blade.
                        --}}
                        <x-text-input id="profile_picture_url" name="profile_picture_url" type="url" class="mt-1 block w-full" placeholder="https://..." :value="old('profile_picture_url', filter_var(Auth::user()->profile->profile_picture, FILTER_VALIDATE_URL) ? Auth::user()->profile->profile_picture : '')" x-bind:disabled="uploadType !== 'url'" />
                         <x-input-error class="mt-2" :messages="$errors->get('profile_picture_url')" />
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Simpan Foto') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>