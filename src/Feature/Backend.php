<?php

namespace LayarTancap\Feature;

!defined( 'WPINC ' ) or die;

/**
 * Initiate plugins
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\Includes
 */

class Backend extends Feature {

    /**
     * Feature construect
     * @return void
     * @var    object   $plugin     Feature configuration
     * @pattern prototype
     */
    public function __construct($plugin){
        $this->key = 'core_backend';
        $this->name = 'Backend';
        $this->description = 'Handles plugin backend core function';
    }

}