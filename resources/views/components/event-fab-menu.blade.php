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

<div x-data="{ 
    fabOpen: false, 
    qrFullscreen: false,
    touchStartX: 0,
    touchStartY: 0,
    handleTouchStart(e) {
        this.touchStartX = e.changedTouches[0].screenX;
        this.touchStartY = e.changedTouches[0].screenY;
    },
    handleTouchMove(e) {
        const currentX = e.changedTouches[0].screenX;
        const currentY = e.changedTouches[0].screenY;
        const diffX = currentX - this.touchStartX;
        const diffY = currentY - this.touchStartY;
        
        // If movement is horizontal, block browser history navigation swipe
        if (Math.abs(diffX) > Math.abs(diffY)) {
            if (e.cancelable) {
                e.preventDefault();
            }
        }
    }
}" x-effect="
    document.body.classList.toggle('overflow-hidden', fabOpen);
    document.documentElement.classList.toggle('overflow-hidden', fabOpen);
" class="fixed top-[90px] right-6 z-[60]">
    <!-- FAB Button -->
    <button @click="fabOpen = true" 
            class="flex items-center justify-center w-14 h-14 rounded-full shadow-[0_8px_20px_rgba(232,200,74,0.4)] transition-transform hover:scale-110 active:scale-95"
            style="background: #FFE381; color: #1C1410; border: 1px solid rgba(232,200,74,0.6);">
        <i data-lucide="qr-code" class="w-7 h-7"></i>
    </button>

    <!-- Overlay -->
    <div x-show="fabOpen" 
         x-transition.opacity.duration.300ms
         @click="fabOpen = false"
         @touchmove.prevent
         class="fixed inset-0 bg-black/50 z-40 backdrop-blur-sm"
         style="display: none;"></div>

    <!-- Drawer -->
    <div x-show="fabOpen"
         @touchstart="handleTouchStart($event)"
         @touchmove="handleTouchMove($event)"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-[100dvh] w-2/3 md:w-[450px] bg-[#FFFBEA] z-50 shadow-2xl overflow-y-auto flex flex-col"
         style="display: none; border-left: 1px solid rgba(255,227,129,0.5);">
         
        <div class="flex items-center justify-between p-6 border-b sticky top-0 z-10" style="border-color: rgba(255,227,129,0.5); background: rgba(255,248,208,0.97); backdrop-filter: blur(8px);">
            <h3 class="font-['Barlow_Condensed'] text-2xl font-black uppercase text-[#1C1410]">Khám phá thêm</h3>
            <button @click="fabOpen = false" class="p-2 rounded-full hover:bg-[#FFE381]/50 transition-colors text-[#1C1410]">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="p-6 space-y-10 flex-1">
            @if($currentEvent)
            <div>
                <h4 class="font-['Barlow_Condensed'] text-xl font-bold uppercase text-[#1C1410] mb-5 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#07A0C3] text-[28px]">qr_code_2</span>
                    Mã QR Sự kiện
                </h4>
                <div class="bg-white p-4 rounded-xl border border-slate-200 text-center shadow-sm">
                    <div class="relative inline-block cursor-pointer group" @click="qrFullscreen = true">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(route('events.show', $currentEvent->slug)) }}" alt="QR Code" class="mx-auto w-32 h-32 rounded-lg mb-3 border border-slate-100 transition-transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/40 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity mb-3">
                            <span class="material-symbols-outlined text-white text-3xl drop-shadow-md">zoom_in</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 mb-3">Quét mã để truy cập nhanh hoặc chia sẻ sự kiện này với bạn bè.</p>
                    <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ urlencode(route('events.show', $currentEvent->slug)) }}" download="QR_Event.png" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-[#07A0C3] text-white rounded-lg font-semibold text-sm hover:bg-[#068ba8] transition-colors">
                        <i data-lucide="download" class="w-4 h-4"></i> Tải mã QR
                    </a>
                </div>
            </div>
            @endif

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
    <!-- QR Fullscreen Modal -->
    <div x-show="qrFullscreen" 
         x-transition.opacity
         class="fixed inset-0 z-[100] bg-black/80 flex items-center justify-center backdrop-blur-md"
         style="display: none;">
        <button @click="qrFullscreen = false" class="absolute top-6 right-6 text-white hover:text-[#FFE381] transition-colors p-2">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        @if($currentEvent)
        <div class="bg-white p-8 rounded-3xl shadow-2xl text-center max-w-sm mx-4 transform transition-all" @click.away="qrFullscreen = false">
            <h3 class="font-['Barlow_Condensed'] text-2xl font-black uppercase text-[#1C1410] mb-6">Quét mã QR</h3>
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 mb-6 inline-block">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ urlencode(route('events.show', $currentEvent->slug)) }}" alt="QR Code" class="w-64 h-64 object-contain">
            </div>
            <p class="text-slate-600 mb-8 font-medium">Sử dụng camera điện thoại hoặc ứng dụng quét mã để truy cập.</p>
            <a href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data={{ urlencode(route('events.show', $currentEvent->slug)) }}" download="QR_Event.png" target="_blank" class="inline-flex w-full justify-center items-center gap-2 px-6 py-3.5 bg-[#07A0C3] text-white rounded-xl font-bold hover:bg-[#068ba8] transition-colors shadow-lg shadow-[#07A0C3]/30">
                <i data-lucide="download" class="w-5 h-5"></i> Tải ảnh xuống
            </a>
        </div>
        @endif
    </div>
</div>
