<?php
	/**
	 * Call To Action
	 * Template
	 */
	 
	$object_id = get_queried_object_id();
	
	if(class_exists('WooCommerce')):
		if(is_shop() || is_product() || is_product_category() || is_product_tag()) { 
			$object_id = get_option('woocommerce_shop_page_id');
		}
	endif;
	
	/**
	 * Check if Enabled 
	 * Or Disabled Call To Action
	 */
	$wc_special_cta_status = get_post_meta($object_id, 'wc_display_calltoaction', true);
	$wc_default_cta_status = get_theme_mod('wc_footer_cta_dp');
	
	if(!empty($wc_special_cta_status)) { 
		if($wc_special_cta_status == 'on') { 
			$wc_topbar_cta_status = 'enable';
		} else { 
			$wc_topbar_cta_status = 'disable';
		}
	} else {
		if(empty($wc_default_cta_status)) { 
			$wc_topbar_cta_status = 'disable';
		} else { 
			$wc_topbar_cta_status = 'enable';
		}
	} 
?>	 
<?php 
	if($wc_topbar_cta_status == 'enable'): 
	
	/**
	 * Setting Values To Display
	 */
	
	//Left Side Text
	$special_left_txt   = get_post_meta($object_id, "wc_leftcontent_calltoaction", true);
	$default_left_txt 	= get_theme_mod("wc_footer_cta_lefttxt");
	
	if(!empty($special_left_txt)) { 
		$left_content = $special_left_txt;
	} else if(!empty($default_left_txt)) { 
		$left_content = $default_left_txt;
	} else { 
		$left_content = esc_html__("If you Have Any Questions We are Here", "eyecare")." <span>".esc_html__("DON'T HESITATE TO CONTACT US ANY TIME.", "eyecare")."</span>";
	}
	
	//Button Text
	$special_btn_txt    = get_post_meta($object_id, "wc_btntxt_calltoaction", true);
	$default_btn_txt 	= get_theme_mod("wc_footer_cta_btntxt");
	
	if(!empty($special_btn_txt)) { 
		$button_txt = $special_btn_txt;
	} else if(!empty($default_btn_txt)) { 
		$button_txt = $default_btn_txt;
	} else { 
		$button_txt = __("Appointment", "eyecare"); //Escaped on Print
	}
	
	//Button Link
	$special_btn_link   = get_post_meta($object_id, "wc_btnlink_calltoaction", true);
	$default_btn_link 	= get_theme_mod("wc_footer_cta_btnlink");
	
	if(!empty($special_btn_link)) { 
		$button_link = $special_btn_link;
	} else if(!empty($default_btn_link)) { 
		$button_link = $default_btn_link;
	} else { 
		$button_link = "/appointment/";
	}
	
	
	//Image Side 
	$default_side_image = get_theme_mod("wc_cta_side_image");
	$special_side_image = get_post_meta($object_id, "wc_cta_side_image", true); 
	
	if(!empty($special_side_image)) { 
		$default_side_image = $special_side_image;
	}
	
	if(!empty($default_side_image)) { 
		$column_class = "large-offset-2 large-8 medium-12 small-12 columns";
		$notopmargin  = "yestopmargin";
	} else { 
		$column_class = "medium-12 large-8 small-12 columns";
		$notopmargin  = "notopmargin";
	}
?>
	<!-- Call to Action box -->
	<div class="call-to-action <?php echo esc_attr($notopmargin); ?>">
    	<?php 
			if(!empty($default_side_image)) { ?>
			<img src="<?php echo esc_url($default_side_image); ?>" alt="<?php esc_html_e("Call To Action Image", "eyecare"); ?>" />	
		<?php }	?>
	   <div class="row">
			<div class="<?php echo esc_attr($column_class); ?>">
				<h2><?php echo wp_kses_post($left_content); ?></h2>
			</div>
			<div class="large-2 medium-12 small-12 columns text-right">
				<a href="<?php echo esc_url($button_link); ?>" class="button primary bordered-light"><?php echo esc_html($button_txt); ?></a>
			</div>
	   </div><!-- row /-->
	 </div>
	<!-- Call to Action End /--> 
<?php endif; ?>    