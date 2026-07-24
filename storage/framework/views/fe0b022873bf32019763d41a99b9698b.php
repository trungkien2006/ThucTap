<a href="<?php echo e(route('events.show', $ev->slug ?? $ev->id)); ?>" class="fab-event-card group block relative rounded-2xl overflow-hidden cursor-pointer shadow-sm border border-transparent transition-all hover:shadow-md hover:border-[#E8C84A] hover:scale-[1.02]">
    <!-- Image -->
    <div class="w-full aspect-[4/3] bg-slate-200 relative overflow-hidden">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ev->bannerImage): ?>
            <img src="<?php echo e(\App\Helpers\FileHelper::url($ev->bannerImage->url)); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <?php else: ?>
            <div class="w-full h-full bg-[#E8C84A]"></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <!-- Permanent subtle gradient at bottom so text is readable -->
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/80 to-transparent"></div>
        
        <!-- Title Overlay (Scrolls on hover) -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="marquee-container w-full overflow-hidden whitespace-nowrap">
                <span class="marquee-text inline-block font-['Barlow_Condensed'] text-2xl font-bold uppercase text-white tracking-wide transition-transform duration-500 transform translate-y-0 group-hover:animate-marquee">
                    <?php echo e($ev->title); ?>

                </span>
            </div>
            <div class="text-xs text-white/70 mt-1 font-medium tracking-widest uppercase"><?php echo e($ev->event_date->format('d/m/Y')); ?></div>
        </div>
    </div>
</a>

<style>
    /* Add this inside the component or via the parent event-fab-menu */
    .marquee-container {
        mask-image: linear-gradient(to right, black 85%, transparent 100%);
        -webkit-mask-image: linear-gradient(to right, black 85%, transparent 100%);
    }
    
    @keyframes marquee-scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-100% + 200px)); /* scrolls text to the left */ }
    }
    
    .group:hover .group-hover\:animate-marquee {
        /* We need a little delay to let user hover */
        animation: marquee-scroll 4s linear infinite alternate 0.2s;
    }
</style>
<?php /**PATH C:\Users\anima\Downloads\ThucTap-main\resources\views/components/fab-event-card.blade.php ENDPATH**/ ?>