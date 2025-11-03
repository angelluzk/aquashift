import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

    server: {
            // Garante que o Vite escute em todas as interfaces de rede (essencial para o Docker)
            host: true, 

            // Configura o HMR (Hot Module Replacement) para funcionar corretamente
            hmr: {
                host: 'localhost',
            },

            watch: {
                // Força o Vite a verificar ativamente os arquivos em vez de esperar por eventos
                usePolling: true,
            }
        }
});