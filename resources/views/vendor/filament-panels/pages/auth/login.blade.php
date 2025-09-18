<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

    {{-- [MULAI KODE TAMBAHAN] Tambahkan kode ini di bagian bawah --}}
    <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-8 space-y-1">
        <p>
            &copy; {{ date('Y') }}
            <a href="#" class="text-primary-600 hover:underline">
                SMART-P2M
            </a>
        </p>
        <p>UPT TIPD</p>
        <p>UIN Sultan Aji Muhammad Idris Samarinda</p>
    </div>
    {{-- [AKHIR KODE TAMBAHAN] --}}

</x-filament-panels::page.simple>
