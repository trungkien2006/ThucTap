<x-guest-layout>

    {{-- Light Glassmorphism Card --}}
    <div class="bg-white/40 backdrop-blur-lg border border-white/60 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        
        {{-- Ánh sáng phản chiếu nhỏ góc trên --}}
        <div class="absolute top-0 left-10 w-24 h-1 bg-white/70 blur-[2px] rounded-full"></div>

        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-slate-900 font-bold text-3xl mb-2">Đăng ký</h2>
            <p class="text-slate-700 text-sm">Tạo tài khoản mới để trải nghiệm hệ thống</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div class="relative">
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Họ và tên"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all shadow-inner"
                />
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">badge</span>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />

            {{-- Email Address --}}
            <div class="relative">
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    placeholder="Địa chỉ Email"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all shadow-inner"
                />
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">mail</span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />

            {{-- Password --}}
            <div class="relative">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Mật khẩu"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all pr-12 shadow-inner"
                />
                <button type="button" onclick="toggleVisibility('password', 'eyeIcon1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors focus:outline-none">
                    <span class="material-symbols-outlined" id="eyeIcon1">visibility_off</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />

            {{-- Confirm Password --}}
            <div class="relative">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Xác nhận mật khẩu"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all pr-12 shadow-inner"
                />
                <button type="button" onclick="toggleVisibility('password_confirmation', 'eyeIcon2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors focus:outline-none">
                    <span class="material-symbols-outlined" id="eyeIcon2">visibility_off</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-slate-800 text-white py-3.5 px-6 rounded-xl font-bold text-[15px]
                       hover:bg-slate-900 active:scale-[0.98] transition-all duration-200 mt-4 shadow-lg shadow-slate-900/20"
            >
                Tạo tài khoản
            </button>

            {{-- Login text --}}
            <div class="text-center mt-6">
                <p class="text-slate-700 text-sm">
                    Đã có tài khoản? <a href="{{ route('login') }}" class="text-slate-900 font-bold hover:underline">Đăng nhập</a>
                </p>
            </div>
            
        </form>
    </div>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility_off';
            }
        }
    </script>

</x-guest-layout>
