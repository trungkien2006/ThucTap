<?php $__env->startPush('styles'); ?>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --school-bg: #F8FAFC;
    --school-primary: #1E3A8A; /* Navy Blue */
    --school-secondary: #3B82F6; /* Bright Blue */
    --school-accent: #F59E0B; /* Gold/Amber */
    --school-text: #1E293B;
    --school-muted: #64748B;
    --school-card: #FFFFFF;
    --school-border: #E2E8F0;
    
    --container-w: 1000px;
}

body { background-color: #f1f5f9; }

.w6-body {
    background: var(--school-bg);
    color: var(--school-text);
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 1.6;
    min-height: 100vh;
}

/* CONTAINER */
.w6-container {
    max-width: var(--container-w);
    margin: 0 auto;
    background: var(--school-card);
    min-height: 100vh;
    box-shadow: 0 0 40px rgba(0,0,0,0.05);
    padding-bottom: 60px;
}

/* HERO SECTION */
.w6-hero {
    position: relative;
    width: 100%;
    background: var(--school-primary);
    overflow: hidden;
}
.w6-hero-bg {
    width: 100%;
    height: 400px;
    object-fit: cover;
    opacity: 0.8;
}
.w6-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, var(--school-primary) 0%, rgba(30,58,138,0.4) 100%);
}
.w6-hero-content {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    padding: 40px 30px;
    text-align: center;
    color: #fff;
    z-index: 10;
}
.w6-hero-badge {
    display: inline-block;
    background: var(--school-accent);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 20px;
    margin-bottom: 16px;
    letter-spacing: 1px;
}
.w6-hero h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: clamp(28px, 5vw, 42px);
    line-height: 1.2;
    margin-bottom: 16px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.w6-hero-meta {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    font-size: 14px;
    font-weight: 500;
    color: #e2e8f0;
}
.w6-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
}
.w6-hero-meta-item svg { width: 18px; height: 18px; color: var(--school-accent); }

/* COUNTDOWN */
.w6-cd-bar {
    background: var(--school-secondary);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
    padding: 20px;
}
.w6-cd-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.w6-cd-units { display: flex; gap: 15px; }
.w6-cd-unit { text-align: center; }
.w6-cd-num {
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    padding: 5px 12px;
    min-width: 50px;
}
.w6-cd-label { font-size: 11px; text-transform: uppercase; margin-top: 4px; opacity: 0.9; }

/* CONTENT BLOCKS */
.w6-content-wrap {
    padding: 40px 30px;
}
.w6-section-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    color: var(--school-primary);
    text-align: center;
    margin-bottom: 30px;
    position: relative;
    text-transform: uppercase;
}
.w6-section-title::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: var(--school-accent);
    margin: 12px auto 0;
    border-radius: 2px;
}
.w6-desc {
    color: var(--school-muted);
    text-align: center;
    font-weight: bold;
    line-height: 1.8;
    font-size: 15px;
    margin-bottom: 40px;
}

/* GALLERY (CARDS) */
.w6-gallery {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-bottom: 50px;
}
.w6-gallery-block {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 40px;
    align-items: center;
    margin-bottom: 60px;
    background: #f8fafc;
    padding: 30px;
    border-radius: 20px;
    border: 1px solid var(--school-border);
}
.w6-gallery-block.reverse {
    grid-template-columns: 1.2fr 1fr;
}
.w6-gallery-media-col {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
}
@media (max-width: 768px) {
    .w6-gallery-block, .w6-gallery-block.reverse {
        grid-template-columns: 1fr !important;
        gap: 16px;
        padding: 16px;
    }
    .w6-gallery-media-col {
        order: -1;
    }
}
.w6-gal-media {
    width: 100%; height: auto;
    display: block;
    border-radius: 12px;
}
.w6-scrollable-text {
    max-height: 200px;
    overflow-y: auto;
    padding-right: 8px;
}
.w6-scrollable-text::-webkit-scrollbar { width: 5px; }
.w6-scrollable-text::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); border-radius: 4px; }
.w6-scrollable-text::-webkit-scrollbar-thumb { background: var(--school-primary); border-radius: 4px; }

/* SPEAKERS */
.w6-speakers {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 50px;
}
.w6-speaker-card {
    text-align: center;
    padding: 20px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid var(--school-border);
    transition: transform 0.2s;
}
.w6-speaker-card:hover { transform: translateY(-5px); }
.w6-speaker-img {
    width: 100px; height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--school-secondary);
    margin: 0 auto 15px;
    padding: 3px;
    background: #fff;
}
.w6-speaker-name {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 16px;
    color: var(--school-primary);
}
.w6-speaker-role { font-size: 13px; color: var(--school-muted); margin-top: 4px; }

