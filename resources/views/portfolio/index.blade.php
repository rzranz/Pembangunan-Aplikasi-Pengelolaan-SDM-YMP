<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profil Portofolio: {{ $user->name }}
            </h2>

            <div>
                @if(auth()->check())
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('portfolio.manage') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Kelola Profil
                        </a>
                    @elseif(auth()->user()->role !== 'anggota')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            &larr; Kembali ke Dashboard
                        </a>
                    @endif
                @endif
            </div>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($user->profile)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="flex items-start space-x-6">

                                @php
                                    $picture = $user->profile->profile_picture;
                                    $fallbackAvatar = 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=7F9CF5&background=EBF4FF';

                                    if ($picture) {
                                        if (str_starts_with($picture, 'http')) {
                                            $imageUrl = $picture;
                                        } else {
                                            $imageUrl = Storage::url($picture);
                                        }
                                    } else {
                                        $imageUrl = $fallbackAvatar;
                                    }
                                @endphp

                                <img class="h-24 w-24 rounded-full object-cover" src="{{ $imageUrl }}" alt="{{ $user->name }}">

                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                                    <p class="text-md text-gray-600 dark:text-gray-300">{{ $user->profile->headline }}</p>

                                    <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-gray-500 dark:text-gray-400">
                                        {{-- Social Links --}}
                                        @if($user->profile->phone)
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                                <span class="text-sm">{{ $user->profile->phone }}</span>
                                            </div>
                                        @endif
                                        @if($user->profile->linkedin_url)
                                            <a href="{{ $user->profile->linkedin_url }}" target="_blank" class="hover:text-gray-900 dark:hover:text-white transition-colors flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                                <span class="text-sm hidden sm:inline">LinkedIn</span>
                                            </a>
                                        @endif
                                        @if($user->profile->github_url)
                                            <a href="{{ $user->profile->github_url }}" target="_blank" class="hover:text-gray-900 dark:hover:text-white transition-colors flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 2.486 0 2.861-1.42 5.221-5.467 5.931.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                                <span class="text-sm hidden sm:inline">GitHub</span>
                                            </a>
                                        @endif
                                         @if($user->profile->portfolio_url)
                                            <a href="{{ $user->profile->portfolio_url }}" target="_blank" class="hover:text-gray-900 dark:hover:text-white transition-colors flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                                <span class="text-sm">Portofolio</span>
                                            </a>
                                        @endif
                                    </div>

                                    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->profile->bio ?? 'Belum ada deskripsi diri. Tambahkan di halaman Kelola Profil.'}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                             <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                 Pengalaman Kerja
                             </h2>
                             <div class="border-t border-gray-200 dark:border-gray-700">
                                 @forelse ($user->profile->experiences as $item)
                                     <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                                         <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->title }}</h3>
                                         <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->company_name }}</p>
                                         <p class="text-xs text-gray-500 dark:text-gray-500">{{ \Carbon\Carbon::parse($item->start_date)->format('F Y') }} - {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('F Y') : 'Saat ini' }}</p>
                                         <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $item->description }}</p>
                                     </div>
                                 @empty
                                     <p class="text-gray-500 dark:text-gray-400 pt-4">Belum ada pengalaman kerja ditambahkan.</p>
                                 @endforelse
                             </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                             <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                 Pendidikan
                             </h2>
                             <div class="border-t border-gray-200 dark:border-gray-700">
                                 @forelse ($user->profile->educations as $item)
                                     <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                                         <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->institution_name }}</h3>
                                         <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->degree }}</p>
                                          <p class="text-xs text-gray-500 dark:text-gray-500">{{ \Carbon\Carbon::parse($item->start_date)->format('Y') }} - {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('Y') : 'Lulus' }}</p>
                                     </div>
                                 @empty
                                     <p class="text-gray-500 dark:text-gray-400 pt-4">Belum ada riwayat pendidikan ditambahkan.</p>
                                 @endforelse
                             </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                             <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                 Lisensi & Sertifikat
                             </h2>
                             <div class="border-t border-gray-200 dark:border-gray-700">
                                 @forelse ($user->profile->certifications as $item)
                                     <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                                         <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->title }}</h3>
                                         <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item->issuing_organization }}</p>
                                         <p class="text-xs text-gray-500 dark:text-gray-500">Diterbitkan {{ \Carbon\Carbon::parse($item->issue_date)->format('F Y') }}</p>

                                         @if ($item->file_path && Storage::disk('public')->exists($item->file_path))
                                             @php
                                                 $filePath = $item->file_path;
                                                 $fileUrl = Storage::url($filePath);
                                                 $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                                 $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif']);
                                                 $isPdf = $extension === 'pdf';
                                             @endphp

                                             @if ($isImage)
                                                 <div class="mt-3"> {{-- Hapus border, rounded, overflow --}}
                                                     <a href="{{ $fileUrl }}" target="_blank">
                                                         {{-- PERBAIKAN: Hapus w-full, tambahkan inline-block, rounded-lg di img --}}
                                                         <img src="{{ $fileUrl }}" alt="Sertifikat {{ $item->title }}" class="inline-block h-72 object-contain hover:opacity-90 transition-opacity bg-gray-50 dark:bg-gray-900 p-2 rounded-lg">
                                                     </a>
                                                 </div>
                                             @elseif ($isPdf)
                                                 {{-- Tampilan PDF kembali seperti semula, tapi tambahkan border & rounded --}}
                                                 <div class="mt-3 p-4 bg-gray-50 dark:bg-gray-900/50 flex items-center space-x-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                     </svg>
                                                     <div class="flex-grow">
                                                         <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $item->title }}</p>
                                                         <a href="{{ $fileUrl }}" target="_blank" class="text-sm text-indigo-500 dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300">Lihat Sertifikat (PDF) &rarr;</a>
                                                     </div>
                                                 </div>
                                             @else
                                                 {{-- Tampilan file generik kembali seperti semula, tapi tambahkan border & rounded --}}
                                                 <div class="mt-3 p-4 bg-gray-50 dark:bg-gray-900/50 flex items-center space-x-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500 dark:text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0011.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                      </svg>
                                                      <div class="flex-grow">
                                                          <p class="font-semibold text-gray-700 dark:text-gray-200">{{ basename($filePath) }}</p>
                                                          <a href="{{ $fileUrl }}" target="_blank" class="text-sm text-indigo-500 dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300">Lihat File &rarr;</a>
                                                      </div>
                                                 </div>
                                             @endif
                                         @elseif ($item->credential_url)
                                             <a href="{{ $item->credential_url }}" target="_blank" class="text-sm text-indigo-500 dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300 mt-2 inline-block">Lihat Kredensial &rarr;</a>
                                         @else
                                             <p class="mt-2 text-xs text-gray-400 dark:text-gray-500 italic">Tidak ada bukti kredensial yang dilampirkan.</p>
                                         @endif
                                     </div>
                                 @empty
                                     <p class="text-gray-500 dark:text-gray-400 pt-4">Belum ada sertifikat ditambahkan.</p>
                                 @endforelse
                             </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                             <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                                 Proyek Portofolio
                             </h2>
                             <div class="border-t border-gray-200 dark:border-gray-700">
                                 @forelse ($user->profile->portfolios as $item)
                                     <div class="py-4 border-b border-gray-200 dark:border-gray-700">
                                         <h3 class="font-bold text-gray-900 dark:text-white text-lg">{{ $item->title }}</h3>
                                         <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $item->description }}</p>
                                         @if($item->project_url)
                                             <a href="{{ $item->project_url }}" target="_blank" class="text-sm text-indigo-500 dark:text-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-300 mt-2 inline-block">Lihat Proyek &rarr;</a>
                                         @endif
                                         <div class="mt-3">
                                             @foreach(explode(',', $item->skills_used) as $skill)
                                                 <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full px-3 py-1 text-xs font-semibold mr-2 mb-2">{{ trim($skill) }}</span>
                                             @endforeach
                                         </div>
                                     </div>
                                 @empty
                                     <p class="text-gray-500 dark:text-gray-400 pt-4">Belum ada portofolio ditambahkan.</p>
                                 @endforelse
                             </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                        Pengguna ini belum membuat profil portofolio.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>