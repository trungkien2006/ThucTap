<?php $__env->startPush('styles'); ?>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<style>
/* Removed hide navbar rule to comply with layout rule */

:root {
    --navy: #1E3A8A;
    --blue: #2563EB;
    --blue-lt: rgba(37, 99, 235, 0.1);
    --gold: #D97706;
    --gold-lt: #FEF3C7;
    --bg: linear-gradient(135deg, #F0F4FF 0%, #E6EEFF 100%);
    --surface: rgba(255, 255, 255, 0.7);
    --ink: #0F172A;
    --soft: #334155;
    --muted: #64748B;
    --border: rgba(226, 232, 240, 0.8);
}

.t3-body {
    background: var(--bg) !important;
    background-attachment: fixed !important;
    color: var(--ink);
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    min-height: 100vh;
}

/* NAV */
.t3-nav {
    background: var(--navy);
    padding: 0 48px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 50;
}
.t3-nav-logo {
    color: #fff;
    font-weight: 800;
    font-size: 15px;
    letter-spacing: .05em;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.t3-nav-logo span {
    background: var(--blue);
    border-radius: 7px;
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    font-size: 13px;
    color: #fff;
}
.t3-nav-links {
    display: flex;
    gap: 28px;
}
.t3-nav-links a {
    color: rgba(255,255,255,.65);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: color .2s;
}
.t3-nav-links a:hover {
    color: #fff;
}
.t3-nav-cta {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 18px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s;
}
.t3-nav-cta:hover {
    background: #1e40af;
}

/* HERO */
.t3-hero {
    background: var(--navy);
    padding: 72px 48px 64px;
    position: relative;
    overflow: hidden;
}
.t3-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(29,78,216,.4) 0%, transparent 70%);
}
.t3-hero::after {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.05);
}
.t3-hero-inner {
    position: relative;
    max-width: 800px;
    z-index: 10;
}
.t3-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(29,78,216,.3);
    border: 1px solid rgba(29,78,216,.5);
    border-radius: 999px;
    padding: 5px 14px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: #93C5FD;
    margin-bottom: 20px;
}
.t3-hero-badge span {
    width: 6px;
    height: 6px;
    background: #4ADE80;
    border-radius: 50%;
    display: block;
}
.t3-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(32px, 4vw, 54px);
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -.02em;
    margin-bottom: 16px;
}
.t3-hero h1 em {
    font-style: italic;
    color: #93C5FD;
}
.t3-hero-sub {
    font-size: 15px;
    color: rgba(255,255,255,.6);
    max-width: 620px;
    line-height: 1.7;
    margin-bottom: 32px;
}
.t3-hero-meta {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 36px;
}
.t3-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.7);
    font-size: 13px;
}
.t3-hero-meta-item svg {
    width: 15px;
    height: 15px;
    color: #93C5FD;
}
.t3-hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.t3-btn-primary {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 12px 24px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background.15s;
}
.t3-btn-primary:hover {
    background: #1e40af;
}
.t3-btn-outline {
    background: rgba(255,255,255,.1);
    color: #fff;
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 10px;
    padding: 12px 24px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all .15s;
}
.t3-btn-outline:hover {
    background: rgba(255,255,255,.18);
}
.t3-hero-stats {
    display: flex;
    gap: 40px;
    padding-top: 36px;
    border-top: 1px solid rgba(255,255,255,.1);
    margin-top: 36px;
    flex-wrap: wrap;
}
.t3-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}
.t3-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,.45);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 3px;
}

/* COUNTDOWN */
.t3-countdown-bar {
    background: var(--blue);
    padding: 16px 48px;
    display: flex;
    align-items: center;
    gap: 32px;
    justify-content: center;
    flex-wrap: wrap;
}
.t3-cd-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: rgba(255,255,255,.7);
}
.t3-cd-units {
    display: flex;
    gap: 16px;
}
.t3-cd-unit {
    text-align: center;
}
.t3-cd-num {
    background: rgba(0,0,0,.2);
    color: #fff;
    font-size: 22px;
    font-weight: 800;
    border-radius: 8px;
    padding: 6px 14px;
    display: block;
    line-height: 1;
}
.t3-cd-unit-label {
    font-size: 10px;
    color: rgba(255,255,255,.6);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 4px;
}

.t3-scrollable-text {
    max-height: 180px;
    overflow-y: auto;
    padding-right: 8px;
    word-break: break-word;
}
.t3-scrollable-text::-webkit-scrollbar { width: 5px; }
.t3-scrollable-text::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); border-radius: 4px; }
.t3-scrollable-text::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 4px; }

