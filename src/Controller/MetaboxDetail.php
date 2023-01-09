<?php

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

/**
 * Initiate plugins
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

use LayarTancap\Controller;
use LayarTancap\View;
use LayarTancap\Wordpress\Hook\Action;
use LayarTancap\WordPress\Model\MetaBox;

class MetaboxDetail extends Controller {

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct( $plugin ) {
		parent::__construct( $plugin );

		/** @backend - Add Designs metabox to LayarTancap CPT */
		$action = new Action();
		$action->setComponent( $this );
		$action->setHook( 'add_meta_boxes' );
		$action->setCallback( 'metabox_detail' );
		$action->setDescription( 'Add Detail metabox to Movie CPT' );
		$this->hooks[] = $action;
	}

	/**
	 * Register metabox detail on custom post type Movies
	 *
	 * @return      void
	 */
	public function metabox_detail() {
		$metabox = new MetaBox();
		$metabox->setScreen( 'movie' );
		$metabox->setId( 'movie-metabox-detail' );
		$metabox->setTitle( 'Movie Detail' );
		$metabox->setCallback( array( $this, 'metabox_detail_callback' ) );
		$metabox->setCallbackArgs( array( 'is_display' => false ) );
		$metabox->build();
	}

	/**
	 * Metabox Detail set view template
	 *
	 * @return      void
	 */
	public function metabox_detail_callback() {
		$view = new View( $this->Framework );
		$view->setTemplate( 'backend.blank' );
		$view->setSections( [ 'Backend.Metabox.Detail' => [ 'name' => 'Detail', 'active' => true ] ] );
		$view->setData( array(
			'description' => get_post_meta( get_the_ID(), 'description', true ),
			'year' => get_post_meta( get_the_ID(), 'year', true ),
		));
		$view->setOptions( array( 'shortcode' => true ) );
		$view->build();
	}

}
