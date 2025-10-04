import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/portfolio.css', 
                'resources/css/login.css',
                'resources/js/app.js', 
                'resources/js/portfolio.js',
                'resources/css/zeescraper.css',
                'resources/css/zzzcraper.css',
                'resources/css/zzz_detail.css',
            ],
            refresh: true,
        }),
    ],
});
