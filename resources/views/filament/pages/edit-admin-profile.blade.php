<x-filament-panels::page>
    {{-- Form ini akan memiliki action yang memanggil method updateProfile() --}}
    <form wire:submit.prevent="updateProfile">
        {{ $this->form }}

        <div class="fi-form-actions mt-6">
            <x-filament::button type="submit">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
