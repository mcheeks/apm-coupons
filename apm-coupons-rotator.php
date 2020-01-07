<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       APM Coupons Rotator
 * Plugin URI:        http://autoprofitmasters.com
 * Description:       Rotate coupons monthly.
 * Version:           1.0.0
 * Author:            Melissa Spurr
 
 * Text Domain:       apm_coupons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

//--TEXT DOMAIN
function apm_coupons_load_textdomain() {
	load_plugin_textdomain('apm_coupons', false, plugin_dir_path(__FILE__) . 'languages/');
}


//---ADMIN INCLUDES

if(is_admin()) {
	//require_once ("../../../wp-load.php"); //to use built in wordpress functions
	require_once plugin_dir_path(__FILE__) . 'admin/apm-coupons-admin-menu.php';
	require_once plugin_dir_path(__FILE__). 'admin/settings-page.php';
	require_once plugin_dir_path(__FILE__) .'admin/settings-register.php';
	require_once plugin_dir_path(__FILE__) .'admin/settings-callbacks.php';
	require_once plugin_dir_path(__FILE__) . 'admin/settings-validate.php';
}
	



//load public scripts

require_once plugin_dir_path(__FILE__) . 'admin/apm-coupons-post-type.php';
require_once plugin_dir_path(__FILE__) . 'public/apm-coupons-shortcode.php';

//load admin scripts
//add color picker
function apm_coupons_add_color_picker($hook) {

	if(is_admin()) {
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('admin-js', plugins_url('admin/js/admin-js.js', __FILE__), array('wp-color-picker'), false, true);
	}
}


add_action('admin_enqueue_scripts', 'apm_coupons_add_color_picker');


//load public scripts
function apm_coupons_register_scripts() {
	wp_enqueue_style('apm-coupons-style', plugin_dir_url(__FILE__) . 'public/css/apm-coupons-public.css', array(), null, 'screen');
}

add_action('wp_enqueue_scripts', 'apm_coupons_register_scripts');

//--set defaults for settings page
function apm_coupons_default() {
	return array('custom_color' => 'red');
	
}



