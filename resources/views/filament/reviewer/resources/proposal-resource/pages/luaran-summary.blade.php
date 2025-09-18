@php
    $proposal = $getViewData()['record'];
@endphp

<div class="space-y-6">
    <x-filament::section>
        <x-slot name="heading">Verifikasi Luaran Penelitian</x-slot>
        {{-- Di sini Anda bisa menampilkan data luaran yang sudah di-upload oleh Dosen --}}
        {{-- Contoh: --}}
        <p class="text-sm">Silakan periksa luaran yang telah diunggah oleh peneliti dan berikan komentar umum Anda di
            bawah.</p>

        {{-- Anda bisa melakukan looping di sini untuk menampilkan daftar luaran dari relasi --}}
        {{-- @foreach ($proposal->outputs as $output) ... @endforeach --}}

        <div class="mt-4">
            <x-filament::button tag="a" href="#" size="sm" icon="heroicon-o-link">
                Lihat Publikasi/Outcomes
            </x-filament::button>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">Informasi Usulan</x-slot>
        <dl>
            <dt class="font-bold">Judul</dt>
            <dd class="mb-2">{{ $proposal->judul_usulan }}</dd>
            <dt class="font-bold">Pengusul</dt>
            <dd>{{ $proposal->lecturer->nama }}</dd>
        </dl>
    </x-filament::section>
</div>
