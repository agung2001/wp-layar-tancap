import { __ } from '@wordpress/i18n';
const { registerBlockType } = wp.blocks;
import save from "./App.jsx";

/** Register Block */
registerBlockType('layar-tancap/movie-list',{
	/** Built-in attributes */
	title: `Movie List`,
	description: `Just another simple WordPress block`,
	icon: `admin-site`,
	category: 'design',

	/** Built-in functions */
	// Gutenberg Editing
	edit({attributes, setAttributes}){
		return <>
			{ __('Movie List', 'layar-tancap') }
		</>
	},

	// Render to Frontend
	save
})
