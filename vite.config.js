import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [

        laravel({
            input: [
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/alpine.js',
            'resources/js/components/alerts.js',
            'resources/js/backMode.js',
            'resources/js/app/filterCategetory.js'
        ],
            refresh: true,
        }),
    ],
});
