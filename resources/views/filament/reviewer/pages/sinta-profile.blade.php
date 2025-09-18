<div> {{-- [PERBAIKAN] Tambahkan satu div pembungkus terluar --}}
    <x-filament-panels::page>
        <div class="space-y-6">
            {{-- ======================================================= --}}
            {{--                   BAGIAN HEADER PROFIL                  --}}
            {{-- ======================================================= --}}
            <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                {{-- Bagian Nama (Judul Utama) --}}
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white flex items-center">
                        {{ $this->record->name }}
                        <x-heroicon-s-check-badge class="h-6 w-6 text-blue-500 ml-2" />
                    </h2>
                </div>

                {{-- [INI PERBAIKANNYA] Bagian Detail (dibuat horizontal) --}}
                <div
                    class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-4">

                    <div class="flex items-center">
                        <x-heroicon-s-map-pin class="h-5 w-5 mr-2" />
                        <span>Universitas Islam Negeri Sultan Aji Muhammad Idris Samarinda</span>
                    </div>

                </div>
            </div>

            {{-- ======================================================= --}}
            {{--             BAGIAN DETAIL AKADEMIK (3 KARTU)            --}}
            {{-- ======================================================= --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Kartu Unit Kerja --}}
                <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-building-office-2 class="h-6 w-6 text-gray-400" />
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Unit Kerja</h3>
                    </div>
                    <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $this->record->unit ?? '-' }}
                    </p>
                </div>

                {{-- Kartu Pendidikan Terakhir --}}
                <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800">
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-academic-cap class="h-6 w-6 text-gray-400" />
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendidikan Terakhir</h3>
                    </div>
                    @if ($this->highestEducation)
                        <p class="mt-2 text-m font-semibold text-gray-900 dark:text-white truncate">
                            {{ $this->highestEducation->jenjang }} &mdash; {{ $this->highestEducation->program_studi }}
                        </p>
                    @else
                        <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">-</p>
                    @endif
                </div>

                {{-- Kartu SINTA --}}
                <div class="p-6 bg-white rounded-xl shadow-sm dark:bg-gray-800 flex flex-col justify-between">
                    {{-- Bagian Atas: Label dan Ikon --}}
                    <div class="flex items-center space-x-3">
                        <x-heroicon-o-identification class="h-6 w-6 text-gray-400" />
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">SINTA ID</h3>
                    </div>

                    {{-- [INI PERBAIKANNYA] Bagian Bawah: ID dan Link --}}
                    <div class="mt-2">
                        @if ($this->record->sinta_id)
                            <div class="flex items-baseline space-x-2">
                                {{-- ID SINTA dibuat besar dan tebal --}}
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $this->record->sinta_id }}
                                </p>

                                {{-- Link 'Lihat Profil' hanya muncul jika URL-nya ada --}}
                                @if (!empty($this->record->sinta_profile_link))
                                    <a href="{{ $this->record->sinta_profile_link }}" target="_blank"
                                        class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-400 flex items-center">
                                        <span></span>
                                        <x-heroicon-s-arrow-top-right-on-square class="h-4 w-4 ml-1" />
                                    </a>
                                @endif
                            </div>
                        @else
                            {{-- Tampilkan strip jika SINTA ID belum diisi --}}
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">-</p>
                        @endif
                    </div>
                </div>

            </div>

            {{-- ======================================================= --}}
            {{--                  BAGIAN KARTU STATISTIK                 --}}
            {{-- ======================================================= --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- SINTA Score Overall --}}
                <div class="p-4 bg-white rounded-xl shadow-sm dark:bg-gray-800 flex items-center space-x-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-yellow-100 dark:bg-yellow-500/20 rounded-lg">
                        <x-heroicon-o-user class="h-6 w-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">SINTA Score Overall</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $this->record->sinta_score_all_years ?? 0 }}
                        </p>
                    </div>
                </div>

                {{-- SINTA Score 3Yr --}}
                <div class="p-4 bg-white rounded-xl shadow-sm dark:bg-gray-800 flex items-center space-x-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-yellow-100 dark:bg-yellow-500/20 rounded-lg">
                        <x-heroicon-o-academic-cap class="h-6 w-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">SINTA Score 3Yr</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $this->record->sinta_score_3_years ?? 0 }}
                        </p>
                    </div>
                </div>

                {{-- Affil Score (Placeholder) --}}
                <div class="p-4 bg-white rounded-xl shadow-sm dark:bg-gray-800 flex items-center space-x-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-gray-200 dark:bg-gray-500/20 rounded-lg">
                        <x-heroicon-o-clipboard-document-list class="h-6 w-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Affil Score</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $this->record->sinta_affiliation_all_years ?? 0 }}
                        </p>
                    </div>
                </div>

                {{-- Affil Score 3Yr (Placeholder) --}}
                <div class="p-4 bg-white rounded-xl shadow-sm dark:bg-gray-800 flex items-center space-x-4">
                    <div
                        class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <x-heroicon-o-chart-bar-square class="h-6 w-6 text-gray-600 dark:text-gray-400" />
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Affil Score 3Yr</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $this->record->sinta_affiliation_3_years ?? 0 }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </x-filament-panels::page>
</div> {{-- [PERBAIKAN] Penutup div pembungkus terluar --}}
