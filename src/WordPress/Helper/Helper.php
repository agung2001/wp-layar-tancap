<?php

namespace LayarTancap\WordPress\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Add extra layer for WordPress functions
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\WordPress
 */

class Helper {

    /** Load WP Trait */
    use API;
    use Asset;
    use Model;
    use Page;
    use Shortcode;
    use Template;
    use Validate;
    use User;

}
