<?php
	$object_id = get_queried_object_id();

	if(class_exists('WooCommerce')):
		if(is_shop() || is_product() || is_product_category() || is_product_tag()) {
			$object_id = get_option('woocommerce_shop_page_id');
		}
	endif;

	/**
	 * Check if Enabled
	 * Or Disabled TopBar
	 */
	$wc_special_ft_status = get_post_meta($object_id, 'wc_display_footertop', true);
	$wc_default_ft_status = get_theme_mod('wc_footer_top_display');

	if(!empty($wc_special_ft_status)) {
		if($wc_special_ft_status == 'on') {
			$wc_footertop_status = 'enable';
		} else {
			$wc_footertop_status = 'disable';
		}
	} else {
		if($wc_default_ft_status == 'on') {
			$wc_footertop_status = 'disable';
		} else {
			$wc_footertop_status = 'enable';
		}
	}

	//If FooterTop have any Widget available
	if($wc_footertop_status == "enable"):
		if(is_active_sidebar("footer-one") || is_active_sidebar("footer-two") || is_active_sidebar("footer-three") || is_active_sidebar("footer-four") ) {
			$wc_footertop_status = "enable";
		} else {
			$wc_footertop_status = "disable";
		}
	endif;

	/**
	 * Widgets Quantity
	 * Getting Quantity
	 */

	 $wc_special_ft_q = get_post_meta($object_id, 'wc_footertop_widgets', true);
	 $wc_default_ft_q = get_theme_mod('wc_footer_top_widgetsq');

	 if(!empty($wc_special_ft_q)) {
	 	$widgets = $wc_special_ft_q;
	 } else if(!empty($wc_default_ft_q)) {
	 	$widgets = $wc_default_ft_q;
	 } else {
	 	$widgets = "four-widgets";
	 }

	 if($widgets == 'four-widgets' || $widgets == '') {
		//Four Columns
		$classes = 'large-3 medium-6 small-12 columns';
	} else if($widgets == 'three-widgets') {
		//3 Widgets
		$classes = 'large-4 medium-6 small-12 columns';
	} else if($widgets == 'two-widgets') {
		//2 Widgets
		$classes = 'medium-6 small-12 columns';
	} else {
		$classes = 'small-12 columns';
	}
?>

<?php if(isset($wc_footertop_status) && $wc_footertop_status == 'enable'): ?>
<div class="footerTop">

    <div class="row">

    	<div class="<?php echo esc_attr($classes); ?>">
		<?php
			if(is_active_sidebar("footer-one")) {
				dynamic_sidebar("footer-one");
			}
		?>
        </div><!-- Widget Ends /-->

        <div class="<?php echo esc_attr($classes); ?>">
		<?php
			if(is_active_sidebar("footer-two")) {
				dynamic_sidebar("footer-two");
			}
		?>
        </div><!-- Widget Ends /-->

        <?php if($widgets == 'three-widgets' || $widgets == 'four-widgets'): ?>
        <div class="<?php echo esc_attr($classes); ?>">
		<?php
			if(is_active_sidebar("footer-three")) {
				dynamic_sidebar("footer-three");
			}
		?>
        </div><!-- Widget Ends /-->
        <?php endif; ?>

        <?php if($widgets == 'four-widgets'): ?>
        <div class="<?php echo esc_attr($classes); ?>">
		<?php
			if(is_active_sidebar("footer-four")) {
				dynamic_sidebar("footer-four");
			}
		?>
        </div><!-- Widget Ends /-->
    	<?php endif; ?>

    </div><!-- Row Ends /-->

</div><!-- footerTop Ends here.. -->
<?php endif; ?>