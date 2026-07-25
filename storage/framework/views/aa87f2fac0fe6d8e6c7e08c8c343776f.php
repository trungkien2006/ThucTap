<?php $__env->startPush('styles'); ?>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --t4-gold: #D97706; /* Màu vàng đồng / hổ phách sang trọng */
    --t4-gold-light: #FEF3C7; /* Vàng nhạt */
    --t4-bg: #FCF9F2; /* Màu giấy kem nhạt cao cấp */
    --t4-surface: #FFFFFF;
    --t4-text: #2C2520; /* Màu chữ nâu đen ấm */
    --t4-muted: #786F66; /* Chữ chú thích */
    --t4-border: #EADEC9; /* Viền màu vàng nhạt ấm */
}

.t4-body {
    background-color: var(--t4-bg) !important;
    color: var(--t4-text);
    font-family: 'Montserrat', sans-serif;
    line-height: 1.8;
    min-height: 100vh;
    padding-bottom: 100px;
}

/* ─── CONTAINER ─── */
.t4-container {
    max-width: 1000px;
    margin: 0 auto;
    background: var(--t4-surface);
    border-left: 1px solid var(--t4-border);
    border-right: 1px solid var(--t4-border);
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(44, 37, 32, 0.04);
    position: relative;
}

/* ─── HERO SECTION ─── */
.t4-hero {
    position: relative;
    width: 100%;
    height: 380px;
    overflow: hidden;
}
.t4-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t4-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(44,37,32,0.1), rgba(44,37,32,0.6));
    z-index: 1;
}
.t4-hero-content {
    position: absolute;
    bottom: 30px;
    left: 0;
    right: 0;
    text-align: center;
    color: #FFFFFF;
    z-index: 2;
    padding: 0 20px;
}
.t4-hero-quote {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 14px;
    opacity: 0.95;
    margin-bottom: 10px;
    letter-spacing: 0.05em;
}
.t4-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 6px;
    letter-spacing: -0.01em;
    color: #FEF3C7;
}
.t4-hero-subtitle {
    font-size: 13px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    font-weight: 600;
}

/* ─── CARD SECTIONS ─── */
.t4-card {
    padding: 40px 24px;
    text-align: center;
    border-bottom: 1px solid var(--t4-border);
    position: relative;
}
.t4-card::after {
    content: '✦';
    position: absolute;
    bottom: -9px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--t4-surface);
    padding: 0 10px;
    color: var(--t4-gold);
    font-size: 12px;
    z-index: 2;
}
.t4-card:last-of-type {
    border-bottom: none;
}
.t4-card:last-of-type::after {
    display: none;
}

/* Section Title */
.t4-sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 16px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.t4-date-highlight {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: var(--t4-gold);
    margin-bottom: 16px;
    font-weight: 600;
}

.t4-body-text {
    font-size: 13.5px;
    color: var(--t4-text);
    line-height: 1.8;
}

/* ─── INFO BOXES ─── */
.t4-info-wrap {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.t4-info-item {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 12px;
    padding: 16px;
}
.t4-info-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--t4-muted);
    font-weight: 700;
    margin-bottom: 4px;
}
.t4-info-val {
    font-size: 14px;
    font-weight: 600;
    color: var(--t4-text);
}

/* ─── TIMELINE ─── */
.t4-timeline {
    margin-top: 24px;
    position: relative;
    padding-left: 20px;
    text-align: left;
}
.t4-timeline::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 6px;
    bottom: 6px;
    width: 1px;
    background: var(--t4-border);
}
.t4-timeline-item {
    position: relative;
    padding-bottom: 24px;
}
.t4-timeline-item:last-child {
    padding-bottom: 0;
}
.t4-timeline-dot {
    position: absolute;
    left: -20px;
    top: 6px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: var(--t4-gold);
    border: 2px solid var(--t4-surface);
}
.t4-timeline-time {
    font-size: 11px;
    font-weight: 700;
    color: var(--t4-gold);
    margin-bottom: 2px;
}
.t4-timeline-title {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--t4-text);
}

/* ─── SPEAKERS ─── */
.t4-speakers {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 24px;
}
.t4-speaker {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 12px;
    padding: 16px;
}
.t4-speaker-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 12px;
    border: 2px solid var(--t4-border);
}
.t4-speaker-name {
    font-size: 13px;
    font-weight: 700;
    color: var(--t4-text);
}
.t4-speaker-role {
    font-size: 11px;
    color: var(--t4-muted);
}

