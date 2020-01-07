<?php
/*
	
	uninstall.php
	
	- fires when plugin is uninstalled via the Plugins screen
	
*/



// exit if uninstall constant is not defined
	//makes sure user has proper permissions
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	
	exit;
	
}


//--delete custom post type and taxonomy when uninstalled

	
	


	$args = array(
		'post_type' => 'apm-coupons',
		'posts_per_page' => -1
	);

	$postsArray = get_posts($args);

	foreach ($postsArray as $postToDelete) {
		wp_delete_post($postToDelete->ID, true);
	}

	unregister_taxonomy('apm-coupon-months');

	unregister_post_type('apm-coupons');