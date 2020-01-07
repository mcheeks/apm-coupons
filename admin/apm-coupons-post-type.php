<?php //APM Coupons - custom post type for coupons





//--make coupons custom post type

function apm_coupons_post_type() {
	$labels = array(
		'name' => 'APM Coupons',
		'singular_name' => 'APM Coupon',
		'menu_name' => 'All APM Coupons',
		'name_admin_bar' => 'APM Coupon',
		'add_new' => 'New Coupon',
		'add_new_item' => 'Add New Coupon',
		'edit_item' => 'Edit Coupon',
		'new_item' => 'New APM Coupon',
		'view_item' => 'View APM Coupon',
		'search_items' => 'Search APM Coupons',
		'not_found' => 'No Coupons Found',
		'not_found_in_trash' => 'No Coupons Found in Trash'
	);

	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => true,
		'supports' => array(
			'title',
			'editor'
		),
		'show_ui' => true,
		'show_in_menu' => 'apm_coupons', //add to the plugin admin menu
		'taxonomies' => array('apm-coupon-months'),

	);

	register_post_type('apm-coupons', $args);
}

add_action('init', 'apm_coupons_post_type', 5);

//--create the months taxonomy to add the month the coupon should run
function apm_coupons_create_months_taxonomy() {
	register_taxonomy(
		'apm-coupon-months',
		'apm-coupons',
		array(
			'label' => 'Month to Run Coupon',
			'show_ui' => true,
			'hierarchical' => true,
			
			
		)
	);

	//months to load in taxonomy
	$terms = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

	if(isset($terms) && !empty($terms) ) {
		foreach($terms as $term) {
			if(!term_exists($term)) {

				//--have the months preloaded in the taxonomy
				wp_insert_term($term, 'apm-coupon-months');
			}
		}
	}

	
}

add_action('init', 'apm_coupons_create_months_taxonomy', 5);