/* ─── COUNTDOWN ─── */
.t4-countdown {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 24px;
}
.t4-cd-box {
    background: #FAF8F2;
    border: 1px solid var(--t4-border);
    border-radius: 8px;
    padding: 8px;
    min-width: 64px;
}
.t4-cd-num {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--t4-gold);
    line-height: 1.2;
}
.t4-cd-label {
    font-size: 9px;
    text-transform: uppercase;
    color: var(--t4-muted);
    font-weight: 700;
}

</style>
<?php $__env->stopPush(); ?>

<?php
    $titleStyles = [];
    if (!empty($event->title_font_family)) $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
    if (!empty($event->title_font_size))   $titleStyles[] = "font-size: {$event->title_font_size}px;";
    if (!empty($event->title_color))       $titleStyles[] = "color: {$event->title_color} !important; background: none;";
    $titleStyleStr = implode(' ', $titleStyles);

    $descStyles = [];
    if (!empty($event->desc_font_family)) $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
    if (!empty($event->desc_font_size))   $descStyles[] = "font-size: {$event->desc_font_size}px;";
    if (!empty($event->desc_color))       $descStyles[] = "color: {$event->desc_color} !important;";
    $descStyleStr = implode(' ', $descStyles);
?>

<?php $__env->startSection('content'); ?>
<div class="t4-body">
    <div class="t4-container">
        
        
        <div class="t4-hero">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->bannerImage): ?>
                <img src="<?php echo e(\App\Helpers\FileHelper::url($event->bannerImage->url)); ?>" class="t4-hero-img" alt="<?php echo e($event->title); ?>">
            <?php else: ?>
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" class="t4-hero-img" alt="Default banner">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="t4-hero-overlay"></div>
            <div class="t4-hero-content">
                <div class="t4-hero-quote">"Vượt núi băng ngàn, tìm đến bình minh. Khởi đầu nơi đây, mở ra muôn ngả chân trời."</div>
                <h1 class="t4-hero-title" style="<?php echo e($titleStyleStr); ?>"><?php echo nl2br(e($event->title)); ?></h1>
                <div class="t4-hero-subtitle"><?php echo e($event->category ? $event->category->name : 'SỰ KIỆN NỔI BẬT'); ?></div>
            </div>
        </div>

        
        <div class="t4-card">
            <div class="t4-date-highlight">- <?php echo e($event->event_date->format('Y.m.d')); ?> -</div>
            <div class="t4-body-text" style="font-style: italic;">
                "Rồi chúng ta cũng sẽ hòa vào biển người, mỗi người đều có phong ba và rực rỡ riêng. Chúc cho chặng đường tới, hoa nở như gấm, ngày gặp lại vẫn như xưa."
            </div>
        </div>

        
        <div class="t4-card">
            <div class="t4-sec-title">Trân trọng kính mời</div>
            <div class="t4-body-text">
                <strong style="color: var(--t4-gold);">Kính gửi quý thầy cô, đại biểu và các bạn sinh viên</strong>
                <div class="mt-3">
                    Chúng tôi vinh hạnh được đồng hành và chứng kiến khoảnh khắc trọng đại này cùng bạn. Sự hiện diện của bạn là niềm vinh dự lớn lao cho chương trình.
                </div>
            </div>
        </div>

        
        <div class="t4-card">
            <div class="t4-sec-title">Thời gian & Địa điểm</div>
            <div class="t4-info-wrap">
                <div class="t4-info-item">
                    <div class="t4-info-label">Thời gian</div>
                    <div class="t4-info-val">
                        <?php echo e($event->event_date->translatedFormat('H:i, l d/m/Y')); ?> 
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->end_date): ?>
                            — <?php echo e($event->end_date->translatedFormat('H:i, d/m/Y')); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->location): ?>
                <div class="t4-info-item">
                    <div class="t4-info-label">Địa điểm</div>
                    <div class="t4-info-val"><?php echo e($event->location); ?></div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->event_date > now()): ?>
            <div class="t4-countdown" id="t4-countdown" data-date="<?php echo e($event->event_date->format('Y-m-d\TH:i:s')); ?>">
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-days">00</div><div class="t4-cd-label">Ngày</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-hours">00</div><div class="t4-cd-label">Giờ</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-mins">00</div><div class="t4-cd-label">Phút</div></div>
                <div class="t4-cd-box"><div class="t4-cd-num" id="t4-secs">00</div><div class="t4-cd-label">Giây</div></div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->scheduleItems->count() > 0): ?>
        <div class="t4-card">
            <div class="t4-sec-title">Timeline chương trình</div>
            <div class="t4-timeline">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->scheduleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="t4-timeline-item">
                    <div class="t4-timeline-dot"></div>
                    <div class="t4-timeline-time"><?php echo e(\Carbon\Carbon::parse($item->start_time)->format('H:i')); ?><?php echo e($item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : ''); ?></div>
                    <div class="t4-timeline-title"><?php echo e($item->title); ?></div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="t4-card">
            <div class="t4-sec-title">Tương lai rực rỡ</div>
            <div class="t4-body-text" style="<?php echo e($descStyleStr); ?>">
                <?php echo $event->description; ?>

            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->galleryImages->count() > 0): ?>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->galleryImages->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->url): ?>
                        <div class="rounded-lg overflow-hidden border border-slate-100 shadow-sm" style="aspect-ratio: 1/1;">
                            <img src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="w-full h-full object-cover" alt="">
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->speakers->count() > 0): ?>
        <div class="t4-card">
            <div class="t4-sec-title">Diễn giả tham gia</div>
            <div class="t4-speakers">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="t4-speaker">
                    <img src="<?php echo e($speaker->photo_url ? \App\Helpers\FileHelper::url($speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'); ?>" class="t4-speaker-img" alt="">
                    <div class="t4-speaker-name"><?php echo e($speaker->name); ?></div>
                    <div class="t4-speaker-role"><?php echo e($speaker->title); ?></div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="t4-card">
            <div class="flex flex-wrap justify-center gap-4 mt-8" x-data="{ copied: false }">
                <button id="like-btn" data-event-id="<?php echo e($event->id); ?>" class="flex items-center gap-2 px-6 py-3 rounded-full font-bold transition-all shadow-sm <?php echo e(session()->has('liked_events.' . $event->id) ? 'bg-orange-50 text-[#f97316] border border-orange-200' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50'); ?>">
                    <span class="material-symbols-outlined <?php echo e(session()->has('liked_events.' . $event->id) ? 'font-fill' : ''); ?>">favorite</span>
                    <span id="likes-count"><?php echo e($event->likes_count); ?></span> Lượt thích
                </button>
                <div class="flex items-center gap-2 px-6 py-3 rounded-full bg-white text-slate-700 border border-slate-200 shadow-sm font-bold">
                    <span class="material-symbols-outlined text-[#f97316]">visibility</span>
                    <span><?php echo e($event->views_count); ?></span> Lượt xem
                </div>
                
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" target="_blank" 
                   class="flex items-center gap-2 bg-[#1877F2] text-white px-6 py-3 rounded-full font-bold shadow-[0_4px_12px_rgba(24,119,242,0.3)] hover:scale-105 transition-transform" style="text-decoration:none;">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Chia sẻ
                </a>
                <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" 
                        class="relative flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-6 py-3 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all cursor-pointer">
                    <span class="material-symbols-outlined" style="font-size:18px;">link</span> Copy Link
                    <span x-show="copied" x-transition style="display:none;" class="absolute -top-10 left-1/2 -translate-x-1/2 bg-[#1C1410] text-white text-xs px-2.5 py-1.5 rounded shadow-lg pointer-events-none whitespace-nowrap">Đã sao chép!</span>
                </button>
            </div>
        </div>



    </div>
