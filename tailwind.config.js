const colors = require('tailwindcss/colors')

module.exports = {
	mode: 'jit',
	purge: ['*.php', './src/View/**/*.php'],
	theme: {
		extend: {
			colors: {
				primary: colors.blue,
				danger: colors.red,
			},
			backgroundImage: (theme) => ({
				'cover-image': "url('../../img/cover.jpg')",
			}),
		},
	},
}
