{{--
    Partial: frontend.upcoming
    Hiển thị danh sách sự kiện sắp diễn ra (Upcoming Events)
    Dữ liệu $upcoming được truyền từ FrontendController@home
    Mỗi item: slug, name, date, summary, status, open, images[]
--}}
<section id="upcoming-events" class="relative z-10 w-full pt-10 lg:pt-14 pb-16"
    style="background: #FFFBEA;">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">

        {{-- Section Header --}}
        <div class="mb-8 flex items-end justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-7 w-1 rounded-full" style="background:#04F06A;"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.25em]"
                        style="color:#04F06A;">Upcoming Events</span>
                </div>
                <h2 class="font-barlow-condensed text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-6xl">
                    Sự kiện sắp tới
                </h2>
            </div>
            <a href="{{ route('events.index') }}"
                class="hidden items-center gap-2 text-sm font-semibold lg:inline-flex transition-colors"
                style="color:#04F06A;"
                onmouseover="this.style.color='#07A0C3'"
                onmouseout="this.style.color='#04F06A'">
                Xem tất cả <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
            </a>
        </div>

        @if(isset($upcoming) && count($upcoming) > 0)
            {{-- Upcoming events list --}}
            <div class="flex flex-col gap-5">
                @foreach($upcoming as $i => $ev)
                    @php
                        $bgImg = !empty($ev['images']) ? $ev['images'][0]
                            : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80';
                        $url = isset($ev['slug']) && $ev['slug'] ? route('events.show', $ev['slug']) : '#';
                    @endphp
                    <a href="{{ $url }}"
                        class="group relative flex flex-col sm:flex-row items-stretch gap-0 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-[rgba(28,20,16,0.06)]"
                        style="background: rgba(255,255,255,0.8);">

                        {{-- Thumbnail --}}
                        <div class="shrink-0 w-full sm:w-[220px] h-48 sm:h-auto relative overflow-hidden"
                            style="background: #1C1410;">
                            <img src="{{ $bgImg }}" alt="{{ $ev['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                            {{-- Date badge --}}
                            <div class="absolute top-3 left-3 px-3 py-1.5 rounded-xl text-xs font-bold text-[#1C1410] shadow"
                                style="background: #FFE381;">
                                {{ $ev['date'] ?? '' }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-col justify-center px-6 py-5 flex-1 gap-2">
                            {{-- Status badge --}}
                            <div class="flex items-center gap-2 mb-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider"
                                    style="background: rgba(4,240,106,0.15); color: #04A843; border: 1px solid rgba(4,240,106,0.3);">
                                    <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#04F06A;"></span>
                                    {{ $ev['status'] ?? 'Sắp mở' }}
                                </span>
                            </div>

                            <h3 class="text-lg sm:text-xl font-black text-[#1C1410] leading-snug group-hover:text-[#07A0C3] transition-colors line-clamp-2"
                                style="font-family: 'Barlow Condensed', sans-serif;">
                                {{ $ev['name'] }}
                            </h3>

                            @if(!empty($ev['summary']))
                                <p class="text-sm text-[#7A6A52] line-clamp-2 leading-relaxed">
                                    {{ $ev['summary'] }}
                                </p>
                            @endif

                            <div class="mt-2 flex items-center gap-2 text-xs font-semibold"
                                style="color: #07A0C3;">
                                Xem chi tiết
                                <i data-lucide="arrow-right" class="h-3 w-3 transition-transform group-hover:translate-x-1"></i>
                            </div>
                        </div>

                        {{-- Right accent line --}}
                        <div class="absolute right-0 top-0 bottom-0 w-1 rounded-r-2xl transition-all duration-300"
                            style="background: linear-gradient(to bottom, #04F06A, #07A0C3);
                                   opacity: 0; transform: scaleY(0);"
                            x-ref="accent"></div>
                    </a>
                @endforeach
            </div>
        @else
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="mb-4 w-16 h-16 rounded-full flex items-center justify-center"
                    style="background: rgba(7,160,195,0.1);">
                    <i data-lucide="calendar-x" class="h-8 w-8" style="color:#07A0C3;"></i>
                </div>
                <h3 class="text-xl font-bold text-[#1C1410] mb-2">Chưa có sự kiện sắp tới</h3>
                <p class="text-sm text-[#7A6A52]">Hãy quay lại sau để khám phá những sự kiện mới nhất!</p>
            </div>
        @endif

    </div>
</section>
