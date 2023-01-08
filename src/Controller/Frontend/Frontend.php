<?php

namespace LayarTancap\Controller;

! defined( 'WPINC ' ) or die;

/**
 * Plugin hooks in a backend
 *
 * @package    LayarTancap
 * @subpackage LayarTancap/Controller
 */

use LayarTancap\View;
use LayarTancap\Wordpress\Hook\Action;
use LayarTancap\Wordpress\Hook\Filter;
use LayarTancap\Metabox\LAYARTANCAPMetaboxSetting;

class Frontend extends Base {

	/**
	 * Frontend constructor
	 *
	 * @return void
	 * @var    object   $plugin     Plugin configuration
	 * @pattern prototype
	 */
	public function __construct( $plugin ) {
		parent::__construct( $plugin );

		/** @frontend */
		$action = new Action();
		$action->setComponent( $this );
		$action->setMandatory( true );
		$action->setHook( 'wp_enqueue_scripts' );
		$action->setCallback( 'frontend_enequeue' );
		$action->setAcceptedArgs( 1 );
		$action->setPriority( 20 );
		$action->setDescription( 'Eneque scripts' );
		$action->setFeature( $plugin->getFeatures()['core_frontend'] );
		$this->hooks[] = $action;
	}

	/**
	 * Eneque scripts to @frontend
	 *
	 * @return  void
	 * @var     array   $hook_suffix     The current admin page
	 */
	public function frontend_enequeue( $hook_suffix ) {
        /** Default Variables */
		define( 'LAYARTANCAP_SCREEN', json_encode( $this->WP->getScreen() ) );
		$default = $this->Plugin->getConfig()->default;
		$config  = $this->Plugin->getConfig()->options;
        $options = (object) ( $this->Helper->ArrayMergeRecursive( (array) $default, (array) $config ) );
        $layartancapTypes = array();

        /** Get LAYARTANCAP for JS Manipulation */
        $layartancap_to_display = $this->Plugin->getModels()['LayarTancap'];
        $layartancap_to_display = $layartancap_to_display->get_lists_of_layartancap( array(
            'validateLocation' => true
        ) )['items'];
        foreach($layartancap_to_display as &$layartancap){
            $layartancapTypes[$layartancap->getType()] = $layartancap->getType();
            if($layartancap->getModal()) $layartancapTypes['modal'] = 'modal';
            $layartancap = $layartancap->getVars();
        }

        /** Get Features for JS Manipulation */
        $features = $this->Plugin->getFeatures();
        foreach($features as $key => &$feature){
            $feature = $feature->getOptions();
            if(!$feature) unset($features[$key]);
        }

		/** Load Inline Script */
		$this->WP->wp_enqueue_script( 'layartancap-local', 'local/layartancap.js', array(), '', true );
		$this->WP->wp_localize_script(
			'layartancap-local',
			'LAYARTANCAP_PLUGIN',
			array(
				'name'    => LAYARTANCAP_NAME,
				'version' => LAYARTANCAP_VERSION,
				'screen'  => LAYARTANCAP_SCREEN,
				'path'    => LAYARTANCAP_PATH,
				'premium' => $this->Helper->isPremiumPlan(),
                'rest_url'=> esc_url_raw( rest_url() ),
				'options' => $options,
                'to_display' => $layartancap_to_display,
                'features' => $features
			)
		);

		/** Load WP Core jQuery */
		wp_enqueue_script( 'jquery' );

		/** Load Vendors */
		if ( isset( $config->layartancap_animation->enable ) && $config->layartancap_animation->enable ) {
			$this->WP->wp_enqueue_style( 'animatecss', 'vendor/animatecss/animate.min.css' );
		}
		$this->WP->enqueue_assets( $config->layartancap_assets->frontend );

		/** Load Plugin Assets */
		$this->WP->wp_enqueue_style( 'layartancap', 'build/css/frontend.min.css' );
		$this->WP->wp_enqueue_script( 'layartancap', 'build/js/frontend/plugin.min.js', array(), '', true );
	}

}
