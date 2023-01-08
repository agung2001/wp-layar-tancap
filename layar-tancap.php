<?php
/*
 * Plugin Name:       Layar Tancap
 * Plugin URI:        https://agung2001.github.io
 * Description:       a Simple Movies REST API Plugin
 * Version:           0.0.1
 * Author:            Agung Sundoro
 * Author URI:        https://agung2001.github.io
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * SOFTWARE LICENSE INFORMATION
 *
 * Copyright 2021 Artistudio, all rights reserved.
 *
 * For detailed information regards to the licensing of
 * this software, please review the license.txt
*/

! defined( 'WPINC ' ) || die;

/** Load Composer Vendor */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/** Initiate Plugin */
$layartancap = new LayarTancap\Plugin();
$layartancap->run();

/** Activation Hook */
//register_activation_hook( __FILE__, array( $layartancap, 'activate' ) );

/** Uninstall Hook */
//register_uninstall_hook( __FILE__, 'uninstall_fab_plugin' );
//function uninstall_fab_plugin() {
//	delete_option( 'layartancap_config' ); }
