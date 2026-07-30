@extends('layouts.frontend')

@section('content')
<div class="min-h-screen relative overflow-hidden" style="background: transparent;">
    
    <!-- Hero Header (Cinematic) -->
    <section class="relative w-full overflow-hidden" style="background: rgba(28, 20, 16, 0.85); backdrop-filter: blur(12px); padding: 180px 0 160px 0;">
        <!-- Ambient Blobs Removed -->
        
        <!-- Grain Texture -->
        <div class="absolute inset-0 pointer-events-none animated-grain" style="opacity: 0.1;"></div>

        <div class="relative z-10 text-center max-w-4xl mx-auto px-6">
            <h1 class="font-['Barlow_Condensed'] text-5xl md:text-7xl font-black uppercase tracking-tight text-white mb-6" data-aos="fade-up" data-aos-duration="1000">
                Liên hệ <span class="shimmer-text">UniEvent</span>
            </h1>
            <p class="text-lg md:text-xl text-white/70 max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                Bạn có câu hỏi hoặc cần hỗ trợ? Đội ngũ của chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn.
            </p>
        </div>
    </section>

    <!-- Info Strip (Overlap) -->
    <div class="relative z-20 max-w-[1200px] mx-auto px-6 -mt-[60px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <div class="rounded-3xl p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 shadow-2xl backdrop-blur-xl border border-white/20" style="background: rgba(255, 255, 255, 0.85);">
            
            <!-- Address -->
            <div class="flex items-center gap-5 p-4 rounded-2xl transition-all hover:bg-white hover:shadow-md hover:-translate-y-1">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background:#FFE381; color:#1C1410;">
                    <span class="material-symbols-outlined text-[28px]">location_on</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1C1410] mb-1">Trụ sở chính</h3>
                    <p class="text-sm text-[#7A6A52] leading-relaxed">Trường Cao đẳng FPT Polytechnic cơ sở Hà Nam</p>
                </div>
            </div>
            
            <!-- Phone -->
            <div class="flex items-center gap-5 p-4 rounded-2xl transition-all hover:bg-white hover:shadow-md hover:-translate-y-1 border-t md:border-t-0 md:border-l border-slate-200">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background:rgba(7,160,195,0.1); color:#07A0C3;">
                    <span class="material-symbols-outlined text-[28px]">call</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1C1410] mb-1">Hotline</h3>
                    <p class="text-sm text-[#7A6A52] leading-relaxed">0911 968 213<br>T2 - T6: 08:00 - 17:00</p>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-center gap-5 p-4 rounded-2xl transition-all hover:bg-white hover:shadow-md hover:-translate-y-1 border-t md:border-t-0 md:border-l border-slate-200">
                <div class="w-14 h-14 rounded-full flex items-center justify-center shrink-0 shadow-sm" style="background:#FFE381; color:#1C1410;">
                    <span class="material-symbols-outlined text-[28px]">mail</span>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1C1410] mb-1">Email</h3>
                    <p class="text-sm text-[#7A6A52] leading-relaxed">caodang@fpt.edu.vn</p>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-5 gap-12 items-start py-20">
        
        <!-- Left Column: Form -->
        <div class="lg:col-span-3 relative z-50 bg-white/80 backdrop-blur-xl border border-white/50 rounded-3xl p-8 md:p-10 shadow-sm" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-2 h-8 rounded-full" style="background: #E8C84A;"></div>
                <h3 class="font-['Barlow_Condensed'] text-3xl font-bold uppercase text-[#1C1410]">Gửi tin nhắn</h3>
            </div>
            
            @if(session('success'))
                <div class="mb-8 p-5 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-start gap-4">
                    <i data-lucide="check-circle" class="w-6 h-6 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm font-medium leading-relaxed">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 p-5 rounded-2xl bg-red-50 border border-red-100 text-red-700 flex items-start gap-4">
                    <i data-lucide="alert-circle" class="w-6 h-6 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm font-medium leading-relaxed">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-[#1C1410]">Họ và tên <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#E8C84A]/10 transition-all" placeholder="Nguyễn Văn A" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-[#1C1410]">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#E8C84A]/10 transition-all" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#1C1410]">Chủ đề <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#E8C84A]/10 transition-all" placeholder="Ví dụ: Cần hỗ trợ đăng ký sự kiện" required>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#1C1410]">Nội dung <span class="text-red-500">*</span></label>
                    <textarea rows="5" name="message" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#E8C84A]/10 transition-all resize-none" placeholder="Nhập nội dung chi tiết cần hỗ trợ..." required></textarea>
                </div>
                
                @if(env('TURNSTILE_SITE_KEY'))
                <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                @error('cf-turnstile-response')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
                @endif

                <button type="submit" class="w-full rounded-2xl py-4 text-[15px] font-bold text-[#1C1410] shadow-sm transition-all hover:shadow-lg hover:shadow-[#FFE381]/40 hover:-translate-y-1 active:translate-y-0 flex justify-center items-center gap-3" style="background: linear-gradient(135deg, #FFE381 0%, #E8C84A 100%);">
                    <span>Gửi tin nhắn</span>
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
        
        <!-- Right Column: Map & Social -->
        <div class="lg:col-span-2 space-y-8 h-full flex flex-col" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <!-- Map -->
            <div class="bg-white/80 backdrop-blur-xl p-2 rounded-[28px] shadow-sm flex-1 min-h-[400px] border border-white/50 flex flex-col">
                <div class="w-full flex-1 rounded-[20px] overflow-hidden relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8145.549605659171!2d105.93575372767192!3d20.598225418016444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135cf62d752dc67%3A0xd79f03899b4e83d8!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYyBjxqEgc-G7nyBIw6AgTmFt!5e0!3m2!1svi!2s!4v1782551811425!5m2!1svi!2s" 
                        class="absolute inset-0 w-full h-full" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>
            </div>

        </div>
        
    </div>
</div>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endsection
