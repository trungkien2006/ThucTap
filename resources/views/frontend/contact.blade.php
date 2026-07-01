@extends('layouts.frontend')

@section('content')
<div class="pt-28 pb-20 bg-gradient-to-br from-[#FFFDF5] via-[#FFFBEA] to-[#F7F4E9] min-h-screen">
    <!-- Hero Header -->
    <div class="text-center max-w-3xl mx-auto px-6 mb-16 mt-8 relative">
        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-[#07A0C3] bg-[#07A0C3]/10 mb-4">
            <span class="w-2 h-2 rounded-full bg-[#07A0C3]"></span> Liên hệ với chúng tôi
        </span>
        <h1 class="font-['Barlow_Condensed'] text-5xl md:text-6xl font-black uppercase tracking-tight text-[#1C1410] mb-4">
            Kết nối với <span class="text-[#07A0C3] relative">UniEvent<span class="absolute bottom-1 left-0 w-full h-2 bg-[#FFE381] -z-10"></span></span>
        </h1>
        <p class="text-lg text-[#7A6A52]">
            Bạn có câu hỏi hoặc cần hỗ trợ? Đội ngũ của chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn.
        </p>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-[1200px] mx-auto px-6">
        
        <!-- Top Row: 4 Info Cards (Horizontal) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Address -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:border-[#FFE381] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background:#FFF8E1; color:#1C1410;">
                    <span class="material-symbols-outlined text-[24px]">location_on</span>
                </div>
                <h3 class="font-bold text-lg text-[#1C1410] mb-2">Trụ sở chính</h3>
                <p class="text-sm text-[#7A6A52]">Trường Cao đẳng FPT Polytechnic cơ sở Hà Nam<br>Hà Nam, Việt Nam</p>
            </div>
            
            <!-- Phone -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:border-[#07A0C3] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background:#E8F6F8; color:#07A0C3;">
                    <span class="material-symbols-outlined text-[24px]">call</span>
                </div>
                <h3 class="font-bold text-lg text-[#1C1410] mb-2">Hotline</h3>
                <p class="text-sm text-[#7A6A52]">0123 456 789<br>Thứ 2 - Thứ 6: 08:00 - 17:00</p>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:border-[#FFE381] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background:#FFF8E1; color:#1C1410;">
                    <span class="material-symbols-outlined text-[24px]">mail</span>
                </div>
                <h3 class="font-bold text-lg text-[#1C1410] mb-2">Email</h3>
                <p class="text-sm text-[#7A6A52]">support@unievent.com<br>info@unievent.com</p>
            </div>
            
            <!-- Social -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:border-[#07A0C3] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background:#E8F6F8; color:#07A0C3;">
                    <span class="material-symbols-outlined text-[24px]">forum</span>
                </div>
                <h3 class="font-bold text-lg text-[#1C1410] mb-2">Mạng xã hội</h3>
                <div class="flex items-center gap-3 mt-2">
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[#1C1410] hover:bg-[#07A0C3] hover:text-white transition-colors"><i data-lucide="facebook" class="w-4 h-4"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[#1C1410] hover:bg-[#07A0C3] hover:text-white transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                    <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[#1C1410] hover:bg-[#07A0C3] hover:text-white transition-colors"><i data-lucide="youtube" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>

        <!-- Bottom Row: Form & Map -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Left Column: Form -->
            <div class="bg-white rounded-3xl p-8 shadow-md border border-slate-100 relative overflow-hidden">
                <!-- Top Decorative Line -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#FFE381] via-[#07A0C3] to-[#FFE381]"></div>
                
                <h3 class="font-['Barlow_Condensed'] text-2xl font-bold uppercase text-[#1C1410] mb-6">Gửi tin nhắn cho chúng tôi</h3>
                
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-start gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-[#1C1410]">Họ và tên</label>
                            <input type="text" name="name" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E8C84A]/20 transition-all" placeholder="Nhập tên của bạn" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-[#1C1410]">Email</label>
                            <input type="email" name="email" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E8C84A]/20 transition-all" placeholder="Nhập email của bạn" required>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-[#1C1410]">Chủ đề</label>
                        <input type="text" name="subject" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E8C84A]/20 transition-all" placeholder="Ví dụ: Hỗ trợ tạo sự kiện" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-[#1C1410]">Nội dung</label>
                        <textarea rows="4" name="message" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#E8C84A] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E8C84A]/20 transition-all resize-none" placeholder="Nhập nội dung cần hỗ trợ..." required></textarea>
                    </div>
                    <button type="submit" class="w-full rounded-xl py-3.5 text-sm font-bold text-[#1C1410] shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 flex justify-center items-center gap-2" style="background: #FFE381;">
                        Gửi tin nhắn <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
            
            <!-- Right Column: Map -->
            <div class="bg-white p-4 rounded-3xl shadow-md border border-slate-100 h-full flex flex-col min-h-[500px] relative overflow-hidden">
                <!-- Top Decorative Line -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#07A0C3] via-[#FFE381] to-[#07A0C3]"></div>
                
                <h3 class="font-['Barlow_Condensed'] text-2xl font-bold uppercase text-[#1C1410] mb-4 px-4 pt-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#07A0C3]">map</span> Bản đồ địa điểm
                </h3>
                <div class="w-full flex-1 rounded-2xl overflow-hidden bg-slate-100 relative min-h-[400px]">
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
@endsection
