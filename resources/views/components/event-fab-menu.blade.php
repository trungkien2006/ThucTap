@php
    $currentEvent = $event ?? null;
    $relatedEvents = collect();
    $popularEvents = \App\Models\Event::where('is_published', true)->orderBy('views_count', 'desc')->take(4)->get();
    
    if($currentEvent && $currentEvent->category_id) {
        $relatedEvents = \App\Models\Event::where('category_id', $currentEvent->category_id)
            ->where('id', '!=', $currentEvent->id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }
@endphp

<div x-data="{ fabOpen: false }" class="fixed top-[90px] right-6 z-[60]">
    <!-- FAB Button -->
    <button @click="fabOpen = true" 
            class="flex items-center justify-center w-14 h-14 rounded-full shadow-[0_8px_20px_rgba(232,200,74,0.4)] transition-transform hover:scale-110 active:scale-95"
            style="background: #FFE381; color: #1C1410; border: 1px solid rgba(232,200,74,0.6);">
        <i data-lucide="menu" class="w-7 h-7"></i>
    </button>

    <!-- Overlay -->
    <div x-show="fabOpen" 
         x-transition.opacity.duration.300ms
         @click="fabOpen = false"
         class="fixed inset-0 bg-black/50 z-40 backdrop-blur-sm"
         style="display: none;"></div>

    <!-- Drawer -->
    <div x-show="fabOpen"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-[100dvh] w-full md:w-[450px] bg-[#FFFBEA] z-50 shadow-2xl overflow-y-auto flex flex-col"
         style="display: none; border-left: 1px solid rgba(255,227,129,0.5);">
         
        <div class="flex items-center justify-between p-6 border-b sticky top-0 z-10" style="border-color: rgba(255,227,129,0.5); background: rgba(255,248,208,0.97); backdrop-filter: blur(8px);">
            <h3 class="font-['Barlow_Condensed'] text-2xl font-black uppercase text-[#1C1410]">Khám phá thêm</h3>
            <button @click="fabOpen = false" class="p-2 rounded-full hover:bg-[#FFE381]/50 transition-colors text-[#1C1410]">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="p-6 space-y-10 flex-1">
            @if($relatedEvents->count() > 0)
            <div>
                <h4 class="font-['Barlow_Condensed'] text-xl font-bold uppercase text-[#1C1410] mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#07A0C3] text-[28px]">link</span>
                    Sự kiện liên quan
                </h4>
                <div class="grid grid-cols-1 gap-5">
                    @foreach($relatedEvents as $ev)
                        @include('components.fab-event-card', ['ev' => $ev])
                    @endforeach
                </div>
            </div>
            @endif

            @if($popularEvents->count() > 0)
            <div>
                <h4 class="font-['Barlow_Condensed'] text-xl font-bold uppercase text-[#1C1410] mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#07A0C3] text-[28px]">trending_up</span>
                    Sự kiện nổi bật
                </h4>
                <div class="grid grid-cols-1 gap-5">
                    @foreach($popularEvents as $ev)
                        @include('components.fab-event-card', ['ev' => $ev])
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
