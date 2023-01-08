<?php

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

/**
* Initiate framework
*
* @package    LayarTancap
* @subpackage LayarTancap/Controller
*/

use LayarTancap\View;
use LayarTancap\WordPress\Hook\Action;
use LayarTancap\WordPress\Theme\Page;

class BackendPage extends Controller {

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object   $theme     Theme configuration
	 * @pattern prototype
	 */
	public function __construct( $theme ) {
		parent::__construct( $theme );

		/** @backend - Add custom admin page under settings */
		$action = new Action();
		$action->setComponent( $this );
		$action->setHook( 'admin_menu' );
		$action->setCallback( 'page_setting' );
		$action->setMandatory( true );
		$this->hooks[] = $action;
	}

	/**
	 * Page Setting
	 *
	 * @backend @submenu setting
	 * @return  void
	 */
	public function page_setting() {
		/** Section */
		$sections = array();
		$sections['Backend.about'] = array( 'name' => 'About', 'active' => true);

		/** Set View */
		$view = new View( $this->Theme );
		$view->setTemplate( 'backend.default' );
		$view->setSections( $sections );
		$view->addData(
			array(
				'background'   => 'bg-alizarin'
			)
		);
		$view->setOptions( array( 'shortcode' => false ) );
        /**
         * Set Page.
         */
        $page = new Page();
        $page->setPageTitle(LAYARTANCAP_NAME);
        $page->setMenuTitle(LAYARTANCAP_NAME);
        $page->setCapability('manage_options');
        $page->setMenuSlug(strtolower(LAYARTANCAP_NAME).'-setting');
        $page->setFunction([$page, 'loadView']);
        $page->setView($view);
        $page->build();
	}

}