//--preload the coupons
function apm_coupons_load_coupons() {

	//get 1 month ahead	
	$nextMonth = strtotime("+1 month", time());
	//add 1 month on the the 15th of this month
	$expiration = "One coupon per visit, please. Offer expires " . date("n/15/Y",$nextMonth) . ".";
	
	//-----coupons content
	$coupon1Content = '<div class="specials-div">
				<h3>Protect Your Engine From the Cold</h3>
				<p>Ordinary engine oil doesn\'t protect your engine as well in the cold. Full Synthetic Oil performs the same in all weather conditions, providing your engine with the protection it needs from the moment you start it up.</p>
					<h4>Upgrade today and we\'ll take $20 off your Full Synthetic Oil Change!</h4>
					<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
			</div>';

	$coupon2Content = '<div class="specials-div">
						<h3>Step into Savings</h3>
						<h5>$15 OFF any repair over $50</h5>
					   <h5>$20 OFF any repair over $70</h5>
						<h5>$30 OFF any repair over $250</h5>
						<h6><i>Cannot be combined with any other offer. ' .$expiration .'</i></h6>
						</div>';

	$coupon3Content = '<div class="specials-div">
						<h3>Yearly Brake Maintenance Package</h3>
						<p>There\'s more to maintaining brakes than just pads and shoes...brakes are a system! To take care of all the components, we\'ve bundled these services together to give you some GREAT SAVINGS! 4-wheel brake inspection, brake fluid flush, clean & adjust rear brakes, emergency brake inspection & adjustment.</p>
							<h5>ONLY $99!</h5>
							<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';

	$coupon4Content = '<div class="specials-div">
						<h3>Fuel Saver Special</h3>
						<p>We\'ve bundled these services to give you some GREAT SAVINGS and to help you get MORE MILES for your DOLLARS! Tire rotation, replace Air Filter, and test Gas Cap for evaporating gasoline.</p>
						<h5>Only $169.99!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';

	$coupon5Content = '<div class="specials-div">
						<h3>Oil Change Saver Special!</h3>
						<h5>$5 OFF ANY oil change!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';

	$coupon6Content = '<div class="specials-div">
						<h3>Alignment Special</h3>
						<p>If your car is out of alignment, your tires can wear unevenly and can even cost you money due to decreased gas mileage. Bring in this coupon along with your vehicle and we\'ll give you...</p>
						<h5>$10 Off Alignment</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon7Content = '<div class="sepcials-div">
						<h3>Breathe Easier!</h3>
						<p>Did you know that most vehicles have a dust & pollen filter for the air you breathe? Just by changing this filter, you can reduce the allergens that enter your car...and have it feeling and smelling better instantly! Come in now and we\'ll give you...</p>
						<h5>$10 OFF a new dust & pollen filter!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon8Content = '<div class="specials-div">
						<h3>Customer Appreciation Special!</h3>
						<p>Get a tire rotation; lube, oil & filter change; 4-wheel brake inspection; and a safety inspection...</p>
						<h5>ONLY $69.99 (a $159 Value!) We Appreciate You!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon9Content = '<div class="specials-div">
						<h3>HEAT = BAD!</h3>
						<p>If your engine gets too hot, it can suffer damage (and even be destroyed). Your engine\'s coolant prevents your engine from overheating. Bring your car into our shop with this coupon and we\'ll give you...<br />
						<h5>$15 OFF an engine coolant flush!</h5></p>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon10Content = '<div class="specials-div">
						<h3>Air Conditioning - Stay Cool This Summer!</h3>
						<p>Make sure your AIR CONDITIONING is going to provide you with relief from the heat all summer long! Come into our shop and we\'ll inspect your vent temperatures, check pressures, inspect for leaks, examine the clutch, and perform a visual inspection of ALL components.</p>
						<h5>Now Just $9.99!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon11Content = '<div class="specials-div">
						<h3>Free Inspection</h3>
						<p>Do you have any concerns about your vehicle? Any strange noises that you\'ve been meaning to have checked out?</p>
						<h5>Bring it in and we\'ll inspect it for FREE</h5>
						<h6><i>Computer diagnosis is free up to $47. Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon12Content = '<div class="specials-div">
						<h3>Take Care of Your Transmission</h3>
						<p>Your vehicle\'s transmission is its SECOND MOST EXPENSIVE COMPONENT! Don\'t pass up on routine maintenance for it!</p>
						<h5>Get $15 off a transmission flush & service with this coupon!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon13Content = '<div class="specials-div">
						<h3>Back 2 School Special!</h3>
						<p>Make sure your car is ready for school this fall with a back to school safety inspection, including brakes!</p>
						<h5>Just $9.99 </h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon14Content = '<div class="specials-div">
						<h3>No Trick, All Treats Oil Change!</h3>
						<h5>Upgrade you oil change to Full Service and we\'ll give you $5 off for candy!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';
	$coupon15Content = '<div class="specials-div">
						<h3>FREE Stop & Go Inspection!</h3>
						<p>The most important parts on your car to maintain are the ones that make you stop and go. Bring your car into our shop along with this coupon and...<br />
						<h5>We\'ll inspect your brakes, battery & alternator FOR FREE!!</h5>
						<h6><i>Cannot be combined with any other offer. ' . $expiration . '</i></h6>
						</div>';

	//--the args to be use with wp_insert_post
	$allCoupons = array(
		$post_id = array(
			'post_content' => $coupon1Content,
			'post_title' => 'Protect Your Engine From the Cold',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'january')
		),
		$post_id = array(
			'post_content' => $coupon2Content,
			'post_title' => 'Step into Savings',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'january', 'month2' => 'march', 'month3' => 'may', 'month4' => 'october')
		),
		$post_id = array (
			'post_content' => $coupon3Content,
			'post_title' => 'Yearly Brake Maintenance Package',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'january')
		),
		$post_id = array (
			'post_content' => $coupon4Content,
			'post_title' => 'Fuel Saver Special',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'february')
		),
		$post_id = array (
			'post_content' => $coupon5Content,
			'post_title' => 'Oil Change Saver Special',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'march', 'month2' => 'april', 'month3' => 'june', 'month4' => 'september', 'month5' => 'november' )
		),
		$post_id = array (
			'post_content' => $coupon6Content,
			'post_title' => 'Alignment Special',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'september' )
		),
		$post_id = array (
			'post_content' => $coupon7Content,
			'post_title' => 'Breathe Easier',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'april' )
		),
		$post_id = array (
			'post_content' => $coupon8Content,
			'post_title' => 'Customer Appreciation Special',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'may', 'month2' => 'july', 'month3' => 'december' )
		),
		$post_id = array (
			'post_content' => $coupon9Content,
			'post_title' => 'HEAT is BAD',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'june' )
		),
		$post_id = array (
			'post_content' => $coupon10Content,
			'post_title' => 'Air Conditioning - Stay Cool This Summer',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'june' )
		),
		$post_id = array (
			'post_content' => $coupon11Content,
			'post_title' => 'Free Inspection',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'july', 'month2' => 'december' )
		),
		$post_id = array (
			'post_content' => $coupon12Content,
			'post_title' => 'Take Care of Your Transmission',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'august' )
		),
		$post_id = array (
			'post_content' => $coupon13Content,
			'post_title' => 'Back 2 School Special',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'august' )
		),
		$post_id = array (
			'post_content' => $coupon14Content,
			'post_title' => 'No Trick, All Treats Oil Change',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'october' )
		),
		$post_id = array (
			'post_content' => $coupon15Content,
			'post_title' => 'FREE Stop and Go Inspection',
			'post_type' => 'apm-coupons',
			'post_status' => 'publish',
			'meta_input' => array('month' => 'november' )
		)
	);

	
	//--loop through all of the coupons above
	foreach ($allCoupons as $singleCoupon) {

		//check to see it title exists in the database, if it doesn't, add coupon
		if(get_page_by_title($singleCoupon['post_title'], OBJECT, 'apm-coupons') == NULL) {
			//insert the coupon. Will return the id set as $post_id
			$post_id = wp_insert_post($singleCoupon);
			//if the post exists
			if($post_id) {
				//get all moths the coupon should be added to from the meta data 
				$assignedMonths = get_post_meta($post_id);
				//loop through each month
				foreach ($assignedMonths as $month) {
						//set each month term for the post. True will append the term to previous terms
						wp_set_object_terms($post_id, $month[0], 'apm-coupon-months', true);
				}
				
				
			}
				
		}
			
	}
	
}

