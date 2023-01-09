<?php

namespace LayarTancap\WordPress\Hook;

!defined( 'WPINC ' ) or die;

/**
 * Register all actions
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\Includes\WordPress
 */

class Action extends Hook {

    /**
     * Run hook
     * @return  void
     */
    public function run(){
        add_action(
            $this->hook,
            array( $this->component, $this->callback ),
            $this->priority,
            $this->accepted_args
        );
    }

}