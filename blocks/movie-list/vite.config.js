import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { resolve } from "path";

// https://vitejs.dev/config/
export default defineConfig({
  	plugins: [react()],
	build: {
		outDir: '../../assets/build/js/blocks/movie-list',
		rollupOptions: {
			input: "src/main.jsx",
			output: {
				entryFileNames: "shortcode.js",
			},
		},
	},
})
