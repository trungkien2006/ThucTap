@extends('layouts.frontend')
@section('title', $category->name . ' — UniEvent')

@section('content')

{{-- ════════════════════════════════════════
     HERO SECTION - 1 NEWEST EVENT
════════════════════════════════════════════ --}}
<section class="relative pt-32 pb-16 lg:pt-40 lg:pb-24" style="background:#FFFBEA;">
    <div class="mx-auto max-w-[1400px] px-6 lg:px-10">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="h-7 w-1 rounded-full" style="background:#07A0C3;"></div>
                <span class="text-xs font-bold uppercase tracking-[0.25em]" style="color:#07A0C3;">Danh mục</span>
            </div>
            <h1 class="font-['Barlow_Condensed'] text-5xl font-black uppercase tracking-tight text-[#1C1410] lg:text-7xl">{{ $category->name }}</h1>
        </div>

        @if($newestEvent)
        <div class="group relative flex flex-col-reverse lg:flex-row overflow-hidden rounded-3xl shadow-2xl transition-all duration-500 hover:-translate-y-1" style="background:#FFF8D0;">
            <div class="flex-1 p-8 lg:p-12 flex flex-col justify-center">
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide" style="background:#FFE381; color:#1C1410;">
                        Mới nhất
                    </span>
                </div>
                <h2 class="font-['Barlow_Condensed'] text-3xl lg:text-5xl font-black uppercase leading-tight text-[#1C1410] transition-colors group-hover:text-[#07A0C3]">
                    <a href="{{ route('events.show', $newestEvent->slug) }}">{{ $newestEvent->title }}</a>
                </h2>
                <p class="mt-6 text-base text-[#7A6A52] leading-relaxed line-clamp-4">
                    {{ Str::limit(strip_tags($newestEvent->description), 250) }}
                </p>
            </div>
            <div class="flex-1 relative h-[300px] lg:h-[400px] xl:h-auto overflow-hidden">
                <a href="{{ route('events.show', $newestEvent->slug) }}" class="block w-full h-full">
                    <img src="{{ $newestEvent->bannerImage ? \App\Helpers\FileHelper::url($newestEvent->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80' }}" 
                         alt="{{ $newestEvent->title }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ════════════════════════════════════════
     EVENTS GRID & ASIDE
