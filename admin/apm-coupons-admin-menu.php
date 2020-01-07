<?php  //APM Coupons - admin menu

if(!defined('ABSPATH')) {
	exit;
}


//add top level admin page
function apm_coupons_top_level_menu() {
	add_menu_page(
		'APM Coupons Settings',
		'APM Coupons',
		'manage_options',
		'apm_coupons',
		'apm_coupons_display_settings_page', // callback function in settings-page.php
		'dashicons-admin-generic',
		null
	);

	add_submenu_page(
		'apm_coupons', //must match slug from main top level menu
		'APM Coupons Settings',
		'Settings',
		'manage_options',
		'apm_coupons'
	);
}

add_action('admin_menu', 'apm_coupons_top_level_menu');

