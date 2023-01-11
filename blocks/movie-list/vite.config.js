import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  	plugins: [react()],
	build: {
		outDir: "assets/build/js/shortcodes/movie-list",
		rollupOptions: {
			input: "blocks/movie-list/src/main.jsx",
			output: {
				entryFileNames: "shortcode.js",
			},
		},
	},
})
