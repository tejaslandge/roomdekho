@php($appearance = site_settings()->appearance())
<style>{!! site_theme_style() !!}
    body[data-rd-theme="dark"] {
        --color-soft: 15 16 32;
        --color-text-primary: 245 243 255;
        --color-text-secondary: 196 181 253;
    }
    body[data-rd-theme="dark"] {
        background-color: rgb(var(--color-soft));
        color: rgb(var(--color-text-primary));
    }
    body[data-rd-theme="dark"] .bg-white {
        background-color: #17182b;
    }
    body[data-rd-theme="dark"] .bg-soft {
        background-color: #0f1020;
    }
    body[data-rd-theme="dark"] .text-text-primary {
        color: #f5f3ff;
    }
    body[data-rd-theme="dark"] .text-text-secondary {
        color: #c4b5fd;
    }
    body[data-rd-theme="dark"] .border-gray-100,
    body[data-rd-theme="dark"] .border-gray-50 {
        border-color: #2a2b45;
    }
</style>
