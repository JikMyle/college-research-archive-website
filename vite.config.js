import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'public/js/scripts.js'],
            refresh: true,
        }),
    ],

    // server: {
    //     hmr: {
    //         host: '192.168.101.14',
    //     },
    // },
});