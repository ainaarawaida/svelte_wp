import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'

// https://vitejs.dev/config/
export default defineConfig({
  base: '/wp-content/plugins/luqvote/my-app/dist/',
  plugins: [svelte()]
})
