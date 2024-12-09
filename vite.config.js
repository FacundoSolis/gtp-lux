import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx', 
                'resources/css/nadine.css',
                'resources/css/valkyrya.css',
                'resources/css/style.css',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        extensions: ['.js', '.jsx'], // Asegura que se resuelvan estos archivos
    },
    esbuild: {
        jsxFactory: 'React.createElement',
        jsxFragment: 'React.Fragment',
        loader: {
            '.js': 'jsx',    // Asegura que .js se trata como JSX
            '.jsx': 'jsx',   // Agrega soporte explícito para .jsx
        },
    },
});
