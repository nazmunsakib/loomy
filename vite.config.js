import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: path.resolve(__dirname, 'assets'),
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
  }
});
