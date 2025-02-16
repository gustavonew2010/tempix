import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import i18n from 'laravel-vue-i18n/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        i18n(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        base: '/build/', // Removido protocolo HTTP e host para usar path relativo
        rollupOptions: {
            external: [
                '/assets/images/cert-begambleaware.svg',
                '/assets/images/cert-gt.pn.png',
                '/assets/images/cert-placeholder.png'
            ]
        }
    },
    resolve: {
        alias: {
            '@': '/resources/js',
            '~': '/resources/js',
            '@assets': '/public/assets'
        },
    },
    assetsInclude: ['**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.gif', '**/*.svg'],
});