<x-filament-widgets::widget class="!p-0">
    {{-- OUTER: gradient border pakai inline style (tidak tergantung Tailwind scan) --}}
    <div class="rounded-3xl"
        style="
            padding: 2px; /* tebal border gradasi */
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 45%, #10b981 100%);
            box-shadow: 0 10px 30px -10px rgba(16,185,129,.45);
        ">
        {{-- INNER: card dengan bg image + overlay + rounded + overflow hidden --}}
        <div class="relative rounded-3xl overflow-hidden" wire:poll.1s="pollTime">
            {{-- Background image --}}
            <div class="absolute inset-0"
                style="
                background-image: url('{{ asset('assets/img/bg.jpg') }}');
                background-size: cover;
                background-position: center;">
            </div>

            {{-- Overlay warna supaya teks kontras --}}
            <div class="absolute inset-0"
                style="background: linear-gradient(90deg, rgba(4,120,87,.75), rgba(5,150,105,.55), rgba(4,120,87,.75));">
            </div>

            {{-- Glossy highlight halus --}}
            <div class="absolute inset-0 pointer-events-none"
                style="background: radial-gradient(60% 60% at 50% 0%, rgba(255,255,255,.25) 0%, rgba(255,255,255,0) 70%);">
            </div>

            {{-- Hairline inner ring untuk depth --}}
            <div class="absolute inset-0 pointer-events-none" style="box-shadow: inset 0 0 0 1px rgba(255,255,255,.1)">
            </div>

            {{-- CONTENT --}}
            <div class="relative z-10 p-6 md:p-8 text-white flex items-center justify-between gap-6">
                <div class="min-w-0">
                    <h2 class="text-2xl md:text-3xl font-bold [text-shadow:_0_1px_3px_rgb(0_0_0_/_0.45)]">
                        {{ $greeting }}, {{ $userName }}! 👋
                    </h2>
                    <p class="mt-1 text-sm opacity-90 [text-shadow:_0_1px_2px_rgb(0_0_0_/_0.35)]">
                        {{ $currentDate }}
                    </p>
                </div>

                <div class="text-right shrink-0">
                    <p class="text-xs opacity-90 [text-shadow:_0_1px_2px_rgb(0_0_0_/_0.35)]">Waktu Saat Ini:</p>
                    <p class="text-3xl md:text-4xl font-mono font-bold [text-shadow:_0_1px_3px_rgb(0_0_0_/_0.45)]">
                        {{ $this->currentTime->format('H:i:s') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
