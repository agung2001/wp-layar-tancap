<?php

namespace LayarTancap\WordPress\Hook;

!defined( 'WPINC ' ) or die;

/**
 * Abstract class for hook
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\Includes\WordPress
 */

class Shortcode extends Hook {

    /**
     * Run hook
     * @return  void
     */
	public function run()
	{
		add_shortcode($this->hook, [$this->component, $this->callback]);
	}

}
