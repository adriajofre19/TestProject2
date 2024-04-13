import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            // ssr: 'resources/js/ssr.js',
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
    ],
    test: {
        globals: true,
        environmentMatchGlobs: [
            ["tests/Feature/prova.test.js", "node"],
            ["tests/Feature/AdriaAxiosTest.test.js", "node"],
            ['tests/Feature/**' , 'jsdom'],
        ],
    },
    // ssr: {
    //     noExternal: ['@inertiajs/server'],
    // },
    // server: {
    //     host: 'localhost',
    // }
});