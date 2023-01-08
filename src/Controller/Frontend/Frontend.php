<?php

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

/**
 * Plugin hooks in a backend
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

use LayarTancap\Metabox\LAYARTANCAPMetaboxSetting;

class Frontend extends Base {

	/**
	 * Frontend constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct( $plugin ) {
		parent::__construct( $plugin );
	}

}
