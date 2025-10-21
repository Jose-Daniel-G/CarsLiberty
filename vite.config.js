import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/common.css',  
                'resources/js/app.js',
                'resources/js/pages/dashboard.ts', 
                'resources/css/items.css',
                'resources/js/pages/delete-confirm.ts',
            ],
            refresh: true,
        }),
    ],
});
