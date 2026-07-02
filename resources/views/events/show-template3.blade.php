@extends('layouts.frontend')

@section('title', $event->title . ' - Chi tiết Sự kiện')
@section('meta_description', Str::limit(strip_tags($event->description ?? ''), 150))

@section('content')

@push('styles')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS Config -->
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "tertiary": "#a93349",
                "surface-container-lowest": "#ffffff",
                "inverse-on-surface": "#ecf1ff",
                "on-tertiary-fixed-variant": "#891933",
                "primary-fixed-dim": "#4de082",
                "on-background": "#111c2d",
                "on-primary": "#ffffff",
                "outline-variant": "#bccabb",
                "surface": "#f9f9ff",
                "on-primary-container": "#005e2d",
                "on-secondary-container": "#6f5900",
                "tertiary-fixed-dim": "#ffb2b9",
                "tertiary-container": "#ffafb7",
                "on-secondary-fixed": "#231b00",
                "error": "#ba1a1a",
                "surface-dim": "#cfdaf2",
                "surface-container-high": "#dee8ff",
                "secondary-fixed-dim": "#eec200",
                "surface-tint": "#006d36",
                "on-error-container": "#93000a",
                "on-error": "#ffffff",
                "surface-bright": "#f9f9ff",
                "on-tertiary-container": "#97253c",
                "primary": "#006d36",
                "on-primary-fixed-variant": "#005227",
                "primary-fixed": "#6dfe9c",
                "secondary-fixed": "#ffe083",
                "tertiary-fixed": "#ffdadc",
                "primary-container": "#4ade80",
                "surface-container-low": "#f0f3ff",
                "background": "#f9f9ff",
                "secondary-container": "#fed01b",
                "surface-container": "#e7eeff",
                "on-surface": "#111c2d",
                "on-surface-variant": "#3d4a3e",
                "surface-container-highest": "#d8e3fb",
                "on-primary-fixed": "#00210c",
                "surface-variant": "#d8e3fb",
                "inverse-primary": "#4de082",
                "outline": "#6d7b6d",
                "on-secondary": "#ffffff",
                "on-secondary-fixed-variant": "#574500",
                "on-tertiary": "#ffffff",
                "secondary": "#735c00",
                "inverse-surface": "#263143",
                "error-container": "#ffdad6",
                "on-tertiary-fixed": "#400010"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            spacing: {
                "margin-desktop": "64px",
                "unit": "8px",
                "gutter": "24px",
                "margin-mobile": "20px",
                "container-max": "1280px"
            },
            fontFamily: {
                "label-bold": ["Plus Jakarta Sans"],
                "display-lg": ["Plus Jakarta Sans"],
                "headline-md": ["Plus Jakarta Sans"],
                "body-md": ["Plus Jakarta Sans"],
                "headline-lg": ["Plus Jakarta Sans"],
                "display-lg-mobile": ["Plus Jakarta Sans"],
                "body-lg": ["Plus Jakarta Sans"]
            },
            fontSize: {
                "label-bold": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                "display-lg-mobile": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
            }
        }
    }
};
</script>
<!-- Tailwind CSS via CDN -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        vertical-align: middle;
    }
    .glass-lite {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    .soft-card-shadow {
        box-shadow: 0 32px 64px rgba(0, 109, 54, 0.05);
    }
    .timeline-line {
        background: repeating-linear-gradient(to bottom, transparent, transparent 4px, #d8e3fb 4px, #d8e3fb 8px);
        width: 2px;
    }
    .timeline-marker {
        box-shadow: 0 0 0 4px #ffffff, 0 0 12px rgba(77, 224, 130, 0.3);
    }
    .tp3-page-wrapper {
        background-color: #f9f9ff;
        color: #111c2d;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    /* Ensure content overrides frontend defaults */
    .tp3-page-wrapper h1, .tp3-page-wrapper h2, .tp3-page-wrapper h3, .tp3-page-wrapper h4 { margin: 0; }
    .tp3-page-wrapper p { margin: 0; }
</style>
@endpush

<div class="tp3-page-wrapper overflow-x-hidden pt-32 pb-24 min-h-screen w-full">
    <main class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- 1. Header Section -->
        <section class="mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-primary-container/20 text-primary mb-4 font-label-bold text-label-bold">
                <span class="material-symbols-outlined text-[18px]" data-icon="auto_awesome">auto_awesome</span>
                <span>{{ $event->category->name ?? 'Sự kiện' }}</span>
            </div>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-on-surface mb-4">{{ $event->title }}</h1>
            <div class="flex flex-wrap gap-6 items-center text-on-surface-variant">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary" data-icon="calendar_today">calendar_today</span>
                    <span class="font-body-md text-body-md">{{ $event->event_date->format('d \T\h\á\n\g m, Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary" data-icon="location_on">location_on</span>
                    <span class="font-body-md text-body-md">{{ $event->location ?? 'Đang cập nhật' }}</span>
                </div>
            </div>
        </section>

        <!-- 2. Two-Column Body -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-start">
            
            <!-- Left 1/3: Sticky Summary -->
            <aside class="md:col-span-4 sticky top-28 z-10">
                <div class="bg-white rounded-[24px] p-6 soft-card-shadow border border-white/50 flex flex-col gap-6">
                    <div class="relative w-full aspect-video rounded-[16px] overflow-hidden group">
                        @if($event->bannerImage)
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}" alt="{{ $event->title }}"/>
                        @else
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1200&auto=format&fit=crop" alt="Default Image"/>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="p-4 rounded-[16px] bg-surface-container-low border border-outline-variant/30">
                            <p class="font-label-bold text-label-bold text-primary mb-1">Thời gian bắt đầu</p>
                            <p class="font-headline-md text-headline-md text-on-surface">{{ $event->event_date->format('H:i') }}</p>
                        </div>
                        <div class="p-4 rounded-[16px] bg-surface-container-low border border-outline-variant/30 flex justify-between items-center">
                            <div>
                                <p class="font-label-bold text-label-bold text-primary mb-1">Địa điểm</p>
                                <p class="font-body-md text-body-md text-on-surface">{{ $event->location ?? 'Đang cập nhật' }}</p>
                            </div>
                            <a class="p-3 bg-secondary-container rounded-full text-on-secondary-fixed hover:scale-110 transition-transform" href="#">
                                <span class="material-symbols-outlined" data-icon="map">map</span>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-outline-variant/20">
                        <div class="flex -space-x-3 mb-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-surface-dim"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-primary-container"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-tertiary-container"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-secondary-fixed flex items-center justify-center text-[12px] font-bold">+</div>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant">Hơn {{ $event->registrations_count ?? rand(100, 500) }} người quan tâm sự kiện này.</p>
                    </div>
                </div>
            </aside>

            <!-- Right 2/3: Main Content -->
            <div class="md:col-span-8 flex flex-col gap-12">
                
                <!-- Introduction Card -->
                <article class="bg-white rounded-[24px] p-8 md:p-10 soft-card-shadow border border-white/50">
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-6">Về Sự Kiện</h2>
                    <div class="space-y-6">
                        @if(!empty($event->description))
                            @php
                                $isJsonDesc = false;
                                $descData = @json_decode($event->description, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($descData)) {
                                    $isJsonDesc = true;
                                }
                            @endphp
                            @if(!$isJsonDesc)
                                <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    {!! nl2br(e($event->description)) !!}
                                </div>
                            @endif
                        @else
                            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">Đang cập nhật thông tin giới thiệu chi tiết về sự kiện này...</p>
                        @endif
                    </div>
                </article>

                <!-- Highlight Section / Activities -->
                @if($event->galleryImages && $event->galleryImages->count() > 0)
                <section>
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="font-headline-lg text-headline-lg text-on-surface">Hoạt Động Nổi Bật</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-gutter">
                        @foreach($event->galleryImages as $index => $block)
                        <div class="group bg-white rounded-[24px] overflow-hidden soft-card-shadow border border-white/50 flex flex-col">
                            <div class="relative h-48 overflow-hidden">
                                @if($block->url)
                                    @if($block->type === 'video')
                                        <video src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" autoplay loop muted playsinline></video>
                                    @else
                                        <img src="{{ \App\Helpers\FileHelper::url($block->url) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                                    @endif
                                @else
                                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="">
                                @endif
                                <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur rounded-full font-label-bold text-label-bold {{ $index % 2 == 0 ? 'text-primary' : 'text-tertiary' }}">
                                    Hoạt động
                                </div>
                            </div>
                            <div class="p-6 flex-1">
                                <h4 class="font-headline-md text-headline-md text-on-surface mb-2">{{ $block->caption ?? 'Hoạt động nổi bật' }}</h4>
                                @if(!empty($block->content))
                                    <div class="font-body-md text-body-md text-on-surface-variant">
                                        {!! strip_tags($block->content) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
                
            </div>
        </div>
    </main>

    <!-- Simple Hover Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.group').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                    card.style.transition = 'all 0.3s ease';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0px)';
                });
            });
        });
    </script>
</div>
@endsection
