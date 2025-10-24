<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Kelola Profil Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Menampilkan pesan sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-600 border border-green-500 text-white px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- BAGIAN FOTO PROFIL -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-picture-section')
            </div>

            <!-- BAGIAN DESKRIPSI DIRI (BIO) -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-bio-section')
            </div>
            
            <!-- BAGIAN SERTIFIKAT -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-certifications-section')
            </div>

            <!-- BAGIAN PORTOFOLIO PROYEK -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-portfolio-section')
            </div>

            <!-- BAGIAN PENGALAMAN KERJA -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-experience-section')
            </div>

            <!-- BAGIAN PENDIDIKAN -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                @include('portfolio.partials.manage-education-section')
            </div>
        </div>
    </div>
</x-app-layout>

