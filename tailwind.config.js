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
                "surface-container": "#edeeef", "surface-container-lowest": "#ffffff", "on-tertiary-container": "#00334b", "on-primary-container": "#541f00", "on-secondary-fixed-variant": "#633f0d", "secondary-container": "#fdc88a", "on-primary-fixed-variant": "#793000", "on-secondary": "#ffffff", "surface-container-low": "#f3f4f5", "surface-gray": "#F4F6F8", "on-error": "#ffffff", "surface-variant": "#e1e3e4", "pure-white": "#FFFFFF", "on-tertiary-fixed": "#001e2f", "error": "#ba1a1a", "surface-bright": "#f8f9fa", "on-tertiary-fixed-variant": "#004c6e", "tertiary-fixed-dim": "#88ceff", "primary-fixed-dim": "#ffb692", "surface-tint": "#9f4200", "on-surface": "#191c1d", "on-secondary-container": "#78521f", "primary": "#9f4200", "inverse-primary": "#ffb692", "outline-variant": "#dfc0b2", "secondary-fixed": "#ffddb8", "on-primary": "#ffffff", "secondary-fixed-dim": "#f1bd80", "primary-container": "#f27123", "on-surface-variant": "#584238", "on-background": "#191c1d", "surface-dim": "#d9dadb", "primary-fixed": "#ffdbcb", "on-secondary-fixed": "#2b1700", "surface-container-highest": "#e1e3e4", "tertiary": "#006590", "secondary": "#7e5623", "surface": "#f8f9fa", "inverse-surface": "#2e3132", "inverse-on-surface": "#f0f1f2", "on-error-container": "#93000a", "on-primary-fixed": "#341100", "tertiary-container": "#429fd6", "tertiary-fixed": "#c8e6ff", "deep-navy": "#1A237E", "text-main": "#121212", "background": "#f8f9fa", "fpt-orange": "#F27123", "error-container": "#ffdad6", "surface-container-high": "#e7e8e9", "on-tertiary": "#ffffff", "outline": "#8c7266", "text-muted": "#637381",
                "fpt-blue": "#103A71",
            },
            borderRadius: {
                DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", "2xl": "1.5rem", "3xl": "1.5rem", full: "9999px"
            },
            spacing: {
                base: "8px", "margin-mobile": "16px", "container-max": "1280px", "margin-desktop": "48px", gutter: "24px"
            },
            fontFamily: {
                "headline-md": ["Be Vietnam Pro"], "body-sm": ["Be Vietnam Pro"], "display-lg-mobile": ["Be Vietnam Pro"], "headline-lg-mobile": ["Be Vietnam Pro"], "label-lg": ["Be Vietnam Pro"], "body-md": ["Be Vietnam Pro"], "label-sm": ["Be Vietnam Pro"], "body-lg": ["Be Vietnam Pro"], "headline-lg": ["Be Vietnam Pro"], "display-lg": ["Be Vietnam Pro"], headline: ["Be Vietnam Pro"], display: ["Be Vietnam Pro"], body: ["Be Vietnam Pro"], label: ["Be Vietnam Pro"],
                sans: ['Be Vietnam Pro', 'Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('@tailwindcss/container-queries')],
};
