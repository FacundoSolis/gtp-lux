import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';  // Importa el plugin de React

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx',  // Solo procesamos el archivo JSX con Vite
                // No agregamos los CSS aquí, ya que están en public/css
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
