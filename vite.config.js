import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => {
    const isProduction = command === 'build';
    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
                isProduction,
            }),
        ],
        build: {
            outDir: 'public/build',
            rollupOptions: {
                output: {
                    assetFileNames: '[name][extname]',
                    entryFileNames: 'app.js',
                },
            },
        },
    };
});