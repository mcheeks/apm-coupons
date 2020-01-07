<?php //APM Coupons - settings page

if(!defined('ABSPATH')) {
	exit;
}


//----display the settings pages
function apm_coupons_display_settings_page() {
	if(!current_user_can('manage_options')) return;

	?>

	<div class="wrap">
		
		<h1><?php echo esc_html(get_admin_page_title() ); ?></h1>

		<form action="options.php" method="POST">
			<?php

				settings_fields('apm_coupons_options');

				do_settings_sections('apm_coupons');

				submit_button();


			?>
		</form>

	</div>

	<?php
}


//---display admin notices

function apm_coupons_display_admin_notices() {
	$screen = get_current_screen();

	if($screen->id !== 'toplevel_page_apm_coupons') return;

	if(isset($_GET['settings-updated'])) {
		if('true' === $_GET['settings-updated']) :
			?>

			<div class="notice notice-success is-dismissable">
				<p><strong><?php _e('Settings Updated.', 'apm_coupons'); ?></strong></p>
			</div>

			<?php

			else :

			?>

			<div class="notice notice-error is-dismisable">
				<p><strong><?php _e('Settings not updated.', 'apm_coupons');?></strong></p>
			</div>
			<?php

		endif;
	}
}

add_action ('admin_notices', 'apm_coupons_display_admin_notices');