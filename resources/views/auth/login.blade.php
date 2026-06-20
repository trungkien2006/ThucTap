<x-guest-layout>

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-deep-navy font-extrabold" style="font-size: 1.8rem;">Chào mừng trở lại 👋</h2>
        <p class="text-text-muted mt-1 text-sm">Đăng nhập để quản lý sự kiện của FPT Polytechnic.</p>
    </div>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-on-surface mb-1.5">
                Địa chỉ Email
            </label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">mail</span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="admin@fptpolytechnic.edu.vn"
                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-outline-variant bg-pure-white text-on-surface text-sm
                           focus:outline-none focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange
                           transition-all placeholder-text-muted
                           {{ $errors->get('email') ? 'border-error ring-2 ring-error/30' : '' }}"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-semibold text-on-surface">
                    Mật khẩu
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-fpt-orange hover:underline font-medium">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">lock</span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-10 pr-12 py-3 rounded-xl border border-outline-variant bg-pure-white text-on-surface text-sm
                           focus:outline-none focus:ring-2 focus:ring-fpt-orange focus:border-fpt-orange
                           transition-all placeholder-text-muted
                           {{ $errors->get('password') ? 'border-error ring-2 ring-error/30' : '' }}"
                />
                {{-- Toggle password visibility --}}
                <button type="button" id="togglePassword" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined" id="eyeIcon" style="font-size:18px">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center gap-2.5">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="w-4 h-4 rounded border-outline-variant text-fpt-orange focus:ring-fpt-orange cursor-pointer"
            />
            <label for="remember_me" class="text-sm text-text-muted cursor-pointer select-none">
                Ghi nhớ đăng nhập
            </label>
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full bg-deep-navy text-pure-white py-3.5 px-6 rounded-xl font-semibold text-sm
                   hover:bg-deep-navy/90 active:scale-[0.98] transition-all duration-200
                   flex items-center justify-center gap-2 shadow-lg shadow-deep-navy/20 mt-2"
        >
            <span class="material-symbols-outlined" style="font-size:18px">login</span>
            Đăng nhập
        </button>

        {{-- Divider --}}
        <div class="relative my-2">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-outline-variant"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="bg-surface px-3 text-text-muted">Cổng dành cho Admin</span>
            </div>
        </div>

        {{-- Info note --}}
        <div class="flex items-start gap-2.5 bg-deep-navy/5 border border-deep-navy/10 rounded-xl p-3.5">
            <span class="material-symbols-outlined text-deep-navy mt-0.5 shrink-0" style="font-size:16px">info</span>
            <p class="text-xs text-text-muted leading-relaxed">
                Trang đăng nhập này chỉ dành cho <strong class="text-deep-navy">quản trị viên</strong>.
                Sinh viên muốn đăng ký sự kiện vui lòng truy cập
                <a href="{{ route('home') }}" class="text-fpt-orange hover:underline font-medium">trang chủ</a>.
            </p>
        </div>

    </form>

    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
            });
        }
    </script>

</x-guest-layout>
