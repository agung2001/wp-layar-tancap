<?php
/**
 * Initiate plugins
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Model
 */

namespace LayarTancap\Model;

! defined( 'WPINC ' ) || die;

use LayarTancap\Wordpress\Hook\Action;
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
        $this->args['labels'] = ['name' => ucwords($this->name)];
		$this->args['public'] = true;
		$this->args['publicly_queryable'] = true;
		$this->args['menu_icon'] = json_decode( LAYARTANCAP_PATH )->framework_url . '/assets/img/icon.png';
		$this->args['has_archive'] = true;
		$this->args['show_in_rest'] = true;
        $this->args['supports'] = array('title', 'editor', 'thumbnail');

		/** @backend */
//		$action = new Action();
//		$action->setComponent( $this );
//		$action->setHook( 'save_post' );
//		$action->setCallback( 'metabox_save_data' );
//		$action->setMandatory( true );
//		$action->setDescription( 'Save LAYARTANCAP Metabox Data' );
//		$this->hooks[] = $action;
	}

	/**
	 * Save metabox data when post is saving
	 *
	 * @return void
	 */
	public function metabox_save_data() {
		global $post;

		/** Check Correct Post Type, Ignore Trash */
		if ( ! isset( $post->ID ) || $post->post_type !== 'fab' || $post->post_status === 'trash' ) {
			return;
		}

		/** Save Metabox Setting */
		if ( $this->checkInput( LAYARTANCAPMetaboxSetting::$input ) ) {
			$metabox = new LAYARTANCAPMetaboxSetting();
			$metabox->sanitize();
			$metabox->setDefaultInput();
			$metabox->save();
		}

		/** Save Metabox Design */
		if ( $this->checkInput( LAYARTANCAPMetaboxDesign::$input ) ) {
			$metabox = new LAYARTANCAPMetaboxDesign();
			$metabox->sanitize();
			$metabox->setDefaultInput();
			$metabox->save();
		}

		/** Save Metabox Location */
		if ( $this->checkInput( LAYARTANCAPMetaboxLocation::$input ) ) {
			$metabox = new LAYARTANCAPMetaboxLocation();
			$metabox->sanitize();
			$metabox->setDefaultInput();
			$metabox->save();
		} else {
			$this->WP->delete_post_meta( $post->ID, LAYARTANCAPMetaboxLocation::$post_metas['locations']['meta_key'] );
		}

		/** Save Metabox Trigger */
		if ( $this->checkInput( LAYARTANCAPMetaboxTrigger::$input ) ) {
			$metabox = new LAYARTANCAPMetaboxTrigger();
			$metabox->sanitize();
			$metabox->setDefaultInput();
			$metabox->save();
		}
	}

}

