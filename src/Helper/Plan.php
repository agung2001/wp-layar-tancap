<?php
/**
 * Helper library for LayarTancap framework
 *
 * @package    LayarTancap
 * @subpackage LayarTancap\Includes
 */

namespace LayarTancap\Helper;

!defined('WPINC ') or die;

trait Plan
{

	/**
	 * Get Premium Plan Info
	 * @return bool
	 */
	public function isPremiumPlan()
	{
		return true;
		/** Get Plan from config.json file */
		$plan = $this->Framework->getConfig()->premium;

		/** Freemius - Check Premium Plan */
		if (function_exists('layartancap_freemius')) {
			if (layartancap_freemius()->is__premium_only()) {
				if (layartancap_freemius()->is_plan('pro')) $plan = 'pro';
			}
		}

		return $plan;
	}

	/**
	 * Get Upgrade URL
	 * @return string
	 */
	public function getUpgradeURL()
	{
		return (function_exists('layartancap_freemius')) ?
			layartancap_freemius()->get_upgrade_url() : false;
	}

}
