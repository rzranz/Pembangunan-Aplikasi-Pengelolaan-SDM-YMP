{{-- BAGIAN LISENSI & SERTIFIKAT --}}
<div x-data="{ open: false }">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-lg font-medium text-gray-100">
                Lisensi & Sertifikat
            </h2>
            <p class="mt-1 text-sm text-gray-400">
                Tambahkan sertifikat relevan yang Anda miliki.
            </p>
        </div>
        <button @click="open = !open" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
            <span x-show="!open">Tambah Baru</span>
            <span x-show="open">Tutup Form</span>
        </button>
    </div>

    {{-- FORM TAMBAH BARU (disembunyikan secara default) --}}
    <div x-show="open" x-collapse class="border-t border-gray-700 pt-4">
        <form method="post" action="{{ route('certification.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="cert_title" class="block mb-2 text-sm font-medium text-gray-300">Nama Sertifikat</label>
                <x-text-input id="cert_title" name="title" type="text" class="mt-1 block w-full" required />
            </div>
            <div>
                <label for="issuing_organization" class="block mb-2 text-sm font-medium text-gray-300">Organisasi Penerbit</label>
                <x-text-input id="issuing_organization" name="issuing_organization" type="text" class="mt-1 block w-full" required />
            </div>
            <div>
                <label for="issue_date" class="block mb-2 text-sm font-medium text-gray-300">Tanggal Terbit</label>
                <x-text-input id="issue_date" name="issue_date" type="date" class="mt-1 block w-full" required />
            </div>

            <div>
                <label for="credential_url" class="block mb-2 text-sm font-medium text-gray-300">URL Kredensial (Opsional)</label>
                <x-text-input id="credential_url" name="credential_url" type="url" class="mt-1 block w-full" placeholder="https://linkedin.com/credential/..." />
            </div>

            <div>
                <label for="file" class="block mb-2 text-sm font-medium text-gray-300">Unggah File (Opsional - JPG, PNG, PDF)</label>
                <input id="file" name="file" type="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-gray-300 hover:file:bg-gray-600"/>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Simpan Sertifikat') }}</x-primary-button>
            </div>
        </form>
    </div>

    {{-- DAFTAR SERTIFIKAT YANG SUDAH ADA --}}
    <div class="mt-6 border-t border-gray-700">
        @forelse ($certifications as $item)
            <div class="py-4 border-b border-gray-700 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    {{-- Ikon penanda adanya bukti --}}
                    @if($item->credential_url || $item->file_path)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    @endif
                    <div>
                        <h3 class="font-bold text-white">{{ $item->title }}</h3>
                        <p class="text-sm text-gray-300">{{ $item->issuing_organization }} - <span class="text-xs text-gray-500">Diterbitkan {{ \Carbon\Carbon::parse($item->issue_date)->format('F Y') }}</span></p>
                    </div>
                </div>
                <form action="{{ route('certification.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-400 text-sm font-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus sertifikat ini?')">Hapus</button>
                </form>
            </div>
        @empty
            <p class="text-gray-400 pt-4">Belum ada sertifikat ditambahkan.</p>
        @endforelse
    </div>
</div>

