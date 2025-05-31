import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/admin-app.css', 'resources/js/admin-app.js', 'resources/css/web.css', 'resources/js/web.js'],
            refresh: true,
        }),
    ],
});
