import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'; // Importa el plugin de React

export default defineConfig({
    plugins: [
        react(), // Solo una vez
        laravel({
            input: [
                // Estilos
                'resources/css/admin.css',
                'resources/css/menu.css',
                'resources/css/princess.css',
                'resources/css/portofino.css',
                'resources/css/style.css', // Si tienes más estilos, agrégalos aquí
                'resources/css/available-boats.css', // Si tienes más estilos, agrégalos aquí


                // Scripts
                'resources/js/componentes/app.jsx',
                'resources/js/slider.js',
                'resources/js/loadMoreImages.js',
                'resources/js/loadMoreDescription.js',
                'resources/js/loadMoreDescription2.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        extensions: ['.js', '.jsx'], // Resolver extensiones .js y .jsx
    },
    esbuild: {
        loader: 'jsx', // Configura loader como un string para procesar JSX
    },
    server: {
        hmr: {
            overlay: false, // Desactiva el overlay de errores
        },
    },
});
