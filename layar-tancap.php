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
 * For detailed information regards to the licensing of
 * this software, please review the license.txt
*/

! defined( 'WPINC ' ) || die;

/** Load Composer Vendor */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/** Initiate Plugin */
$layartancap = new LayarTancap\Plugin();
$layartancap->run();
