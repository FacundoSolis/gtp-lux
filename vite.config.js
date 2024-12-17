import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'; // Importa el plugin de React

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.css',  // Archivo CSS principal
                'resources/js/componentes/app.jsx',  // Entrada principal de React
                'resources/js/slider.js', 
                'resources/js/loadMoreImages.js', 
                'resources/js/loadMoreDescription.js', 
                'resources/js/loadMoreDescription2.js', 
                'resources/css/available-boats.css',  
                'resources/css/admin.css',
                'resources/css/menu.css',  
                'resources/css/portofino.css',  
                'resources/css/princess.css',  
                'resources/css/public.css',   
            ],
            refresh: true,
        }),
        react(), // Plugin para soportar React
    ],
    resolve: {
        extensions: ['.js', '.jsx'], // Resolver extensiones .js y .jsx
    },
    esbuild: {
        loader: 'jsx', // Configura loader como un string para procesar JSX
    },
});
