module.exports = function (grunt) {
	/** Configuration */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		/** Compile TailwindCSS - Cross Platform */
		shell: {
			npm_tailwind: {
				command:
					`npx tailwindcss build assets/css/tailwind/style.css -o assets/build/css/tailwind.min.css --silent && ` +
					`node tailwindcsssupport.js`,
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
					'assets/build/css/tailwind.min.css':
						'assets/build/css/tailwind.min.css',
				},
			},
		},

		/** Configure watch task */
		watch: {
			options: {
				livereload: false,
			},
			js: {
				files: 'assets/js/**/*.js',
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

	/** Register Tasks */
	grunt.registerTask('build-css', ['shell:npm_tailwind', 'cssmin'])
	grunt.registerTask('build-js', [])
	grunt.registerTask('build', ['build-css', 'build-js'])
	grunt.registerTask('default', ['build-css','build-js',])
}
