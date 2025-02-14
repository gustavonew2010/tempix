import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import i18n from 'laravel-vue-i18n/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                base: null,
                includeAbsolute: false
            }
        }),
        i18n(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        https: true, // Habilitar HTTPS
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        base: 'https://tempix.bet/build/', // URL completa com HTTPS
    },
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    }
});