/* CONTENT */
.t3-content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 60px 48px;
}
@media (max-width: 991px) {
    .t3-content {
        padding: 40px 24px;
    }
}
.t3-section-eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 10px;
}
.t3-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
    letter-spacing: -.01em;
}
.t3-section-body {
    color: var(--soft);
    line-height: 1.8;
    font-size: 14px;
}
.t3-section-body p + p {
    margin-top: 14px;
}

/* SPEAKERS */
.t3-speakers {
    margin-top: 48px;
}
.t3-speaker-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-top: 20px;
}
.t3-speaker-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all .2s;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-speaker-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(30, 58, 138, 0.08);
}
.t3-speaker-avatar {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    margin: 0 auto 12px;
    display: grid;
    place-items: center;
    font-size: 26px;
    background: var(--blue-lt);
    overflow: hidden;
}
.t3-speaker-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.t3-speaker-name {
    font-size: 14px;
    font-weight: 700;
}
.t3-speaker-role {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
}
.t3-speaker-topic {
    font-size: 11.5px;
    color: var(--blue);
    font-weight: 600;
    margin-top: 8px;
    padding: 4px 10px;
    background: var(--blue-lt);
    border-radius: 999px;
    display: inline-block;
}

/* SCHEDULE */
.t3-schedule {
    margin-top: 48px;
}
.t3-sched-item {
    display: flex;
    gap: 16px;
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
}
.t3-sched-item:last-child {
    border-bottom: none;
}
.t3-sched-time {
    width: 80px;
    font-size: 12px;
    font-weight: 700;
    color: var(--blue);
    flex-shrink: 0;
    padding-top: 2px;
}
.t3-sched-body {
    flex: 1;
}
.t3-sched-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
}
.t3-sched-speaker {
    font-size: 12px;
    color: var(--muted);
}
.t3-sched-tag {
    display: inline-block;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 999px;
    background: var(--gold-lt);
    color: var(--gold);
    margin-top: 6px;
    letter-spacing: .04em;
}

/* SIDEBAR */
.t3-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.t3-sidebar-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
}
.t3-sidebar-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: var(--muted);
}
.t3-sidebar-card-body {
    padding: 20px;
}
.t3-reg-price {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
}
.t3-reg-price span {
    font-family: 'Be Vietnam Pro', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: var(--muted);
}
.t3-reg-deadline {
    font-size: 12px;
    color: var(--muted);
    margin-top: 6px;
    margin-bottom: 20px;
}
.t3-reg-deadline strong {
    color: var(--ink);
}
.t3-btn-reg {
    width: 100%;
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 13px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    text-align: center;
    display: block;
    text-decoration: none;
    transition: background .15s;
}
.t3-btn-reg:hover {
    background: #1e40af;
}
.t3-info-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.t3-info-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}
.t3-info-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--blue-lt);
    display: grid;
    place-items: center;
    flex-shrink: 0;
    font-size: 14px;
}
.t3-info-label {
    font-size: 11px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: .06em;
}
.t3-info-value {
    font-size: 13.5px;
    font-weight: 600;
    margin-top: 1px;
}

