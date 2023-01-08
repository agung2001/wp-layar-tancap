<?php

namespace LayarTancap\Api;

! defined( 'WPINC ' ) or die;

/**
 * Plugin hooks in a backend
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

use LayarTancap\Controller\Controller;
use LayarTancap\WordPress\Hook\Action;

class Movie extends Controller {

	/**
	 * Admin constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct( $plugin ) {
		parent::__construct( $plugin );

		/** @backend - Eneque scripts */
		$action = new Action();
		$action->setComponent( $this );
		$action->setHook( 'rest_api_init' );
		$action->setCallback( 'register_rest_route' );
		$action->setDescription( 'Register custom rest route for movie' );
		$this->hooks[] = $action;
	}

	/**
	 * Register Custom REST Route
	 */
	public function register_rest_route(){
		define( 'LAYARTANCAP_USER_IS_LOGGED_IN', is_user_logged_in() );
		register_rest_route( 'rymera/v1', '/movies/', array(
			'methods' => 'GET',
			'callback' => array($this, 'get_movies'),
			'permission_callback' => function(){
				return LAYARTANCAP_USER_IS_LOGGED_IN;
			}
		));
	}

	/**
	 * Get Movies
	 */
	public function get_movies( $request ){
		$defaults = array(
			'page' => 1,
			'offset' => 0,
			'posts_per_page' => -1,
			'category'         => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => array(),
			'exclude'          => array(),
			'meta_key'         => '',
			'meta_value'       => '',
			'suppress_filters' => true,
		);

		/** Set Default if Not Exists */
		$args = array();
		foreach($defaults as $key => $value){
			$param = $request->get_param( $key );
			if( $param ){
				if(in_array($key, array('include', 'exclude'))){
					$args[$key] = explode(',', $param);
				} else {
					$args[$key] = $param ? $param : $value;
				}
			}
		}

		$args['post_type'] = 'movie';
		$movies = get_posts($args);
		foreach($movies as &$movie){
			$movie->featured_image = get_the_post_thumbnail_url($movie->ID);
			$movie->description = get_post_meta($movie->ID, 'description', true);
			$movie->year = get_post_meta($movie->ID, 'year', true);
		}
		$response = rest_ensure_response( $movies );
		foreach($args as $key => $value){
			$response->header(
				sprintf("X-REQUEST-%s", strtoupper($key)),
				is_array($value) ? implode(',', $value) : $value
			);
		}
		return $response;
	}

}
