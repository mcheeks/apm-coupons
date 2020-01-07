<?php //register settings fro apm_coupons

if( ! defined ('ABSPATH')) {
	exit;
}

function apm_coupons_register_settings() {

	register_setting(
		'apm_coupons_options',
		'apm_coupons_options',
		'apm_coupons_validate_options'
	);

	add_settings_section(
		'apm_coupons_section_styling',
		'APM Coupons Styles',
		'apm_coupons_callback_section_styling',
		'apm_coupons'

	);

	add_settings_field(
		'custom_color',
		'Change Color',
		'apm_coupons_callback_field_styling',
		'apm_coupons',
		'apm_coupons_section_styling',
		[ 'id' => 'custom_color', 'label' => 'Pick Color']
	);

}

add_action('admin_init', 'apm_coupons_register_settings');