/* FOOTER */
.t3-footer {
    background: var(--navy);
    color: rgba(255,255,255,.5);
    padding: 32px 48px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    flex-wrap: wrap;
    gap: 16px;
}
.t3-footer strong {
    color: #fff;
}
.t3-gallery-block {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 24px;
    align-items: center;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04);
    margin-top: 32px;
}
.t3-gallery-block.reverse {
    grid-template-columns: 1fr 1.2fr;
}
.t3-gallery-media {
    width: 100%;
    border-radius: 8px;
    object-fit: cover;
    aspect-ratio: 16/10;
    border: 1px solid var(--border);
}
@media (max-width: 768px) {
    .t3-gallery-block, .t3-gallery-block.reverse {
        grid-template-columns: 1fr !important;
        gap: 16px;
        padding: 16px;
    }
    .t3-gallery-media-col {
        order: -1;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php
    // Dynamically retrieve fonts and design custom styling overrides
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
    if (!empty($event->title_outline_width) && $event->title_outline_width != '0') {
        $outlineColor = $event->title_outline_color ?? '#000000';
        $titleStyles[] = "-webkit-text-stroke: {$event->title_outline_width}px {$outlineColor};";
        $titleStyles[] = "text-shadow: 0px 2px 4px rgba(0,0,0,0.5);";
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
<div class="t3-body">
    <!-- Navbar -->
    <nav class="t3-nav">
        <a href="<?php echo e(route('home')); ?>" class="t3-nav-logo">
            <span>U</span> UniEvent
        </a>
        <div class="t3-nav-links">
            <a href="<?php echo e(route('home')); ?>">Trang chủ</a>
            <a href="<?php echo e(route('home')); ?>#events">Sự kiện</a>
            <a href="<?php echo e(route('archive')); ?>">Lưu trữ</a>
        </div>
    </nav>

    <div class="t3-hero" style="<?php if($event->bannerImage): ?> background-image: linear-gradient(rgba(30,58,138,0.75), rgba(30,58,138,0.9)), url('<?php echo e(\App\Helpers\FileHelper::url($event->bannerImage->url)); ?>'); background-size: cover; background-position: center; <?php endif; ?>">
        <div class="t3-hero-inner">
            <div class="t3-hero-badge">
                <span></span> <?php echo e($event->category ? $event->category->name : 'Sự kiện học đường'); ?>

            </div>
            <h1 style="<?php echo $titleStyleStr; ?>"><?php echo nl2br(e($event->title)); ?></h1>
            <p class="t3-hero-sub" style="<?php echo $descStyleStr; ?>">
                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($event->description), 200)); ?>

            </p>
            <div class="t3-hero-meta">
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <?php echo e($event->event_date->translatedFormat('l, d/m/Y')); ?>

                </div>
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    <?php echo e($event->event_date->format('H:i')); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->end_date): ?> — <?php echo e($event->end_date->format('H:i')); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->location): ?>
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <?php echo e($event->location); ?>

                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="t3-hero-actions">
                <a href="#t3-schedule" class="t3-btn-outline">Xem chương trình</a>
            </div>
            <div class="t3-hero-stats">
                <div>
                    <div class="t3-stat-num"><?php echo e($event->speakers->count()); ?></div>
                    <div class="t3-stat-label">Diễn giả</div>
                </div>
                <div>
                    <div class="t3-stat-num"><?php echo e($event->views_count); ?></div>
                    <div class="t3-stat-label">Lượt xem</div>
                </div>
                <div>
                    <div class="t3-stat-num"><?php echo e($event->scheduleItems->count()); ?></div>
                    <div class="t3-stat-label">Hoạt động</div>
                </div>
                <div>
                    <div class="t3-stat-num"><?php echo e($event->likes_count); ?></div>
                    <div class="t3-stat-label">Yêu thích</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->event_date > now()): ?>
    <div class="t3-countdown-bar" id="countdown-wrapper" data-date="<?php echo e($event->event_date->format('Y-m-d\TH:i:s')); ?>">
        <div class="t3-cd-label">⏳ Còn lại</div>
        <div class="t3-cd-units">
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-days">00</span><div class="t3-cd-unit-label">Ngày</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-hours">00</span><div class="t3-cd-unit-label">Giờ</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-mins">00</span><div class="t3-cd-unit-label">Phút</div></div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Main Content Grid -->
    <div class="t3-content">
        <div class="t3-main-col">
            <!-- Thông tin chi tiết ngang -->
            <div style="display: flex; gap: 24px; flex-wrap: wrap; background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 24px; margin-bottom: 40px; box-shadow: 0 8px 32px rgba(30, 58, 138, 0.04); backdrop-filter: blur(12px);">
                <div class="t3-info-item" style="flex: 1; min-width: 200px;">
                    <div class="t3-info-icon">📅</div>
                    <div>
                        <div class="t3-info-label">Thời gian</div>
                        <div class="t3-info-value"><?php echo e($event->event_date->format('d/m/Y')); ?></div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->location): ?>
                <div class="t3-info-item" style="flex: 1; min-width: 200px;">
                    <div class="t3-info-icon">📍</div>
                    <div>
                        <div class="t3-info-label">Địa điểm</div>
                        <div class="t3-info-value"><?php echo e($event->location); ?></div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="t3-info-item" style="flex: 1; min-width: 200px;">
                    <div class="t3-info-icon">🏷️</div>
                    <div>
                        <div class="t3-info-label">Danh mục</div>
                        <div class="t3-info-value"><?php echo e($event->category ? $event->category->name : 'Sự kiện trường'); ?></div>
                    </div>
                </div>
            </div>

            <div class="t3-section-eyebrow">Giới thiệu</div>
            <h2 class="t3-section-title">Về sự kiện này</h2>
            <div class="t3-section-body">
                <?php echo $event->description; ?>

            </div>

            <!-- Hoạt động nổi bật (Gallery Blocks) -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->galleryImages->count() > 0): ?>
            <div style="margin-top: 48px;">
                <div class="t3-section-eyebrow">Hoạt động</div>
                <h2 class="t3-section-title">Nội dung chi tiết</h2>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="t3-gallery-block <?php echo e($index % 2 == 1 ? 'reverse' : ''); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index % 2 == 0): ?>
                            <div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->caption): ?>
                                    <h3 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; color: var(--navy);"><?php echo e($block->caption); ?></h3>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($block->content)): ?>
                                    <div class="t3-scrollable-text" style="color: var(--soft); font-size: 13.5px; line-height: 1.7;"><?php echo $block->content; ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="flex flex-wrap gap-2 mt-4">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->action_url): ?>
                                        <a href="<?php echo e($block->action_url); ?>" target="_blank" class="t3-btn-primary" style="padding: 6px 14px; font-size: 12px; border-radius: 6px; text-decoration: none;">Liên kết</a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                            <div class="t3-gallery-media-col">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->url): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->type === 'video'): ?>
                                        <video src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="t3-gallery-media" autoplay loop muted playsinline controls></video>
                                    <?php else: ?>
                                        <img src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="t3-gallery-media" alt="">
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="t3-gallery-media-col">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->url): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->type === 'video'): ?>
                                        <video src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="t3-gallery-media" autoplay loop muted playsinline controls></video>
                                    <?php else: ?>
                                        <img src="<?php echo e(\App\Helpers\FileHelper::url($block->url)); ?>" class="t3-gallery-media" alt="">
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->caption): ?>
                                    <h3 style="font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; margin-bottom: 8px; color: var(--navy);"><?php echo e($block->caption); ?></h3>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($block->content)): ?>
                                    <div class="t3-scrollable-text" style="color: var(--soft); font-size: 13.5px; line-height: 1.7;"><?php echo $block->content; ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="flex flex-wrap gap-2 mt-4">

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($block->action_url): ?>
                                        <a href="<?php echo e($block->action_url); ?>" target="_blank" class="t3-btn-primary" style="padding: 6px 14px; font-size: 12px; border-radius: 6px; text-decoration: none;">Liên kết</a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Speakers Section -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->speakers->count() > 0): ?>
            <div class="t3-speakers">
                <div class="t3-section-eyebrow">Diễn giả</div>
                <h2 class="t3-section-title">Chuyên gia tham dự</h2>
                <div class="t3-speaker-grid">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="t3-speaker-card">
                        <div class="t3-speaker-avatar">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($speaker->photo_url): ?>
                                <img src="<?php echo e(\App\Helpers\FileHelper::url($speaker->photo_url)); ?>" alt="<?php echo e($speaker->name); ?>">
                            <?php else: ?>
                                👨‍🏫
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="t3-speaker-name"><?php echo e($speaker->name); ?></div>
                        <div class="t3-speaker-role"><?php echo e($speaker->title); ?></div>
                        <div class="t3-speaker-topic"><?php echo e($speaker->bio ?? 'Diễn giả'); ?></div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Schedule Section -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->scheduleItems->count() > 0): ?>
            <div class="t3-schedule" id="t3-schedule">
                <div class="t3-section-eyebrow">Lịch trình</div>
                <h2 class="t3-section-title">Chương trình sự kiện</h2>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $event->scheduleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="t3-sched-item">
                        <div class="t3-sched-time"><?php echo e($item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : ''); ?><?php echo e($item->end_time ? ' - ' . \Carbon\Carbon::parse($item->end_time)->format('H:i') : ''); ?></div>
                        <div class="t3-sched-body">
                            <div class="t3-sched-title"><?php echo e($item->title); ?></div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->speaker): ?>
                                <div class="t3-sched-speaker">Diễn giả: <?php echo e($item->speaker->name); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->description): ?>
                                <div class="t3-sched-tag"><?php echo e($item->description); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Like & Share counter block -->
            <div class="p-6 rounded-2xl flex flex-wrap justify-center gap-4 mt-8 items-center" style="background:#F1F5F9; border:1px solid #E2E8F0;" x-data="{ copied: false }">
                <button id="like-btn" data-event-id="<?php echo e($event->id); ?>" class="bg-white hover:bg-slate-50 border px-6 py-3 rounded-full font-bold transition-all shadow-sm flex items-center gap-2 <?php echo e(session()->has('liked_events.' . $event->id) ? 'text-red-500 border-red-200' : 'text-slate-700 border-slate-200'); ?>">
                    <span class="material-symbols-outlined <?php echo e(session()->has('liked_events.' . $event->id) ? 'text-red-500 font-fill' : ''); ?>">favorite</span>
                    <span id="likes-count"><?php echo e($event->likes_count); ?></span> Lượt thích
                </button>
                <div class="bg-white border text-slate-700 px-6 py-3 rounded-full font-bold shadow-sm flex items-center gap-2 border-slate-200">
                    <span class="material-symbols-outlined text-[#07A0C3]">visibility</span>
                    <span><?php echo e($event->views_count); ?></span> Lượt xem
                </div>
                
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" target="_blank" 
                   class="flex items-center gap-2 bg-[#1877F2] text-white px-6 py-3 rounded-full font-bold shadow-[0_4px_12px_rgba(24,119,242,0.3)] hover:scale-105 transition-transform" style="text-decoration:none;">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" style="width:20px;height:20px;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Chia sẻ
                </a>
                <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)" 
                        class="relative flex items-center gap-2 bg-white text-slate-700 border border-slate-200 px-6 py-3 rounded-full font-bold shadow-sm hover:bg-slate-50 transition-all cursor-pointer">
                    <span class="material-symbols-outlined" style="font-size:18px;">link</span> Copy Link
                    <span x-show="copied" x-transition style="display:none;position:absolute;top:-40px;left:50%;transform:translateX(-50%);background:#1E3A8A;color:white;font-size:12px;padding:4px 8px;border-radius:4px;white-space:nowrap;">Đã sao chép!</span>
                </button>
            </div>

            <!-- Điều hướng Sự kiện Trước / Sau -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($previousEvent) || isset($nextEvent)): ?>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-200">
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($previousEvent) && $previousEvent): ?>
                    <a href="<?php echo e(route('events.show', $previousEvent->slug)); ?>" class="group block max-w-[280px] mr-auto" style="text-decoration:none;">
                        <div class="flex items-center text-slate-500 group-hover:text-blue-600 transition-colors mb-3">
                            <span class="material-symbols-outlined text-2xl -ml-1">arrow_left_alt</span>
                            <div class="h-[2px] bg-current flex-1"></div>
                        </div>
                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2 text-left" style="font-family:'Playfair Display', serif;font-size:18px;"><?php echo e($previousEvent->title); ?></h4>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="text-right">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($nextEvent) && $nextEvent): ?>
                    <a href="<?php echo e(route('events.show', $nextEvent->slug)); ?>" class="group block max-w-[280px] ml-auto" style="text-decoration:none;">
                        <div class="flex items-center text-slate-500 group-hover:text-blue-600 transition-colors mb-3">
                            <div class="h-[2px] bg-current flex-1"></div>
                            <span class="material-symbols-outlined text-2xl -mr-1">arrow_right_alt</span>
                        </div>
                        <h4 class="font-bold text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2 text-right" style="font-family:'Playfair Display', serif;font-size:18px;"><?php echo e($nextEvent->title); ?></h4>
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="t3-footer">
        <div>© <?php echo e(date('Y')); ?> <strong>UniEvent</strong> — Hệ thống quản lý sự kiện trường học</div>
        <div>Được xây dựng với phong cách chuyên nghiệp</div>
    </footer>
