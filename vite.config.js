import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import internalIp from 'internal-ip';

export default defineConfig(async () => {
    const ip = await internalIp.v4(); // Lấy địa chỉ IPv4 của máy
    return {
        server: {
            host: '0.0.0.0',
            hmr: {
                host: ip,
            },
        },
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'resources/js/jsadminlte/adminlte.js',
                    'resources/css/cssadminlte/adminlte.css',
                ],
                refresh: true,
            }),
            tailwindcss(),
        ],
    };
});
