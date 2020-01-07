<?php //shortdode [apm-couoons]



//------output each coupon for the correct month on the frontend. Put it into shortcode for use on page
function apm_coupons_shortcode_init() {

	function apm_coupons_shortcode($atts) {

		//optional number of coupons to show and the order
		extract(shortcode_atts(array('posts_per_page' => 5, 'orderby' => 'date'), $atts));

		//gets current month
		$now = strtolower(date("F", time()));
		
		
		//the arguments for the query
		$args = array('posts_per_page' => 10, 'orderby' => 'date', 'post_type' => 'apm-coupons');

		//set the query var
		$posts = new WP_Query($args);

		//begin the loop
		if ($posts->have_posts()) {
			while($posts->have_posts()) {
				//gets all post data returned in the custom loop
				$posts->the_post();
				
				//get the months for each coupon	
				$couponMonths = wp_get_post_terms(get_the_ID(), 'apm-coupon-months');
				
				//loop through each coupons months
				foreach($couponMonths as $couponMonth) {
					//if the current month is equal to the coupon's month set in taxonomy terms, show the content
					if($now == $couponMonth->slug) {
						the_content();
					}
				}
				

			}
			//reset after custom query
			wp_reset_postdata();
		} else {
			echo "<p>Sorry, no posts matched you criteria.</p>";
		}

	}
	//add the shortcode

	

	add_shortcode('apm_coupons', 'apm_coupons_shortcode');
}

//msut use init with shortcode here bc custom taxonomy needed is loaded on init. If not, shortcode will load before. Use priority 20
add_action('init', 'apm_coupons_shortcode_init', 20);


//--change the colors on the front end
function apm_coupons_change_colors() {

	//if page is not a post or page
	if(! is_page()) 
		return;
	//get the color from the database
	$apmCouponsColor = get_option('apm_coupons_options');

	//if color is empty, return
	if(empty ($apmCouponsColor)) return;

	?>

	<style>
		.specials-div {
			border-color:<?php echo ($apmCouponsColor['custom_color']); ?>;
		}
		.specials-div h3 {
			color: <?php echo $apmCouponsColor['custom_color'];?>;

		}
	</style>

	<?php
	
}

add_action ('wp_head', 'apm_coupons_change_colors');