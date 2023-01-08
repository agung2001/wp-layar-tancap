<?php
/**
 * Initiate plugins
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Model
 */

namespace LayarTancap\Model;

! defined( 'WPINC ' ) || die;

use LayarTancap\WordPress\Hook\Action;
use LayarTancap\Helper\LAYARTANCAPItem;

class Movie extends \LayarTancap\Model\Model
{

	/**
	 * @var array   WordPress global $post variable.
	 */
	protected $post;

	/**
	 * Constructor
	 *
	 * @param \LayarTancap\Plugin $plugin
	 */
	public function __construct( \LayarTancap\Plugin $plugin ) {
		/** Create a post type */
		parent::__construct( $plugin );
        $this->args['labels'] = ['name' => __(ucwords($this->name), 'layartancap')];
		$this->args['public'] = true;
		$this->args['publicly_queryable'] = true;
		$this->args['menu_icon'] = 'dashicons-media-video';
		$this->args['has_archive'] = true;
		$this->args['show_in_rest'] = true;
        $this->args['supports'] = array('title', 'editor', 'thumbnail');

		/** @backend */
		$action = new Action();
		$action->setComponent( $this );
		$action->setHook( 'save_post' );
		$action->setCallback( 'metabox_save_data' );
		$action->setMandatory( true );
		$action->setDescription( 'Save Movie Metabox Data' );
		$this->hooks[] = $action;
	}

	/**
	 * Save metabox data when post is saving
	 *
	 * @return void
	 */
	public function metabox_save_data() {
		global $post;

		/** Check Correct Post Type, Ignore Trash */
		if ( ! isset( $post->ID ) || $post->post_type !== 'movie' || $post->post_status === 'trash' ) {
			return;
		}

		/** Sanitize */
		$data = array(
			'description' => sanitize_text_field( $_POST['metabox_detail_description'] ),
			'year' => sanitize_text_field( $_POST['metabox_detail_year'] )
		);

		/** Save Data */
		foreach($data as $key => $value){
			update_post_meta( $post->ID, $key, $value );
		}
	}

}