════════════════════════════════════════════ --}}
<section class="relative py-16" style="background:#FFFBEA;">
    <div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_400px] lg:px-10">
        
        {{-- Left: Grid --}}
        <div>
            <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase text-[#1C1410] mb-8">Các sự kiện khác</h3>
            @if($otherEvents->count() > 0)
            <div x-data="{ loaded: false }" x-init="setTimeout(() => { loaded = true }, 500)">
                <style>
                    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
                    .skeleton-shimmer { background: linear-gradient(90deg, rgba(232,226,213,0.5) 25%, rgba(255,253,249,0.8) 50%, rgba(232,226,213,0.5) 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
                </style>
                <!-- Skeleton Loading -->
                <div x-show="!loaded" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    @for($k = 0; $k < count($otherEvents); $k++)
                    <div class="rounded-2xl h-[350px] w-full skeleton-shimmer"></div>
                    @endfor
                </div>
                <!-- Actual Content -->
                <div x-show="loaded" style="display: none;" x-transition:enter="transition-opacity ease-out duration-500" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @foreach($otherEvents as $ev)
                <article class="group relative flex flex-col overflow-hidden rounded-2xl transition-all duration-500 hover:-translate-y-1"
                         style="background:#FFF8D0; box-shadow:0 2px 16px rgba(255,227,129,0.4);"
                         onmouseover="this.style.boxShadow='0 12px 40px rgba(7,160,195,0.18)'"
                         onmouseout="this.style.boxShadow='0 2px 16px rgba(255,227,129,0.4)'">
                    
                    <div class="relative z-10 h-48 w-full shrink-0 overflow-hidden">
                        <a href="{{ route('events.show', $ev->slug) }}" class="block h-full w-full relative">
                            <img src="{{ $ev->bannerImage ? \App\Helpers\FileHelper::url($ev->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80' }}" 
                                 alt="{{ $ev->title }}" loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            
                            <!-- Hover Description Overlay -->
                            <div class="absolute inset-0 p-4 flex flex-col justify-center backdrop-blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none" style="background-color: rgba(0,0,0,0.4);">
                                <p class="text-white text-xs md:text-sm leading-relaxed line-clamp-6 font-medium drop-shadow-md">
                                    {{ Str::limit(strip_tags($ev->description), 200) }}
                                </p>
                            </div>
                        </a>
                        <div class="absolute bottom-0 left-0 right-0 h-1" style="background:#FFE381;"></div>
                    </div>
                    <div class="relative z-10 flex flex-1 flex-col justify-between p-5">
                        <div>
                            <h4 class="font-['Barlow_Condensed'] text-xl font-black uppercase leading-tight tracking-wide text-[#1C1410] transition-colors group-hover:text-[#07A0C3]">
                                <a href="{{ route('events.show', $ev->slug) }}">
                                    {{ $ev->title }}
                                </a>
                            </h4>
                            <div class="mt-3 flex flex-col gap-1.5 text-sm text-[#7A6A52]">
                                <div class="flex items-center gap-1.5 text-xs font-semibold">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    <span>{{ $ev->event_date->format('d.m.Y') }}</span>
                                </div>
                                <p class="line-clamp-3">{{ Str::limit(strip_tags($ev->description), 100) }}</p>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                </div>
            </div>
            
            <div class="mt-10">
                {{ $otherEvents->links() }}
            </div>
            @else
            <p class="text-[#7A6A52]">Chưa có sự kiện nào khác trong danh mục này.</p>
            @endif
        </div>

        {{-- Right: Aside --}}
        <aside class="lg:sticky lg:top-28 lg:self-start">
            <div class="overflow-hidden rounded-2xl shadow-xl" style="border:2px solid #FFE381; background:#FFF8D0;">
                <div class="relative overflow-hidden px-6 py-5" style="background:#FFE381;">
                    <div class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full opacity-30" style="background:#07A0C3;"></div>
                    <h3 class="font-['Barlow_Condensed'] text-2xl font-black uppercase tracking-wide text-[#1C1410] relative z-10">Sự kiện nổi bật</h3>
                </div>
                
                <div class="p-6 space-y-5">
                    @foreach($featuredEvents as $fEv)
                    <a href="{{ route('events.show', $fEv->slug) }}" class="flex gap-4 items-center group">
                        <div class="w-20 h-16 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200">
                            <img src="{{ $fEv->bannerImage ? \App\Helpers\FileHelper::url($fEv->bannerImage->url) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1600&q=80' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        <div>
                            <h5 class="text-[14px] font-bold text-[#1C1410] group-hover:text-[#07A0C3] transition-colors line-clamp-2 leading-snug">{{ $fEv->title }}</h5>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[11px] text-[#07A0C3] font-bold flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> {{ $fEv->event_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-3 mt-1.5">
                                <span class="text-[11px] text-[#7A6A52] flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> {{ number_format($fEv->views_count) }}</span>
                                <span class="text-[11px] text-[#7A6A52] flex items-center gap-1"><i data-lucide="heart" class="w-3 h-3"></i> {{ number_format($fEv->likes_count) }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    @if($featuredEvents->count() == 0)
                    <p class="text-sm text-[#7A6A52]">Chưa có sự kiện nổi bật.</p>
                    @endif
                </div>
            </div>
        </aside>

    </div>
</section>

{{-- ════════════════════════════════════════
     MEDIA GALLERY
════════════════════════════════════════════ --}}
@if(count($media) > 0)
@php $mediaJson = json_encode($media); @endphp
<section class="relative overflow-hidden py-20" style="background:#FFF3C4;"
         x-data="mediaPlayer({{ $mediaJson }})" x-init="initPlayer()">
    <div class="absolute inset-x-0 top-0 h-1.5" style="background:#FFE381;"></div>
    
    <div class="relative mx-auto max-w-[1400px] px-6 lg:px-10">
        <div class="mb-10 text-center">
            <h2 class="font-['Barlow_Condensed'] text-4xl font-black uppercase tracking-tight text-[#1C1410]">Album {{ $category->name }}</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8 bg-black rounded-2xl overflow-hidden relative h-[260px] sm:h-[340px] lg:h-[500px]" style="box-shadow:0 16px 50px rgba(7,160,195,0.15);">
                <template x-for="(item, index) in items" :key="index">
                    <div x-show="currentIndex === index" 
                         x-transition:enter="transition ease-out duration-700 transform"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-300 transform"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-105"
                         class="absolute inset-0 flex items-center justify-center">
                        <template x-if="item.type === 'video'">
                            <video :src="item.src" class="w-full h-full object-contain" autoplay muted playsinline @ended="next()"></video>
                        </template>
                        <template x-if="item.type === 'image'">
                            <img :src="item.src" :alt="item.title" class="w-full h-full object-contain" />
                        </template>
                    </div>
                </template>
                <div class="absolute bottom-0 left-0 right-0 h-1.5 bg-black/50 z-20">
                    <div class="h-full bg-[#07A0C3] transition-all duration-100" :style="`width: ${progress}%`"></div>
                </div>
            </div>

            <div class="lg:col-span-4 flex flex-col gap-4 h-auto lg:h-[500px]">
                <div class="flex-1 rounded-2xl p-6 flex flex-col justify-center relative overflow-hidden group min-h-[180px] lg:min-h-0" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(12px); box-shadow: 0 4px 20px rgba(255,200,60,0.15); border: 1px solid rgba(255, 227, 129, 0.5);">
                    <div class="mb-4 inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.25em] text-[#1C1410]" style="background:#FFE381;" x-text="currentItem.type === 'video' ? 'Video' : 'Hình ảnh'"></div>
                    <h3 class="font-['Barlow_Condensed'] text-3xl font-black uppercase tracking-wide text-[#1C1410] leading-snug line-clamp-4" x-text="currentItem.title"></h3>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="h-10 w-1 rounded-full" style="background:#04F06A;"></div>
                        <a :href="currentItem.event_url" class="text-sm font-semibold text-[#7A6A52] hover:text-[#07A0C3] transition-colors" x-text="currentItem.event_name"></a>
                    </div>
                </div>

                <div class="h-[120px] grid grid-cols-3 gap-3">
                    <template x-for="i in 3" :key="i">
                        <div class="rounded-xl overflow-hidden cursor-pointer relative group bg-black" 
                             @click="goToItem(getThumbIndex(i))"
                             :class="getThumbIndex(i) === currentIndex ? 'ring-2 ring-[#07A0C3]' : ''">
                            <template x-if="items[getThumbIndex(i)]">
                                <template x-if="items[getThumbIndex(i)].type === 'video'">
                                    <video :src="items[getThumbIndex(i)].src" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-60 group-hover:opacity-100"></video>
                                </template>
                            </template>
                            <template x-if="items[getThumbIndex(i)]">
                                <template x-if="items[getThumbIndex(i)].type === 'image'">
                                    <img :src="items[getThumbIndex(i)].src" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-60 group-hover:opacity-100" />
                                </template>
                            </template>
                            <template x-if="items[getThumbIndex(i)] && items[getThumbIndex(i)].type === 'video'">
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="grid h-8 w-8 place-items-center rounded-full bg-white/80 text-[#1C1410] shadow-sm">
                                        <i data-lucide="play" class="h-4 w-4 ml-1"></i>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
