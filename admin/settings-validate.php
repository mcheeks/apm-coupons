<?php

if(! defined ('ABSPATH') ) {
	exit;
}

function apm_coupons_validate_options ($input) {
	if(isset($input['custom_color'])) {
		$input['custom_color'] = sanitize_text_field($input['custom_color']);
	}

	return $input;
}