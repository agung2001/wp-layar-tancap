// import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

export default () => {
	// const [count, setCount] = useState(0)

	return <>
		<div>
			{ __('Hello World', 'layar-tancap') }
		</div>
	</>
}
