import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // Eski Node.js versiyonları için uyumluluk
    define: {
        global: 'globalThis',
        process: 'process',
    },
    resolve: {
        alias: {
            // Polyfills için
            crypto: 'crypto-browserify',
            buffer: 'buffer',
            process: 'process/browser',
        },
    },
    optimizeDeps: {
        include: ['crypto-browserify', 'buffer', 'process'],
    },
    build: {
        // Paylaşımlı hosting için optimize edilmiş ayarlar
        outDir: 'public/build',
        assetsDir: 'assets',
        manifest: true,
        rollupOptions: {
            output: {
                // Dosya boyutlarını küçült
                manualChunks: undefined,
                // Asset dosya isimlerini optimize et
                assetFileNames: 'assets/[name].[hash][extname]',
                chunkFileNames: 'assets/[name].[hash].js',
                entryFileNames: 'assets/[name].[hash].js',
            },
        },
        // Dosya boyutu uyarı limitini artır (paylaşımlı hosting için)
        chunkSizeWarningLimit: 1000,
        // CSS kod bölme
        cssCodeSplit: true,
        // Minification
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Console.log'ları kaldır
                drop_debugger: true,
            },
        },
    },
    // Development server ayarları (sadece yerel için)
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