</div>

<?php echo $__env->make('components.event-fab-menu', ['event' => $event], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Javascript Countdown timer
    const cdWrapper = document.getElementById('countdown-wrapper');
    if (cdWrapper) {
        const targetDate = new Date(cdWrapper.getAttribute('data-date')).getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const diff = targetDate - now;
            
            if (diff < 0) {
                cdWrapper.style.display = 'none';
                return;
            }
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            
            document.getElementById('t3-days').innerText = String(days).padStart(2, '0');
            document.getElementById('t3-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('t3-mins').innerText = String(mins).padStart(2, '0');
        }
        
        setInterval(updateCountdown, 1000);
        updateCountdown();
    }

    // Like logic
    const likeBtn = document.getElementById('like-btn');
    if(likeBtn) {
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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    
                    if (data.liked) {
                        likeBtn.classList.remove('text-slate-700', 'border-slate-200');
                        likeBtn.classList.add('text-red-500', 'border-red-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.add('font-fill', 'text-red-500');
                    } else {
                        likeBtn.classList.remove('text-red-500', 'border-red-200');
                        likeBtn.classList.add('text-slate-700', 'border-slate-200');
                        likeBtn.querySelector('.material-symbols-outlined').classList.remove('font-fill', 'text-red-500');
                    }
                    
                    likeBtn.style.animation = 'pulse 0.5s ease-in-out';
                    setTimeout(() => likeBtn.style.animation = '', 500);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/events/show-template3.blade.php ENDPATH**/ ?>