/* SCHEDULE */
.w6-schedule { margin-bottom: 50px; }
.w6-sch-item {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    background: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    border-left: 4px solid var(--school-accent);
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.w6-sch-time {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    color: var(--school-primary);
    min-width: 60px;
    flex-shrink: 0;
}
.w6-sch-info h4 { font-weight: 600; font-size: 16px; margin: 0 0 4px; }
.w6-sch-info p { font-size: 13px; color: var(--school-muted); margin: 0; }

/* PREV/NEXT EVENTS */
.w6-nav-events {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 50px;
    padding-top: 30px;
    border-top: 1px solid var(--school-border);
}
.w6-nav-item {
    display: block;
    text-decoration: none;
    color: var(--school-text);
    padding: 15px;
    border-radius: 8px;
    transition: background 0.2s;
}
.w6-nav-item:hover {
    background: #f8fafc;
}
.w6-nav-label {
    font-size: 11px;
    text-transform: uppercase;
    color: var(--school-muted);
    font-weight: 700;
    margin-bottom: 4px;
}
.w6-nav-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 15px;
}

/* BOTTOM BAR */
.w6-bottom {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    padding-top: 20px;
    border-top: 1px solid var(--school-border);
}
.w6-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    border-radius: 30px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
    text-decoration: none;
    background: var(--school-primary);
    color: #fff;
}
.w6-btn-like {
    background: #fff;
    color: var(--school-primary);
    border: 1px solid var(--school-primary);
}
.w6-btn-like.liked {
    background: var(--school-primary);
    color: #fff;
}
.w6-btn-views {
    background: #f1f5f9;
    color: var(--school-muted);
}
.w6-btn-share {
    background: #1877F2;
    color: #fff;
}
.w6-btn-copy {
    background: #fff;
    color: var(--school-text);
    border: 1px solid var(--school-border);
    position: relative;
}

.w6-footer {
    text-align: center;
    padding: 20px;
    font-size: 13px;
    color: var(--school-muted);
    background: #e2e8f0;
}

@media (max-width: 768px) {
    .w6-hero-bg { height: 300px; }
    .w6-hero-content { position: relative; padding: 24px 16px; background: var(--school-primary); }
    .w6-cd-bar { flex-direction: column; gap: 12px; text-align: center; }
    .w6-content-wrap { padding: 24px 16px; }
}
@media (max-width: 480px) {
    .w6-hero-bg { height: 220px; }
    .w6-nav-events { grid-template-columns: 1fr; gap: 12px; }
    .w6-sch-item { flex-direction: column; gap: 8px; }
    .w6-bottom { flex-direction: column; width: 100%; }
    .w6-bottom .w6-btn { width: 100%; justify-content: center; }
}
</style>
<?php $__env->stopPush(); ?>

<?php
    $titleStyles = [];
    if (!empty($event->title_font_family)) {
        $titleStyles[] = "font-family: '{$event->title_font_family}', sans-serif;";
    }
    if (!empty($event->title_font_size)) {
        $titleStyles[] = "font-size: {$event->title_font_size}px;";
    }
    if (!empty($event->title_color)) {
        $titleStyles[] = "color: {$event->title_color} !important;";
    }
    $titleStyleStr = implode(' ', $titleStyles);

    $descStyles = [];
    if (!empty($event->desc_font_family)) {
        $descStyles[] = "font-family: '{$event->desc_font_family}', sans-serif;";
    }
    if (!empty($event->desc_font_size)) {
        $descStyles[] = "font-size: {$event->desc_font_size}px;";
    }
    if (!empty($event->desc_color)) {
        $descStyles[] = "color: {$event->desc_color} !important;";
    }
    $descStyleStr = implode(' ', $descStyles);
?>

