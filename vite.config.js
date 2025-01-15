import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    base: '/', // Define el base path si es necesario para producción
    plugins: [
        react(),
        laravel({
            input: [
                'resources/css/admin.css',
                'resources/css/app.css',
                'resources/css/public.css',
                'resources/js/componentes/app.jsx',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js', // Alias para facilitar las rutas
        },
        extensions: ['.js', '.jsx'], // Resolver extensiones .js y .jsx
    },
    esbuild: {
        loader: 'jsx', // Configura loader para JSX
    },
    build: {
        rollupOptions: {
            // Marca los módulos externos para evitar problemas de empaquetado
            external: [],
        },
    },
    server: {
        hmr: {
            overlay: false, // Desactiva el overlay de errores (útil en producción)
        },
    },
});
