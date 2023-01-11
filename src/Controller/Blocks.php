<?php
/**
 * Initiate framework
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

namespace LayarTancap\Controller;

!defined('WPINC ') or die;

use LayarTancap\Controller;
use LayarTancap\WordPress\Hook\Action;

class Blocks extends Controller
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

		/** @backend - Add custom admin page under settings */
		$action = new Action();
		$action->setComponent($this);
		$action->setHook('init');
		$action->setCallback('register_block');
		$action->setMandatory(true);
		$this->hooks[] = $action;
	}

	/**
	 * Register WP Blocks
	 */
	public function register_block()
	{
		$path = $this->Framework->getPath();
		$blocks = file_get_contents($path['framework_path'] . '/blocks/blocks.json');
		$blocks = json_decode($blocks, true);

		/** Register Blocks */
		foreach ($blocks as $block) {
			/** Register Script */
			wp_register_script(
				sprintf("block-%s-js", $block['name']),
				sprintf("%s/assets/build/js/blocks/%s/%s.min.js", $path['framework_url'], $block['name'], $block['name']),
				array('wp-blocks'),
			);

			/** Register Block */
			register_block_type(
				sprintf("layar-tancap-block/%s", $block['name']),
				array(
					'editor_script' => sprintf("block-%s-js", $block['name']),
				)
			);
		}
	}

}
