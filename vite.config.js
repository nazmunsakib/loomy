import { defineConfig } from 'vite';
import path from 'path';
import { fileURLToPath } from 'url';
import tailwindcss from '@tailwindcss/vite';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig({
  plugins: [tailwindcss()],
  root: __dirname,
  build: {
    manifest: true,
    outDir: path.resolve(__dirname, 'dist'),
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'assets/src/js/main.js'),
        style: path.resolve(__dirname, 'assets/src/css/main.css')
      }
    }
  },
  server: {
    port: 5173,
    strictPort: true,
    cors: true,
    hmr: {
      host: 'localhost',
    },
  },
});
