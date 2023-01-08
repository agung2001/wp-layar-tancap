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
		$args = array(
			'page' => $request->get_param( 'page' ),
			'posts_per_page' => $request->get_param( 'posts_per_page' ),
		);
		$defaultArgs = array(
			'page' => 1,
			'posts_per_page' => -1,
		);
		/** Set Default if Not Exists */
		foreach($args as $key => &$value){
			if(!$value){
				$value = $defaultArgs[$key];
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
				$value
			);
		}
		return $response;
	}

}