</div>

<?php echo $__env->make('components.event-fab-menu', ['event' => $event], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
    // Countdown Timer logic
    const countdownEl = document.getElementById('t4-countdown');
    if (countdownEl) {
        const targetDateStr = countdownEl.getAttribute('data-date');
        const targetDate = new Date(targetDateStr).getTime();
        
        function updateTimer() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            
            if (diff < 0) {
                document.getElementById('t4-days').innerText = "00";
                document.getElementById('t4-hours').innerText = "00";
                document.getElementById('t4-mins').innerText = "00";
                document.getElementById('t4-secs').innerText = "00";
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('t4-days').innerText = String(days).padStart(2, '0');
            document.getElementById('t4-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('t4-mins').innerText = String(mins).padStart(2, '0');
            document.getElementById('t4-secs').innerText = String(secs).padStart(2, '0');
        }
        setInterval(updateTimer, 1000);
        updateTimer();
    }

    // Lượt thích
    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.dataset.eventId;
            const countSpan = document.getElementById('likes-count');

            fetch(`/events/${eventId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    if (data.liked) {
                        likeBtn.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
                        likeBtn.classList.add('bg-orange-50', 'text-[#f97316]', 'border-orange-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.add('font-fill');
                    } else {
                        likeBtn.classList.remove('bg-orange-50', 'text-[#f97316]', 'border-orange-200');
                        likeBtn.classList.add('bg-white', 'text-slate-700', 'border-slate-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.remove('font-fill');
                    }
                } else {
                    alert(data.message);
                }
            });
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/events/show-template4.blade.php ENDPATH**/ ?>