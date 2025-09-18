@php
    $proposal = $getRecord();
    $abstrakAsli = $proposal->abstrak;
    $substansiAsli = collect($proposal->substansi ?? []);
    $semuaReview = $proposal->reviews;
@endphp

<div class="space-y-8">

    {{-- ====================================================================== --}}
    {{--                     BLOK KHUSUS UNTUK ABSTRAK                          --}}
    {{-- ====================================================================== --}}
    <div class="p-4 border border-gray-200 rounded-lg dark:border-gray-700">
        {{-- 1. Tampilkan Abstrak Asli dari Dosen --}}
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Abstrak</h3>
            <div class="prose dark:prose-invert max-w-none mt-2 text-gray-600 dark:text-gray-400 text-justify">
                {!! $abstrakAsli ?? '<p><i>Tidak ada isian abstrak.</i></p>' !!}
            </div>
        </div>
        <hr class="border-gray-200 dark:border-gray-700">
        {{-- 2. Tampilkan Komentar Abstrak dari Setiap Reviewer --}}
        <div class="mt-4 space-y-4">
            <h4 class="font-semibold text-gray-800 dark:text-gray-200">Masukan dari Reviewer untuk Abstrak:</h4>
            @forelse ($semuaReview as $reviewIndex => $review)
                @php $komentar = $review->komentar_substansi['abstrak'] ?? null; @endphp
                <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                    <h5 class="font-bold text-sm text-primary-600 dark:text-primary-400">Reviewer {{ $reviewIndex + 1 }}
                    </h5>
                    <div class="prose prose-sm dark:prose-invert max-w-none mt-1">
                        {!! $komentar ?? '<p><em>Reviewer Belum Memberikan Komentar.</em></p>' !!}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada data review.</p>
            @endforelse
        </div>
    </div>

    {{-- ====================================================================== --}}
    {{--                  LOOPING UNTUK ISI SUBSTANSI LAINNYA                   --}}
    {{-- ====================================================================== --}}
    @forelse ($substansiAsli as $bagian)
        <div class="p-4 border border-gray-200 rounded-lg dark:border-gray-700">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    {{ $bagian['judul_bagian'] ?? 'Tanpa Judul' }}</h3>
                <div class="prose dark:prose-invert max-w-none mt-2 text-gray-600 dark:text-gray-400 text-justify">
                    {!! $bagian['isi_bagian'] ?? '<p><i>Tidak ada isian.</i></p>' !!}
                </div>
            </div>
            <hr class="border-gray-200 dark:border-gray-700">
            <div class="mt-4 space-y-4">
                <h4 class="font-semibold text-gray-800 dark:text-gray-200">Masukan dari Reviewer:</h4>
                @forelse ($semuaReview as $reviewIndex => $review)
                    @php
                        $komentar = null;
                        if (!empty($review->komentar_substansi)) {
                            $komentarData = collect($review->komentar_substansi)->firstWhere(
                                'judul_asli',
                                $bagian['judul_bagian'] ?? '',
                            );
                            $komentar = $komentarData['komentar'] ?? null;
                        }
                    @endphp
                    <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                        <h5 class="font-bold text-sm text-primary-600 dark:text-primary-400">Reviewer
                            {{ $reviewIndex + 1 }}</h5>
                        <div class="prose prose-sm dark:prose-invert max-w-none mt-1">
                            {!! $komentar ?? '<p><em>Reviewer Belum Memberikan Komentar.</em></p>' !!}
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada data review.</p>
                @endforelse
            </div>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400">Proposal ini tidak memiliki isian substansi tambahan.</p>
    @endforelse

    {{-- ====================================================================== --}}
    {{--            [INI BAGIAN BARUNYA] KOMENTAR UMUM PROPOSAL                 --}}
    {{-- ====================================================================== --}}
    <div class="p-4 border border-gray-200 rounded-lg dark:border-gray-700">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Komentar Umum Proposal</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Ringkasan dan masukan umum dari setiap reviewer terhadap proposal secara keseluruhan.
            </p>
        </div>

        <hr class="border-gray-200 dark:border-gray-700">

        <div class="mt-4 space-y-4">
            @forelse ($semuaReview as $reviewIndex => $review)
                <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                    <h5 class="font-bold text-sm text-primary-600 dark:text-primary-400">Reviewer {{ $reviewIndex + 1 }}
                    </h5>
                    <div class="prose prose-sm dark:prose-invert max-w-none mt-1">
                        {!! $review->komentar_proposal ?? '<p><em>Reviewer Belum Memberikan Komentar.</em></p>' !!}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada data komentar umum.</p>
            @endforelse
        </div>
    </div>

</div>