add_action('init', 'apm_coupons_load_coupons', 5);


//------in order to get the taxonomy to sort by date and not alphabetically, all of the follow code is needed. Leave standard meta box is using alphabetical
//--get rid of the standard categories metabox
function apm_coupons_hide_metabox() {
	remove_meta_box('apm-coupon-monthsdiv', 'apm-coupons', 'side');
}

add_action('admin_menu', 'apm_coupons_hide_metabox');


//--add a new custom metabox so that category order can be filtered by date added
function apm_coupons_add_custom_sort_metabox() {
	add_meta_box('apm-coupon-monthsdiv', 'Month to Run Coupon', 'custom_month_meta_box', 'apm-coupons', 'side', 'default');
}

add_action('admin_menu', 'apm_coupons_add_custom_sort_metabox');

//--the callback for adding the new metabox
function custom_month_meta_box() {
	
	//--get the custom taxonomy
	$taxonomy = 'apm-coupon-months';

	//--set the custom taxonomy
	$tax = get_taxonomy($taxonomy);

	//--name of the form to output, make sure to add full array
	$name = 'tax_input[apm-coupon-months][]';

	//--set the ids of the terms
	$category_ids = array();

	//--loop through all of the term ids and add to array
	$postterms = get_the_terms(get_the_ID(), $taxonomy);
	foreach($postterms as $cat) {
		
		$category_ids[] = $cat->term_id;
	}

	
	//--get all of the terms by name and order them by their id. This will order them by correct month order
	$monthsTerms = get_terms(array('taxonomy' => 'apm-coupon-months', 'hide_empty' => false, 'orderby'=>'id', 'order'=>'asc'));
	
	//--output the taxonomy in the metabox. Make sure to use correct classes and ids for wordpress
	?>

	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
		<ul id="<?php echo $taxonomy;?>checklist" class="list:<?php echo $taxonomy;?> categorychecklist form-no-clear">


			<?php
			//loop through each month term
			foreach ($monthsTerms as $monthTerm) {
				$id = $taxonomy.'-' .$monthTerm->term_id;


				echo "<li id='$id'><label class='selectit'>";
				?>

				<!--must use satandard php function to set checked, not wordpress checked function.
					if the month id is in the array for existing category ids, then set it to checked-->
				<input type="checkbox" id="in-<?php echo $id;?>" name="<?php echo $name;?>" value="<?php echo $monthTerm->term_id;?>" <?php if(in_array($monthTerm->term_id, $category_ids)){ echo 'checked ="checked"';}?> /><?php echo $monthTerm->name;?><br>
				<?php
				echo "</label></li>";
				
			}

			?>
		</ul>
	</div>

	<?php
		
}


//var_dump($_POST);