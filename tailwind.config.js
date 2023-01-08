const colors = require('tailwindcss/colors')

module.exports = {
	mode: 'jit',
	purge: ['*.php', './src/View/**/*.php'],
	theme: {
		extend: {
			colors: {
				primary: colors.purple,
				danger: colors.pink,
			},
			backgroundImage: (theme) => ({
				'cover-image': "url('../../img/cover.jpg')",
			}),
		},
	},
}
