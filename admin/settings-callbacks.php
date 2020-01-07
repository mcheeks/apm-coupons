<?php

if(! defined ('ABSPATH')) {
	exit;
}

function apm_coupons_callback_section_styling() {

}



function apm_coupons_callback_field_styling($args) {
	$options = get_option('apm_coupons_options', apm_coupons_default())  ;
	
	$id =isset($args['id']) ? $args['id'] : '';
	$label = isset($args['label']) ? $args['label'] : '';
	
	$value = isset($options[$id]) ? sanitize_text_field($options[$id]) : 'blank';
	
	
	echo '<label for="apm_coupons_options_' .$id . '">' .$label . '</label>';

	echo '<input type="text" id="apm_coupons_options_' .$id .'" name="apm_coupons_options['.$id.']"  value="' .$value . '" class="color-field">';
}