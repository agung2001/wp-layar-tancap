<?php


namespace LayarTancap\Controller;
!defined('WPINC ') or die;

/**
 * Plugin hooks in a backend
 *setComponent
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

use LayarTancap\Controller;
use LayarTancap\WordPress\Hook\Action;

class Backend extends Controller
{

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object $plugin Plugin configuration
	 * @pattern prototype
	 */
	public function __construct($plugin)
	{
		parent::__construct($plugin);

		/** @backend - Eneque scripts */
		$action = new Action();
		$action->setComponent($this);
		$action->setHook('admin_enqueue_scripts');
		$action->setCallback('backend_enequeue');
		$action->setAcceptedArgs(0);
		$action->setMandatory(true);
		$action->setDescription(__('Enqueue backend framework assets', 'layartancap'));
		$this->hooks[] = $action;
	}

	/**
	 * Eneque scripts @backend
	 *
	 * @return  void
	 */
	public function backend_enequeue()
	{
		global $post;
		define('LAYARTANCAP_SCREEN', json_encode($this->WP->getScreen()));
		$config = $this->Framework->getConfig()->options;
		$screen = $this->WP->getScreen();
		$screen->base = str_replace(" ", "-", $screen->base);
		$slug = sprintf('%s-setting', $this->Framework->getSlug());
		$screens = array(sprintf('settings_page_%s', $slug));
		$allowedPage = ['post.php', 'post-new.php'];

		/** Load Vendors */
		if (
			in_array($screen->base, $screens) ||
			(isset($post->post_type) && $post->post_type === 'movie' && in_array($screen->pagenow, $allowedPage))
		) {
			/** Load Core Vendors */
			wp_enqueue_script('jquery');

			$this->WP->enqueue_assets($config->layartancap_assets->backend);
			$this->WP->wp_enqueue_style('animatecss', 'vendor/animatecss/animate.min.css');

			/** Load Plugin Assets */
			$this->WP->wp_enqueue_style('layartancap', 'build/css/backend.min.css');
			$this->WP->wp_enqueue_script('layartancap', 'build/js/backend/backend.min.js', array(), '', true);
		}

	}

}
