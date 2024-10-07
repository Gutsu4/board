import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel(['resources/css/app.css', 'resources/js/app.js'])],
    server: {
        host: '0.0.0.0', // 全てのネットワークインターフェースからのアクセスを許可
        port: 5173, // 任意のポート番号
        hmr: {
            host: '192.168.1.5', // MacのローカルIPアドレス
            port: 5173, // 任意のポート番号
        },
    },
});
