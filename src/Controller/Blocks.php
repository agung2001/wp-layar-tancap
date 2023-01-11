<?php
/**
 * Initiate framework
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

use LayarTancap\Controller;

class Blocks extends Controller {

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct( $plugin ) {
		parent::__construct( $plugin );

		/** @backend - Add custom admin page under settings */
		$action = new Action();
		$action->setComponent( $this );
		$action->setHook( 'init' );
		$action->setCallback( 'register_block' );
		$action->setMandatory( true );
		$this->hooks[] = $action;
	}

	/**
	 * Register WP Blocks
	 */
	public function register_block(){


//		/** Register Script */
//		wp_register_script(
//			'block-hello-world-js',
//			HOGB_BLOCKS_URL . '/assets/build/blocks/hello-world.js',
//			array( 'wp-blocks'),
//		);
//
//		/** Register Block */
//		register_block_type(
//			'hands-on-gutenberg-block/hello-world',
//			array(
//				'editor_script' => 'block-hello-world-js',
//			)
//		);
	}

}
