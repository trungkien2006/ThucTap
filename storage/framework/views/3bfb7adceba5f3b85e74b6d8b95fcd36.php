<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    
    <div class="bg-white/40 backdrop-blur-lg border border-white/60 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        
        
        <div class="absolute top-0 left-10 w-24 h-1 bg-white/70 blur-[2px] rounded-full"></div>

        
        <div class="mb-8">
            <h2 class="text-slate-900 font-bold text-3xl mb-2">Đăng nhập</h2>
            <p class="text-slate-700 text-sm">Chào mừng trở lại, vui lòng đăng nhập vào tài khoản của bạn</p>
        </div>

        
        <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-4 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 text-sm text-center font-medium animate-fade-in">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-600 text-sm text-center font-medium animate-fade-in">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            
            <div class="relative">
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Địa chỉ Email"
                    class="w-full bg-white/50 border border-white/60 rounded-xl px-4 py-3.5 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all shadow-inner"
                />
                <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">person</span>
            </div>

            
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

            
            <button
                type="submit"
                class="w-full bg-slate-800 text-white py-3.5 px-6 rounded-xl font-bold text-[15px]
                       hover:bg-slate-900 active:scale-[0.98] transition-all duration-200 mt-2 shadow-lg shadow-slate-900/20"
            >
                Đăng nhập
            </button>


            
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\kienxinhzai\Downloads\ThucTap-tuan\resources\views/auth/login.blade.php ENDPATH**/ ?>