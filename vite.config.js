import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    base: '/build/', // Define el base path si es necesario para producción
    plugins: [
        react(),
        laravel({
            input: [
                'resources/css/admin.css',
                'resources/css/app.css',
                'resources/css/available-boats.css',
                'resources/css/confirmation.css',
                'resources/css/menu.css',
                'resources/css/menuhome.css',
                'resources/css/normalize.css',
                'resources/css/opiniones.css',
                'resources/css/payment.css',
                'resources/css/portofino.css',
                'resources/css/princess.css',
                'resources/css/public.css',
                'resources/css/style.css',
                'resources/js/componentes/app.jsx',
                'resources/js/slider.js',
                'resources/js/loadMoreImages.js',
                'resources/js/loadMoreImages2.js',
                'resources/js/loadMoreDescription.js',
                'resources/js/loadMoreDescription2.js',
                'resources/js/syncddate.js',
                'resources/js/opiniones.js',
                'resources/js/listapreciosportofino.js',
                'resources/js/listapreciosprincess.js',
                'resources/js/menuhome.js',
                'resources/js/menu.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            // Opcional: define alias solo si es necesario
            '@': '/resources/js',
        },
        extensions: ['.js', '.jsx'], // Resolver extensiones .js y .jsx
    },
    esbuild: {
        loader: 'jsx', // Configura loader para JSX
    },
    server: {
        hmr: {
            overlay: false, // Desactiva el overlay de errores
        },
    },
});
