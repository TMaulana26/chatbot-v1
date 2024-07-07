import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'resources/js/app.js'),
            },
            output: {
                entryFileNames: 'assets/app.js',
                chunkFileNames: 'assets/[name].js',
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'app.css') {
                        return 'assets/app.css';
                    }
                    return 'assets/[name].[ext]';
                },
            },
        },
        manifest: true,
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources'),
        },
    },
});