<?php
	$object_id = get_queried_object_id();

	if(class_exists('WooCommerce')):
		if(is_shop() || is_product() || is_product_category() || is_product_tag()) {
			$object_id = get_option('woocommerce_shop_page_id');
		}
	endif;


	/**
	 * Check if Enabled
	 * Or Disabled Footer Bottom
	 */
	$wc_default_fi_status = get_theme_mod('wc_footer_information-boxes_display');

	if($wc_default_fi_status == 'on') {
		$wc_footerinfo_status = 'enable';
	} else {
		$wc_footerinfo_status = 'disable';
	}

	//Enable or Disable Footer Bottom
	if(isset($wc_footerinfo_status) && $wc_footerinfo_status == 'enable'):

	//Boxes to Display
	$wc_default_boxes_display = get_theme_mod('wc_footer_information-boxes_widgetsq');

	if(!empty($wc_default_boxes_display)) {
		$boxes_to_display = $wc_default_boxes_display;
	} else {
		$boxes_to_display = "three-widgets";
	}


	/**
	 * Setting Variables
	 *
	 * For First box
	 */
	 $first_box_icon = get_theme_mod("wc_footer_information-boxes_one_icon");

	 if(empty($first_box_icon)) {
	 	$first_box_icon = "fa-phone";
	 }

	 //First box Title
	 $first_box_title = get_theme_mod("wc_footer_information-boxes_one_title");

	 if(empty($first_box_title)) {
	 	$first_box_title = esc_html__("Have a question? call us now", "eyecare");
	 }

	 //First Box Description
	 $first_box_desc = get_theme_mod("wc_footer_information-boxes_one_desc");

	 if(empty($first_box_desc)) {
	 	$first_box_desc = esc_html__("+92 345 44433456", "eyecare");
	 }


	 /**
	 * Setting Variables
	 *
	 * For Second box
	 */
	 $second_box_icon = get_theme_mod("wc_footer_information-boxes_two_icon");

	 if(empty($second_box_icon)) {
	 	$second_box_icon = "fa-clock-o";
	 }

	 //Second box Title
	 $second_box_title = get_theme_mod("wc_footer_information-boxes_two_title");

	 if(empty($second_box_title)) {
	 	$second_box_title = esc_html__("We are open on", "eyecare");
	 }

	 //Second Box Description
	 $second_box_desc = get_theme_mod("wc_footer_information-boxes_two_desc");

	 if(empty($second_box_desc)) {
	 	$second_box_desc = esc_html__("Mon - Fri: 08:00 - 17:00", "eyecare");
	 }


	 /**
	 * Setting Variables
	 *
	 * For Third box
	 */
	 $third_box_icon = get_theme_mod("wc_footer_information-boxes_three_icon");

	 if(empty($third_box_icon)) {
	 	$third_box_icon = "fa-envelope";
	 }

	 //Third box Title
	 $third_box_title = get_theme_mod("wc_footer_information-boxes_three_title");

	 if(empty($third_box_title)) {
	 	$third_box_title = esc_html__("Drop Us an Email", "eyecare");
	 }

	 //Third Box Description
	 $third_box_desc = get_theme_mod("wc_footer_information-boxes_three_desc");

	 if(empty($third_box_desc)) {
	 	$third_box_desc = esc_html__("yours@webfulcreations.com", "eyecare");
	 }


	//Columns Class
	if($boxes_to_display == "three-widgets") {
		$columns_class = "large-4 medium-12 small-12 columns";
	} else if($boxes_to_display == "two-widgets") {
		$columns_class = "large-6 medium-12 small-12 columns";
	}
?>
<div class="footer-information-boxes">

    <div class="row">

        <div class="<?php echo esc_attr($columns_class); ?>">
        	<div class="footer-icon-box">
            	<div class="icon-side">
                	<i class="fa <?php echo esc_attr($first_box_icon); ?>"></i>
                </div>
                <div class="info-side">
                	<h2><?php echo esc_html($first_box_title); ?></h2>
                  <p><?php echo esc_html($first_box_desc); ?></p>
                </div>
            </div><!-- Icon Box Ends /-->
        </div><!-- Column First /-->

        <div class="<?php echo esc_attr($columns_class); ?>">
        	<div class="footer-icon-box">
            	<div class="icon-side">
                	<i class="fa <?php echo esc_attr($second_box_icon); ?>"></i>
                </div>
                <div class="info-side">
                	<h2><?php echo esc_html($second_box_title); ?></h2>
                  <p><?php echo esc_html($second_box_desc); ?></p>
                </div>
            </div><!-- Icon Box Ends /-->
        </div><!-- Column First /-->

        <?php //Display only when 3 widgets
			if($boxes_to_display == "three-widgets") : ?>
        <div class="<?php echo esc_attr($columns_class); ?>">
        	<div class="footer-icon-box">
            	<div class="icon-side">
                	<i class="fa <?php echo esc_attr($third_box_icon); ?>"></i>
                </div>
                <div class="info-side">
                	<h2><?php echo esc_html($third_box_title); ?></h2>
                  <p><?php echo esc_html($third_box_desc); ?></p>
                </div>
            </div><!-- Icon Box Ends /-->
        </div><!-- Column First /-->
        <?php endif; ?>

    </div><!-- Row /-->

</div><!-- footer Bottom /-->
<?php endif; ?>