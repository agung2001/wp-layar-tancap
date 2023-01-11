const path = require("path");
let blockConfig = require( path.resolve(__dirname, 'blocks/blocks.json') );
module.exports = function (grunt) {
	/** Configuration */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		/** Compile TailwindCSS - Cross Platform */
		shell: {
			...(() => { /** Get Shortcode Build Commands */
				let shell = {}
				blockConfig.map((b) => {
					shell[`build_shortcode_${b.name}`] = {
						command: `cd blocks/${b.name} && npm run build`
					}
				})
				return shell;
			})(),
			sass: {
				command: () => {
					let assets = { // No extension because added in loop command
						"assets/css/backend/style.scss": `assets/build/css/backend.min.css`,
						"assets/css/frontend/style.scss": `assets/build/css/frontend.min.css`,
					}
					let cmd = [];
					for (const [source, target] of Object.entries(assets)) {
						cmd.push(`npx sass ${source} ${target} --style compressed`)
					}
					return cmd.join(' && ')
				},
			},
			npm_tailwind: {
				command:
					`npx tailwindcss build assets/css/tailwind/style.css -o assets/build/css/tailwind.min.css --silent && ` +
					`node tailwindcsssupport.js`,
			},
			npm_wordpress: {
				command: `npm run build:wp`,
			},
			dot_refactor: {
				command: `aspri --wp-refactor --path ${path.resolve(
					__dirname,
					'vendor/artistudioxyz/dot-framework'
				)} --from Dot --to LayarTancap --type plugin && composer dump-autoload`,
			},
		},

		/** CSS Minify */
		cssmin: {
			options: {
				mergeIntoShorthands: false,
				roundingPrecision: -1,
			},
			target: {
				files: {
					'assets/build/css/backend.min.css':
						'assets/build/css/backend.min.css',
					'assets/build/css/frontend.min.css':
						'assets/build/css/frontend.min.css',
				},
			},
		},

		/** Configure watch task */
		watch: {
			options: {
				livereload: false,
			},
			js: {
				files: [
					'assets/js/**/*.js',
					'blocks/**/*.js',
					'blocks/**/*.jsx',
				],
				tasks: ['build-js'],
			},
			css: {
				files: [
					'assets/css/**/*.scss',
					'assets/css/**/*.css',
					'src/View/**/*.php',
					'*.php',
				],
				tasks: ['build-css'],
			},
		},
	})

	/** Load Plugin */
	grunt.loadNpmTasks('grunt-shell')
	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-contrib-cssmin')

	/** Shortcodes */
	let ShortcodeBuild = [];
	blockConfig.map((b) => {
		ShortcodeBuild.push(`build-shortcode-${b.name}`)
		grunt.registerTask(`build-shortcode-${b.name}`, [ `shell:build_shortcode_${b.name}` ]);
	})

	/** Register Tasks */
	grunt.registerTask('build-css', ['shell:npm_tailwind', 'shell:sass', 'cssmin'])
	grunt.registerTask('build-js', [ 'shell:npm_wordpress', ...ShortcodeBuild])
	grunt.registerTask('build', ['build-css', 'build-js'])
	grunt.registerTask('default', ['build-css','build-js',])
}
