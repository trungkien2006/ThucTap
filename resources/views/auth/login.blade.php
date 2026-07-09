<x-guest-layout>

    {{-- Light Glassmorphism Card --}}
    <div class="bg-white/40 backdrop-blur-lg border border-white/60 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        
        {{-- Ánh sáng phản chiếu nhỏ góc trên --}}
        <div class="absolute top-0 left-10 w-24 h-1 bg-white/70 blur-[2px] rounded-full"></div>

        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-slate-900 font-bold text-3xl mb-2">Đăng nhập</h2>
            <p class="text-slate-700 text-sm">Chào mừng trở lại, vui lòng đăng nhập vào tài khoản của bạn</p>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Session Messages --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 text-sm text-center font-medium animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 text-sm text-center font-medium animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email / Username --}}
            <div class="relative">
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Địa chỉ Email"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all shadow-inner"
                />
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">person</span>
            </div>

            {{-- Password --}}
            <div class="relative">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Mật khẩu"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all pr-12 shadow-inner"
                />
                <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors focus:outline-none">
                    <span class="material-symbols-outlined" id="eyeIcon">visibility_off</span>
                </button>
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="relative flex items-center justify-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="peer appearance-none w-5 h-5 border border-white/60 rounded bg-white/50 checked:bg-emerald-500 checked:border-emerald-500 transition-all cursor-pointer focus:ring-0 focus:ring-offset-0"
                        />
                        <span class="material-symbols-outlined absolute text-white text-[14px] pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity">check</span>
                    </div>
                    <label for="remember_me" class="text-sm text-slate-800 font-medium cursor-pointer select-none">
                        Ghi nhớ
                    </label>
                </div>
                

            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-slate-800 text-white py-3.5 px-6 rounded-xl font-bold text-[15px]
                       hover:bg-slate-900 active:scale-[0.98] transition-all duration-200 mt-2 shadow-lg shadow-slate-900/20"
            >
                Đăng nhập
            </button>


            {{-- Footer info --}}
            <div class="text-center mt-8">
                <p class="text-slate-600 text-xs italic">Hệ thống quản lý sự kiện UniEvents</p>
            </div>

        </form>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIcon.textContent = isPassword ? 'visibility' : 'visibility_off';
            });
        }
    </script>

</x-guest-layout>
