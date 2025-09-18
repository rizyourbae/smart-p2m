<x-filament-panels::page>
    {{-- Form dibungkus secara manual --}}
    <form wire:submit.prevent="save" id="filament-reviewer-profile-form" class="space-y-6">
        {{ $this->form }}
        <div class="mt-6 flex justify-end">
            <x-filament::button type="submit" color="primary">
                Simpan
            </x-filament::button>

            <x-filament::button color="secondary" tag="a" :href="App\Filament\Reviewer\Pages\ReviewerProfile::getUrl()">
                Batal
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
