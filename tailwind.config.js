import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                // Core palette — abc.html style
                "primary": "#0f172a",
                "brand-orange": "#f97316",
                "sidebar-bg": "#ffffff",
                "body-bg": "#f8fafc",

                // Surfaces
                "surface": "#f8fafc",
                "surface-container": "#f1f5f9",
                "surface-container-low": "#f8fafc",
                "surface-container-high": "#e2e8f0",
                "surface-container-highest": "#cbd5e1",
                "surface-container-lowest": "#ffffff",
                "surface-bright": "#ffffff",

                // On-surface
                "on-surface": "#0f172a",
                "on-surface-variant": "#475569",
                "on-background": "#0f172a",

                // Outline
                "outline": "#94a3b8",
                "outline-variant": "#e2e8f0",

                // Semantic
                "secondary": "#006875",
                "on-secondary": "#ffffff",
                "tertiary": "#334155",
                "on-tertiary": "#ffffff",

                // Legacy compat
                "deep-navy": "#0f172a",
                "fpt-orange": "#f97316",
                "pure-white": "#ffffff",
                "text-muted": "#64748b",
                "text-main": "#0f172a",

                // FPT Brand Colors
                "fpt-blue": "#07A0C3",
                "fpt-gold": "#FFE381",
                "fpt-green": "#04F06A",

                // Frontend Theme (Jasmine-dominant warm palette)
                "paper": "#FFFBEA",
                "ink": "#1C1410",
                "ink-soft": "#7A6A52",
                "azure": "#07A0C3",
                "azure-deep": "#04F06A",
                "azure-glow": "#FFE381",
                // Jasmine shades
                "jasmine": "#FFE381",
                "jasmine-light": "#FFF8D0",
                "jasmine-pale": "#FFFBEA",
                "jasmine-deep": "#E8C84A",
                "jasmine-warm": "#FFF3C4",

                // shadcn/ui colors
                background: "var(--background)",
                foreground: "var(--foreground)",
                card: {
                    DEFAULT: "var(--card)",
                    foreground: "var(--card-foreground)",
                },
                popover: {
                    DEFAULT: "var(--popover)",
                    foreground: "var(--popover-foreground)",
                },
                primary: {
                    DEFAULT: "var(--primary)",
                    foreground: "var(--primary-foreground)",
                },
                secondary: {
                    DEFAULT: "var(--secondary)",
                    foreground: "var(--secondary-foreground)",
                },
                muted: {
                    DEFAULT: "var(--muted)",
                    foreground: "var(--muted-foreground)",
                },
                accent: {
                    DEFAULT: "var(--accent)",
                    foreground: "var(--accent-foreground)",
                },
                destructive: {
                    DEFAULT: "var(--destructive)",
                    foreground: "var(--destructive-foreground)",
                },
                border: "var(--border)",
                input: "var(--input)",
                ring: "var(--ring)",
                sidebar: {
                    DEFAULT: "var(--sidebar)",
                    foreground: "var(--sidebar-foreground)",
                    primary: "var(--sidebar-primary)",
                    "primary-foreground": "var(--sidebar-primary-foreground)",
                    accent: "var(--sidebar-accent)",
                    "accent-foreground": "var(--sidebar-accent-foreground)",
                    border: "var(--sidebar-border)",
                    ring: "var(--sidebar-ring)",
                },
            },
            borderRadius: {
                DEFAULT: "0.5rem",
                lg: "0.75rem",
                xl: "1rem",
                "2xl": "1rem",
                "3xl": "1.5rem",
                full: "9999px",
            },
            spacing: {
                base: "4px",
                xs: "0.5rem",
                sm: "1rem",
                md: "1.5rem",
                lg: "2rem",
                xl: "3rem",
                gutter: "24px",
                "margin-mobile": "16px",
                "margin-desktop": "48px",
                "container-max": "1280px",
            },
            fontFamily: {
                heading: ['"Hanken Grotesk"', 'sans-serif'],
                body: ['"Inter"', 'sans-serif'],
                sans: ['"Inter"', ...defaultTheme.fontFamily.sans],
                barlow: ['"Barlow"', 'sans-serif'],
                "barlow-condensed": ['"Barlow Condensed"', 'sans-serif'],
                // Legacy compat
                "headline-md": ['"Inter"'],
                "headline-lg": ['"Inter"'],
                "headline-sm": ['"Inter"'],
                "body-md": ['"Inter"'],
                "body-sm": ['"Inter"'],
                "body-lg": ['"Inter"'],
                "label-md": ['"Inter"'],
                "label-sm": ['"Inter"'],
                "label-lg": ['"Inter"'],
                "display-lg": ['"Inter"'],
            },
            fontSize: {
                "headline-lg": ["32px", { lineHeight: "1.2", letterSpacing: "-0.01em", fontWeight: "700" }],
                "headline-md": ["24px", { lineHeight: "1.3", fontWeight: "600" }],
                "headline-sm": ["20px", { lineHeight: "1.4", fontWeight: "600" }],
                "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                "body-md": ["16px", { lineHeight: "1.5", fontWeight: "400" }],
                "body-sm": ["14px", { lineHeight: "1.5", fontWeight: "400" }],
                "label-lg": ["14px", { lineHeight: "1", letterSpacing: "0.02em", fontWeight: "600" }],
                "label-md": ["14px", { lineHeight: "1", letterSpacing: "0.05em", fontWeight: "600" }],
                "label-sm": ["12px", { lineHeight: "1", fontWeight: "500" }],
                "display-lg": ["48px", { lineHeight: "1.1", letterSpacing: "-0.02em", fontWeight: "800" }],
            },
            boxShadow: {
                "card": "0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)",
                "card-hover": "0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.05)",
                "drawer": "10px 0 30px -5px rgb(0 0 0 / 0.08)",
                "nav": "0 1px 3px 0 rgb(0 0 0 / 0.05)",
            },
        },
    },

    plugins: [forms, require('@tailwindcss/container-queries')],
};
