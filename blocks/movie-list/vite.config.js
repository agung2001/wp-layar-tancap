import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  	plugins: [react()],
	build: {
		outDir: '../../assets/build/js/shortcodes/movie-list',
		rollupOptions: {
			input: "src/main.jsx",
			output: {
				entryFileNames: "shortcode.js",
			},
		},
	},
})