<?php $__env->startSection('content'); ?>
<div class="w6-body">
    <div class="w6-container">
        
        
        <div class="w6-hero">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->bannerImage): ?>
                <img src="<?php echo e(\App\Helpers\FileHelper::url($event->bannerImage->url)); ?>" class="w6-hero-bg" alt="<?php echo e($event->title); ?>">
            <?php else: ?>
                <div class="w6-hero-bg" style="background:#1E3A8A;"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="w6-hero-overlay"></div>
            <div class="w6-hero-content">
                <div class="w6-hero-badge"><?php echo e($event->category ? $event->category->name : 'Sự kiện trường'); ?></div>
                <h1 style="<?php echo $titleStyleStr; ?>"><?php echo nl2br(e($event->title)); ?></h1>
                <div class="w6-hero-meta">
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <?php echo e($event->event_date->format('d/m/Y')); ?>

                    </div>
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        <?php echo e($event->event_date->format('H:i')); ?> 
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->end_date): ?> — <?php echo e($event->end_date->format('H:i')); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->location): ?>
                    <div class="w6-hero-meta-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <?php echo e($event->location); ?>

                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->event_date > now()): ?>
        <div class="w6-cd-bar">
            <div class="w6-cd-title">Sự kiện sẽ bắt đầu sau</div>
            <div class="w6-cd-units" id="w6-countdown" data-date="<?php echo e($event->event_date->format('Y-m-d\TH:i:s')); ?>">
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-days">00</span><div class="w6-cd-label">Ngày</div></div>
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-hours">00</span><div class="w6-cd-label">Giờ</div></div>
                <div class="w6-cd-unit"><span class="w6-cd-num" id="w6-mins">00</span><div class="w6-cd-label">Phút</div></div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="w6-content-wrap">
            
            <h2 class="w6-section-title">Giới Thiệu</h2>
            <div class="w6-desc" style="<?php echo $descStyleStr; ?>">
                <?php echo $event->description; ?>

            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->galleryImages->count() > 0 && ($event->event_date <= now() || request()->routeIs('admin.events.template_preview'))): ?>
            <h2 class="w6-section-title">Khoảnh Khắc Nổi Bật</h2>
            <div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="w6-gallery-block <?php echo e($index % 2 == 1 ? 'reverse' : ''); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index % 2 == 0): ?>
                        <div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($block->content)): ?>
                                <h3 style="font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; color: var(--school-primary);"><?php echo $block->content; ?></h3>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->caption): ?>
                                <div class="w6-scrollable-text" style="color: var(--school-muted); font-size: 14px; line-height: 1.7;"><?php echo e($block->caption); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="flex flex-wrap gap-2 mt-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->action_url): ?>
                                    <a href="<?php echo e($block->action_url); ?>" target="_blank" class="w6-btn" style="padding: 6px 14px; font-size: 12px; border-radius: 6px; text-decoration: none;">Liên kết</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <div class="w6-gallery-media-col">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->url): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->type === 'video'): ?>
                                    <video src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="w6-gal-media" autoplay loop muted playsinline controls></video>
                                <?php else: ?>
                                    <img src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="w6-gal-media" alt="">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="w6-gallery-media-col">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->url): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->type === 'video'): ?>
                                    <video src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="w6-gal-media" autoplay loop muted playsinline controls></video>
                                <?php else: ?>
                                    <img src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="w6-gal-media" alt="">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($block->content)): ?>
                                <h3 style="font-family: 'Montserrat', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; color: var(--school-primary);"><?php echo $block->content; ?></h3>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->caption): ?>
                                <div class="w6-scrollable-text" style="color: var(--school-muted); font-size: 14px; line-height: 1.7;"><?php echo e($block->caption); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="flex flex-wrap gap-2 mt-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->action_url): ?>
                                    <a href="<?php echo e($block->action_url); ?>" target="_blank" class="w6-btn" style="padding: 6px 14px; font-size: 12px; border-radius: 6px; text-decoration: none;">Liên kết</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->speakers->count() > 0): ?>
            <h2 class="w6-section-title">Diễn giả tham gia</h2>
            <div class="w6-speakers">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="w6-speaker-card">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->photo_url): ?>
                        <img src="<?php echo e(\App\Helpers\FileHelper::url($speaker->photo_url)); ?>" class="w6-speaker-img" alt="<?php echo e($speaker->name); ?>">
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" class="w6-speaker-img" alt="<?php echo e($speaker->name); ?>">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="w6-speaker-name"><?php echo e($speaker->name); ?></div>
                    <div class="w6-speaker-role"><?php echo e($speaker->title); ?></div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->scheduleItems->count() > 0): ?>
            <h2 class="w6-section-title">Lịch Trình</h2>
            <div class="w6-schedule" x-data="{ activeIndex: 0 }">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mt-6">
                    <!-- Left panel: Time slots selector -->
                    <div class="md:col-span-4 flex md:flex-col gap-2 overflow-x-auto md:overflow-x-visible pb-3 md:pb-0 scrollbar-none" style="-ms-overflow-style: none; scrollbar-width: none;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->scheduleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <button 
                            @click="activeIndex = <?php echo e($index); ?>"
                            :class="activeIndex === <?php echo e($index); ?> ? 'bg-[#ff5a36] text-white border-[#ff5a36]' : 'bg-white/5 text-white/80 hover:bg-white/10 border-white/10'"
                            class="flex items-center justify-center md:justify-start gap-3 px-4 py-3 rounded-xl border text-sm font-bold transition-all shrink-0 w-auto md:w-full text-left"
                        >
                            <span class="material-symbols-outlined text-[18px]">schedule</span>
                            <span><?php echo e($item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : ''); ?><?php echo e($item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : ''); ?></span>
                        </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    <!-- Right panel: Content corresponding to chosen time slot -->
                    <div class="md:col-span-8 bg-white/5 border border-white/10 rounded-xl p-6 min-h-[160px] flex flex-col justify-center text-left">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->scheduleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div x-show="activeIndex === <?php echo e($index); ?>" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#ff5a36]/20 text-[#ff5a36] mb-3">
                                    <span class="material-symbols-outlined text-[14px]">schedule</span>
                                    <?php echo e($item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : ''); ?><?php echo e($item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : ''); ?>

                                </span>
                                <h3 class="font-extrabold text-xl text-white tracking-tight leading-tight"><?php echo e($item->title); ?></h3>
                            </div>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->speaker): ?>
                            <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10 w-fit">
                                <img src="<?php echo e($item->speaker->photo_url ? asset($item->speaker->photo_url) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80'); ?>"
                                     alt="<?php echo e($item->speaker->name); ?>" class="w-10 h-10 rounded-full object-cover border border-white/10 shadow-sm">
                                <div>
                                    <div class="font-bold text-sm text-white leading-none mb-1 text-left"><?php echo e($item->speaker->name); ?></div>
                                    <div class="text-xs text-white/60 leading-none text-left"><?php echo e($item->speaker->title ?? 'Diễn giả'); ?></div>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                            <p class="text-white/80 text-sm leading-relaxed whitespace-pre-line"><?php echo e($item->description); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            


            
            <div class="w6-bottom" x-data="{ copied: false }">
                <button id="like-btn" data-event-id="<?php echo e($event->id); ?>" class="w6-btn w6-btn-like <?php echo e(session()->has('liked_events.' . $event->id) ? 'liked' : ''); ?>">
                    <span class="material-symbols-outlined">favorite</span>
                    <span id="likes-count"><?php echo e($event->likes_count); ?></span> Thích
                </button>
                <div class="w6-btn w6-btn-views">
                    <span class="material-symbols-outlined">visibility</span>
                    <?php echo e($event->views_count); ?> Lượt xem
                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" target="_blank" class="w6-btn w6-btn-share">
                    Chia sẻ
                </a>
                <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" class="w6-btn w6-btn-copy">
                    <span class="material-symbols-outlined" style="font-size:18px;">link</span> Copy Link
                    <span x-show="copied" x-transition style="display:none;position:absolute;bottom:110%;left:50%;transform:translateX(-50%);background:#1E293B;color:white;font-size:12px;padding:4px 8px;border-radius:4px;white-space:nowrap;">Đã sao chép!</span>
                </button>
            </div>
        </div>
        
    </div>
    
    <footer class="w6-footer">
        © <?php echo e(date('Y')); ?> UniEvent — Hệ thống quản lý sự kiện học đường
    </footer>
</div>

<?php echo $__env->make('components.event-fab-menu', ['event' => $event], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
    const cdEl = document.getElementById('w6-countdown');
    if (cdEl) {
        const targetDate = new Date(cdEl.getAttribute('data-date')).getTime();
        function updateCountdown() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            if (diff < 0) {
                document.getElementById('w6-days').innerText = "00";
                document.getElementById('w6-hours').innerText = "00";
                document.getElementById('w6-mins').innerText = "00";
                return;
            }
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById('w6-days').innerText = String(days).padStart(2, '0');
            document.getElementById('w6-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('w6-mins').innerText = String(mins).padStart(2, '0');
        }
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const eventId = this.dataset.eventId;
            const countSpan = document.getElementById('likes-count');
            fetch(`/events/${eventId}/like`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    if (data.liked) {
                        likeBtn.classList.add('liked');
                    } else {
                        likeBtn.classList.remove('liked');
                    }
                }
            })
            .catch(err => console.error(err));
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/events/show-template5.blade.php ENDPATH**/ ?>