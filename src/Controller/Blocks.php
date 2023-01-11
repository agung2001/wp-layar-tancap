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
use LayarTancap\WordPress\Hook\Shortcode;

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

		/** @frontend - Test custom block via shortcode */
		$shortcode = new Shortcode();
		$shortcode->setComponent( $this );
		$shortcode->setHook( 'layar_tancap_block' );
		$shortcode->setCallback( 'layar_tancap_block' );
		$shortcode->setAcceptedArgs( 1 );
		$shortcode->setMandatory( true );
		$shortcode->setDescription( 'Add layar tancap block shortcode' );
		$this->hooks[] = $shortcode;
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
			/** Enqueue script for shortcode */
			$this->WP->wp_enqueue_script(
				sprintf('block-%s',$block['name']),
				sprintf('build/js/shortcodes/%s/shortcode.js', $block['name']),
				array(), '', true
			);

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

	/**
	 * Layar Tancap Block Shortcode
	 */
	public function layar_tancap_block($atts){
		$atts = shortcode_atts( array(
			'block' => 'block',
		), $atts, 'layar_tancap_block' );
		return sprintf('<div class="block-%s"></div>', $atts['block']);
	}

}
