@extends('layouts.frontend')

@push('styles')
@php
    $templateId = $event->page_template ?: 8;
    
    $presets = [
        8 => [
            'name' => 'Cyberpunk Neon',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Rajdhani:wght@500;700&display=swap',
            'font_family' => "'Rajdhani', sans-serif",
            'heading_font' => "'Orbitron', sans-serif",
            'navy' => '#0c051a',
            'blue' => '#bd00ff',
            'blue_lt' => 'rgba(189, 0, 255, 0.15)',
            'gold' => '#00ffcc',
            'gold_lt' => 'rgba(0, 255, 204, 0.15)',
            'bg' => '#090214',
            'surface' => '#130a24',
            'ink' => '#ffffff',
            'soft' => '#c8b9e6',
            'muted' => '#8874a3',
            'border' => '#bd00ff',
            'rounded' => '4px',
            'glow' => '0 0 15px rgba(189, 0, 255, 0.4)',
        ],
        9 => [
            'name' => 'Luxury Gold',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Montserrat:wght@400;600&display=swap',
            'font_family' => "'Montserrat', sans-serif",
            'heading_font' => "'Cinzel', serif",
            'navy' => '#0a0a0a',
            'blue' => '#d4af37',
            'blue_lt' => 'rgba(212, 175, 55, 0.12)',
            'gold' => '#aa8410',
            'gold_lt' => 'rgba(170, 132, 16, 0.15)',
            'bg' => '#0e0e0e',
            'surface' => '#161616',
            'ink' => '#f0e6d2',
            'soft' => '#c8bba3',
            'muted' => '#8f8269',
            'border' => '#3c3525',
            'rounded' => '8px',
            'glow' => '0 4px 20px rgba(212, 175, 55, 0.1)',
        ],
        10 => [
            'name' => 'Spring Pastel',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap',
            'font_family' => "'Quicksand', sans-serif",
            'heading_font' => "'Quicksand', sans-serif",
            'navy' => '#456254',
            'blue' => '#f3a8b5',
            'blue_lt' => '#fee8eb',
            'gold' => '#739d89',
            'gold_lt' => '#e3efea',
            'bg' => '#f9fbf9',
            'surface' => '#ffffff',
            'ink' => '#2b3931',
            'soft' => '#556c60',
            'muted' => '#8ca296',
            'border' => '#e6ede9',
            'rounded' => '24px',
            'glow' => '0 8px 30px rgba(243, 168, 181, 0.15)',
        ],
        11 => [
            'name' => 'Crimson Sport',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Teko:wght@600&family=Barlow:wght@600;800&display=swap',
            'font_family' => "'Barlow', sans-serif",
            'heading_font' => "'Teko', sans-serif",
            'navy' => '#151516',
            'blue' => '#e11d48',
            'blue_lt' => '#ffe4e6',
            'gold' => '#f59e0b',
            'gold_lt' => '#fef3c7',
            'bg' => '#1c1c1e',
            'surface' => '#2c2c2e',
            'ink' => '#ffffff',
            'soft' => '#d1d5db',
            'muted' => '#9ca3af',
            'border' => '#3a3a3c',
            'rounded' => '0px',
            'glow' => 'none',
        ],
        12 => [
            'name' => 'Ocean Breeze',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap',
            'font_family' => "'Outfit', sans-serif",
            'heading_font' => "'Outfit', sans-serif",
            'navy' => '#0f3443',
            'blue' => '#0083b0',
            'blue_lt' => '#e0f2fe',
            'gold' => '#0d9488',
            'gold_lt' => '#ccfbf1',
            'bg' => '#f0f9ff',
            'surface' => '#ffffff',
            'ink' => '#0f172a',
            'soft' => '#334155',
            'muted' => '#64748b',
            'border' => '#e0f2fe',
            'rounded' => '16px',
            'glow' => '0 4px 20px rgba(0, 131, 176, 0.08)',
        ],
        13 => [
            'name' => 'Vintage Typo',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Special+Elite&family=Courier+Prime:wght@400;700&display=swap',
            'font_family' => "'Courier Prime', monospace",
            'heading_font' => "'Special Elite', cursive",
            'navy' => '#3e2723',
            'blue' => '#5d4037',
            'blue_lt' => '#efebe9',
            'gold' => '#8d6e63',
            'gold_lt' => '#f5f5f5',
            'bg' => '#efebe9',
            'surface' => '#d7ccc8',
            'ink' => '#3e2723',
            'soft' => '#4e342e',
            'muted' => '#8d6e63',
            'border' => '#bcaaa4',
            'rounded' => '2px',
            'glow' => 'none',
        ],
        14 => [
            'name' => 'Aurora Lights',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Fira+Code:wght@500;700&display=swap',
            'font_family' => "'Fira Code', monospace",
            'heading_font' => "'Fira Code', monospace",
            'navy' => '#070f1e',
            'blue' => '#10b981',
            'blue_lt' => 'rgba(16, 185, 129, 0.15)',
            'gold' => '#84cc16',
            'gold_lt' => 'rgba(132, 204, 22, 0.15)',
            'bg' => '#070f1e',
            'surface' => '#0e1a30',
            'ink' => '#f0fdf4',
            'soft' => '#99f6e4',
            'muted' => '#4b5563',
            'border' => '#10b981',
            'rounded' => '6px',
            'glow' => '0 0 12px rgba(16, 185, 129, 0.3)',
        ],
        15 => [
            'name' => 'Glassmorphic Frost',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap',
            'font_family' => "'Plus Jakarta Sans', sans-serif",
            'heading_font' => "'Plus Jakarta Sans', sans-serif",
            'navy' => '#1e1b4b',
            'blue' => '#3b82f6',
            'blue_lt' => 'rgba(255,255,255,0.2)',
            'gold' => '#06b6d4',
            'gold_lt' => 'rgba(6, 182, 212, 0.15)',
            'bg' => '#311b92',
            'surface' => 'rgba(255, 255, 255, 0.08)',
            'ink' => '#ffffff',
            'soft' => '#e0e7ff',
            'muted' => '#a5b4fc',
            'border' => 'rgba(255, 255, 255, 0.12)',
            'rounded' => '16px',
            'glow' => 'none',
        ],
        16 => [
            'name' => 'Bubblegum Pop',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Quicksand:wght@700&display=swap',
            'font_family' => "'Quicksand', sans-serif",
            'heading_font' => "'Fredoka One', cursive",
            'navy' => '#831843',
            'blue' => '#ec4899',
            'blue_lt' => '#fce7f3',
            'gold' => '#eab308',
            'gold_lt' => '#fef9c3',
            'bg' => '#fff1f2',
            'surface' => '#ffffff',
            'ink' => '#500724',
            'soft' => '#9d174d',
            'muted' => '#f472b6',
            'border' => '#fce7f3',
            'rounded' => '32px',
            'glow' => '0 10px 0px rgba(236, 72, 153, 0.1)',
        ],
        17 => [
            'name' => 'Industrial Steel',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Chivo:wght@400;900&display=swap',
            'font_family' => "'Chivo', sans-serif",
            'heading_font' => "'Share Tech Mono', monospace",
            'navy' => '#374151',
            'blue' => '#4b5563',
            'blue_lt' => '#f3f4f6',
            'gold' => '#0f766e',
            'gold_lt' => '#ccfbf1',
            'bg' => '#f3f4f6',
            'surface' => '#ffffff',
            'ink' => '#111827',
            'soft' => '#374151',
            'muted' => '#9ca3af',
            'border' => '#e5e7eb',
            'rounded' => '4px',
            'glow' => 'none',
        ],
        18 => [
            'name' => 'Royal Grace',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Montserrat:wght@400;600&display=swap',
            'font_family' => "'Montserrat', sans-serif",
            'heading_font' => "'Playfair Display', serif",
            'navy' => '#1e3a8a',
            'blue' => '#1e3a8a',
            'blue_lt' => '#dbeafe',
            'gold' => '#b45309',
            'gold_lt' => '#fef3c7',
            'bg' => '#eff6ff',
            'surface' => '#ffffff',
            'ink' => '#1e3a8a',
            'soft' => '#1d4ed8',
            'muted' => '#93c5fd',
            'border' => '#bfdbfe',
            'rounded' => '12px',
            'glow' => '0 4px 30px rgba(30, 58, 138, 0.05)',
        ],
        19 => [
            'name' => 'Autumn Warmth',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,700;1,700&family=Cabin:wght@500;700&display=swap',
            'font_family' => "'Cabin', sans-serif",
            'heading_font' => "'Philosopher', sans-serif",
            'navy' => '#7c2d12',
            'blue' => '#ea580c',
            'blue_lt' => '#ffedd5',
            'gold' => '#854d0e',
            'gold_lt' => '#fef9c3',
            'bg' => '#fff7ed',
            'surface' => '#ffedd5',
            'ink' => '#431407',
            'soft' => '#7c2d12',
            'muted' => '#c2410c',
            'border' => '#fed7aa',
            'rounded' => '16px',
            'glow' => 'none',
        ],
        20 => [
            'name' => 'Emerald Leaf',
            'font_url' => 'https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Urbanist:wght@400;600&display=swap',
            'font_family' => "'Urbanist', sans-serif",
            'heading_font' => "'Cinzel Decorative', cursive",
            'navy' => '#064e3b',
            'blue' => '#059669',
            'blue_lt' => '#d1fae5',
            'gold' => '#b45309',
            'gold_lt' => '#fef3c7',
            'bg' => '#f0fdf4',
            'surface' => '#ffffff',
            'ink' => '#064e3b',
            'soft' => '#047857',
            'muted' => '#6ee7b7',
            'border' => '#a7f3d0',
            'rounded' => '20px',
            'glow' => '0 4px 20px rgba(6, 78, 59, 0.05)',
        ],
    ];

    $preset = $presets[$templateId] ?? $presets[8];
