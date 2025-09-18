<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="flex items-center gap-x-3 mt-6">

            <x-filament::button type="submit">
                Simpan Perubahan
            </x-filament::button>

            <x-filament::button color="secondary" tag="a" :href="App\Filament\User\Pages\SintaProfile::getUrl()">
                Batal
            </x-filament::button>

        </div>
    </form>
</x-filament-panels::page>
