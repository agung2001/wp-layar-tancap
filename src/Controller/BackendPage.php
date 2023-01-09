<?php

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

/**
* Initiate framework
*
* @package    LayarTancap
* @subpackage LayarTancap/Controller
*/

use LayarTancap\Controller;
use LayarTancap\View;
use LayarTancap\WordPress\Hook\Action;
use LayarTancap\WordPress\Page\SubmenuPage;

class BackendPage extends Controller {

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
		$action->setHook( 'admin_menu' );
		$action->setCallback( 'admin_menu_setting' );
		$action->setMandatory( true );
		$this->hooks[] = $action;
	}

	/**
	 * Admin Menu Setting
	 */
	public function admin_menu_setting(){
		/** Set Page */
		$page = new SubmenuPage();
		$page->setParentSlug( 'options-general.php' );
		$page->setPageTitle(LAYARTANCAP_NAME);
		$page->setMenuTitle(LAYARTANCAP_NAME);
		$page->setCapability( 'manage_options' );
		$page->setMenuSlug( $slug );
		$page->setFunction( array( $this, 'page_setting' ) );
		$page->build();
	}

	/**
	 * Admin Menu Setting
	 *
	 * @backend @submenu setting
	 * @return  void
	 */
	public function page_setting() {
		/** Section */
		$sections = array();
		$sections['Backend.about'] = array( 'name' => 'About', 'active' => true);

		/** Set View */
		$view = new View( $this->Framework );
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
		/** Set Page */
		$page = new SubmenuPage();
		$page->setParentSlug( 'options-general.php' );
		$page->setPageTitle(LAYARTANCAP_NAME);
		$page->setMenuTitle(LAYARTANCAP_NAME);
		$page->setCapability( 'manage_options' );
        $page->setMenuSlug(strtolower(LAYARTANCAP_NAME).'-setting');
		$page->setFunction( array( $page, 'loadView' ) );
		$page->setView($view);
		$page->build();
	}

}
