<?php

namespace LayarTancap\WordPress\Model;

!defined( 'WPINC ' ) or die;

/**
 * Abstract class for WordPress model
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\Includes\WordPress
 */


class Taxonomy extends Model {

    /**
     * @access   protected
     * @var      object    $type    Post type for taxonomies
     */
    protected $type;

    /**
     * Metadata constructor
     */
    public function __construct(){
        $this->WP = new \LayarTancap\WordPress\Helper\Helper();
    }

    /**
     * Method to model
     * @return void
     */
    public function build(){
        $this->WP->register_taxonomy($this->name, $this->type->getName() , $this->args);
    }

    /**
     * @return array
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}