@endphp

@if(isset($preset['font_url']))
    <link href="{{ $preset['font_url'] }}" rel="stylesheet">
@endif

<style>
    /* Reset some default layout details to showcase the custom template */
    #navbar, .studio-footer {
        display: none !important;
    }

    :root {
        --navy: {{ $preset['navy'] }};
        --blue: {{ $preset['blue'] }};
        --blue-lt: {{ $preset['blue_lt'] }};
        --gold: {{ $preset['gold'] }};
        --gold-lt: {{ $preset['gold_lt'] }};
        --bg: {{ $preset['bg'] }};
        --surface: {{ $preset['surface'] }};
        --ink: {{ $preset['ink'] }};
        --soft: {{ $preset['soft'] }};
        --muted: {{ $preset['muted'] }};
        --border: {{ $preset['border'] }};
    }

    .t3-body {
        background: var(--bg) !important;
        color: var(--ink);
        font-family: {!! $preset['font_family'] !!}, sans-serif;
        font-size: 14px;
        line-height: 1.6;
        min-height: 100vh;
    }

    /* Glassmorphic override if template is 15 */
    @if($templateId == 15)
    .t3-body {
        background: linear-gradient(135deg, #1e1b4b 0%, #311b92 50%, #4a148c 100%) !important;
        background-attachment: fixed !important;
    }
    .t3-sidebar-card, .t3-speaker-card, .t3-sched-item, .p-6.rounded-2xl {
        background: rgba(255, 255, 255, 0.07) !important;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
    }
    @endif

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
        opacity: 0.9;
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
        background: radial-gradient(ellipse 70% 80% at 80% 50%, var(--blue) 0%, transparent 70%);
        opacity: 0.4;
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
        background: var(--blue-lt);
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 5px 14px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 20px;
    }
    .t3-hero-badge span {
        width: 6px;
        height: 6px;
        background: #4ade80;
        border-radius: 50%;
        display: block;
    }
    .t3-hero h1 {
        font-family: {!! $preset['heading_font'] !!}, sans-serif !important;
        font-size: clamp(32px, 4vw, 54px);
        font-weight: 700;
        color: #fff;
        line-height: 1.1;
        letter-spacing: -.02em;
        margin-bottom: 16px;
    }
    .t3-hero-sub {
        font-size: 15px;
        color: rgba(255,255,255,.7);
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
        color: rgba(255,255,255,.8);
        font-size: 13px;
    }
    .t3-hero-meta-item svg {
        width: 15px;
        height: 15px;
        color: var(--blue);
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
        transition: opacity .15s;
    }
    .t3-btn-primary:hover {
        opacity: 0.9;
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
        background: rgba(255,255,255,.2);
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
        font-family: {!! $preset['heading_font'] !!}, sans-serif !important;
        font-size: 28px;
        font-weight: 700;
        color: #fff;
        line-height: 1;
    }
    .t3-stat-label {
        font-size: 11px;
        color: rgba(255,255,255,.5);
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
        color: rgba(255,255,255,.9);
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
        color: rgba(255,255,255,.7);
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-top: 4px;
    }

    /* CONTENT */
    .t3-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 48px;
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 48px;
        align-items: start;
    }
    @media (max-width: 991px) {
        .t3-content {
            grid-template-columns: 1fr;
            padding: 40px 24px;
            gap: 32px;
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
        font-family: {!! $preset['heading_font'] !!}, sans-serif !important;
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
        border-radius: {{ $preset['rounded'] }};
        padding: 20px;
        text-align: center;
        transition: all .2s;
        box-shadow: {{ $preset['glow'] ?? 'none' }};
    }
    .t3-speaker-card:hover {
        transform: translateY(-2px);
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
        padding: 18px 20px;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
        border-radius: {{ $preset['rounded'] }};
        box-shadow: {{ $preset['glow'] ?? 'none' }};
        margin-bottom: 8px;
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
        border-radius: {{ $preset['rounded'] }};
        overflow: hidden;
        box-shadow: {{ $preset['glow'] ?? 'none' }};
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
        font-family: {!! $preset['heading_font'] !!}, sans-serif !important;
        font-size: 36px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
    }
    .t3-reg-price span {
        font-family: {!! $preset['font_family'] !!}, sans-serif;
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
        border-radius: {{ $preset['rounded'] }};
        padding: 13px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        display: block;
        text-decoration: none;
        transition: opacity .15s;
    }
    .t3-btn-reg:hover {
        opacity: 0.9;
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
        color: rgba(255,255,255,.6);
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
</style>
@endpush

@section('content')
<div class="t3-body">
    <!-- Navbar -->
    <nav class="t3-nav">
        <a href="{{ route('home') }}" class="t3-nav-logo">
            <span>U</span> UniEvent
        </a>
        <div class="t3-nav-links">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('home') }}#events">Sự kiện</a>
            <a href="{{ route('archive') }}">Lưu trữ</a>
        </div>
        <a href="#t3-register" class="t3-nav-cta">Đăng ký ngay</a>
    </nav>

    <!-- Hero -->
    <div class="t3-hero" style="@if($event->bannerImage) background-image: linear-gradient(rgba(15,32,68,0.7), rgba(15,32,68,0.85)), url('{{ \App\Helpers\FileHelper::url($event->bannerImage->url) }}'); background-size: cover; background-position: center; @endif">
        <div class="t3-hero-inner">
            <div class="t3-hero-badge">
                <span></span> {{ $event->category ? $event->category->name : 'Sự kiện học đường' }}
            </div>
            <h1>{!! nl2br(e($event->title)) !!}</h1>
            <p class="t3-hero-sub">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 200) }}
            </p>
            <div class="t3-hero-meta">
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    {{ $event->event_date->translatedFormat('l, d/m/Y') }}
                </div>
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    {{ $event->event_date->format('H:i') }} @if($event->end_date) — {{ $event->end_date->format('H:i') }} @endif
                </div>
                @if($event->location)
                <div class="t3-hero-meta-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $event->location }}
                </div>
                @endif
            </div>
            <div class="t3-hero-actions">
                <a href="#t3-register" class="t3-btn-primary">Đăng ký tham dự</a>
                <a href="#t3-schedule" class="t3-btn-outline">Xem chương trình</a>
            </div>
            <div class="t3-hero-stats">
                <div>
                    <div class="t3-stat-num">{{ $event->speakers->count() ?: 3 }}</div>
                    <div class="t3-stat-label">Diễn giả</div>
                </div>
                <div>
                    <div class="t3-stat-num">320+</div>
                    <div class="t3-stat-label">Đại biểu</div>
                </div>
                <div>
                    <div class="t3-stat-num">{{ $event->scheduleItems->count() ?: 6 }}</div>
                    <div class="t3-stat-label">Phiên thảo luận</div>
                </div>
                <div>
                    <div class="t3-stat-num">1</div>
                    <div class="t3-stat-label">Ngày</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown -->
    <div class="t3-countdown-bar">
        <div class="t3-cd-label">⏱ Còn lại</div>
        <div class="t3-cd-units">
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-days">00</span><div class="t3-cd-unit-label">Ngày</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-hours">00</span><div class="t3-cd-unit-label">Giờ</div></div>
            <div class="t3-cd-unit"><span class="t3-cd-num" id="t3-mins">00</span><div class="t3-cd-unit-label">Phút</div></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="t3-content">
        <div class="t3-main-col">
            <div class="t3-section-eyebrow">Giới thiệu</div>
            <h2 class="t3-section-title">Về sự kiện này</h2>
            <div class="t3-section-body">
                {!! $event->description !!}
            </div>

            <!-- Speakers Section -->
            @if($event->speakers->count() > 0)
            <div class="t3-speakers">
                <div class="t3-section-eyebrow">Diễn giả</div>
                <h2 class="t3-section-title">Chuyên gia tham dự</h2>
                <div class="t3-speaker-grid">
                    @foreach($event->speakers as $speaker)
                    <div class="t3-speaker-card">
                        <div class="t3-speaker-avatar">
                            @if($speaker->photo_url)
                                <img src="{{ \App\Helpers\FileHelper::url($speaker->photo_url) }}" alt="{{ $speaker->name }}">
                            @else
                                👨‍🏫
                            @endif
                        </div>
                        <div class="t3-speaker-name">{{ $speaker->name }}</div>
                        <div class="t3-speaker-role">{{ $speaker->title }}</div>
                        <div class="t3-speaker-topic">{{ $speaker->bio ?? 'Diễn giả khách mời' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Schedule Section -->
            @if($event->scheduleItems->count() > 0)
            <div class="t3-schedule" id="t3-schedule">
                <div class="t3-section-eyebrow">Lịch trình</div>
                <h2 class="t3-section-title">Chương trình sự kiện</h2>
                <div>
                    @foreach($event->scheduleItems as $item)
                    <div class="t3-sched-item">
                        <div class="t3-sched-time">{{ $item->start_time ? \Carbon\Carbon::parse($item->start_time)->format('H:i') : '' }}</div>
                        <div class="t3-sched-body">
                            <div class="t3-sched-title">{{ $item->title }}</div>
                            @if($item->speaker)
                                <div class="t3-sched-speaker">Diễn giả: {{ $item->speaker->name }}</div>
                            @endif
                            @if($item->description)
                                <div class="t3-sched-tag">{{ $item->description }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Like & Share counter block -->
            <div class="p-6 rounded-2xl flex flex-col sm:flex-row justify-center gap-4 mt-8 items-center" style="background:#F1F5F9; border:1px solid #E2E8F0;">
                <button id="like-btn" data-event-id="{{ $event->id }}" class="bg-white hover:bg-slate-50 border px-8 py-3 rounded-full font-bold transition-all shadow-sm flex items-center gap-2 {{ session()->has('liked_events.' . $event->id) ? 'text-red-500 border-red-200' : 'text-slate-700 border-slate-200' }}">
                    <span class="material-symbols-outlined {{ session()->has('liked_events.' . $event->id) ? 'text-red-500' : '' }} font-fill" style="font-variation-settings: 'FILL' 1">favorite</span>
                    <span id="likes-count">{{ $event->likes_count }}</span> Lượt thích
                </button>
                <div class="bg-white border text-slate-700 px-8 py-3 rounded-full font-bold shadow-sm flex items-center gap-2 border-slate-200">
                    <span class="material-symbols-outlined text-[#07A0C3]">visibility</span>
                    <span>{{ $event->views_count }}</span> Lượt xem
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="t3-sidebar" id="t3-register">
            <div class="t3-sidebar-card">
                <div class="t3-sidebar-card-header">Đăng ký</div>
                <div class="t3-sidebar-card-body">
                    <div class="t3-reg-price">Miễn phí <span>/ Tham gia</span></div>
                    <div class="t3-reg-deadline">Hạn đăng ký: <strong>{{ $event->event_date->subDays(2)->format('d/m/Y') }}</strong></div>
                    <a href="mailto:admin@school.edu?subject=Đăng ký tham gia {{ $event->title }}" class="t3-btn-reg">Đăng ký tham dự →</a>
                </div>
            </div>
            <div class="t3-sidebar-card">
                <div class="t3-sidebar-card-header">Thông tin chi tiết</div>
                <div class="t3-sidebar-card-body">
                    <div class="t3-info-list">
                        <div class="t3-info-item">
                            <div class="t3-info-icon">📅</div>
                            <div>
                                <div class="t3-info-label">Thời gian</div>
                                <div class="t3-info-value">{{ $event->event_date->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @if($event->location)
                        <div class="t3-info-item">
                            <div class="t3-info-icon">📍</div>
                            <div>
                                <div class="t3-info-label">Địa điểm</div>
                                <div class="t3-info-value">{{ $event->location }}</div>
                            </div>
                        </div>
                        @endif
                        <div class="t3-info-item">
                            <div class="t3-info-icon">👥</div>
                            <div>
                                <div class="t3-info-label">Quy mô</div>
                                <div class="t3-info-value">Hơn 300 đại biểu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Footer -->
    <footer class="t3-footer">
        <div>© 2026 <strong>UniEvent</strong> — Hệ thống quản lý sự kiện trường học</div>
        <div>Được thiết kế với phong cách: {{ $preset['name'] }}</div>
    </footer>
</div>

<script>
    const targetDate = new Date("{{ $event->event_date->toIso8601String() }}").getTime();
    
    function updateCountdown() {
        const now = new Date().getTime();
        const diff = targetDate - now;
        
        if (diff < 0) {
            document.getElementById('t3-days').innerText = "00";
            document.getElementById('t3-hours').innerText = "00";
            document.getElementById('t3-mins').innerText = "00";
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    countSpan.innerText = data.likes_count;
                    likeBtn.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
                    likeBtn.classList.add('text-red-500', 'border-red-200');
                    const icon = likeBtn.querySelector('.material-symbols-outlined');
                    icon.classList.add('text-red-500');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
</script>
@endsection
