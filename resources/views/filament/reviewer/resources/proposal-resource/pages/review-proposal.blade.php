<x-filament-panels::page>
    {{-- Kita tidak lagi butuh tag <form> di sini karena
        setiap aksi di dalam tab akan punya logikanya sendiri --}}

    {{-- Cukup render form-nya --}}

    {{ $this->form }}

    <div class="flex justify-end gap-x-3 mt-6">
        {{-- Tombol Batal/Kembali tetap di sini --}}
        <x-filament::button color="secondary" tag="a" :href="$this->getResource()::getUrl('index')">
            Kembali ke Daftar
        </x-filament::button>
    </div>
</x-filament-panels::page>
