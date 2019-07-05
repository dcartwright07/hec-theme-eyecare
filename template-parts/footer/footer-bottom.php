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
	$wc_special_fb_status = get_post_meta($object_id, 'wc_display_footerbottom', true);
	$wc_default_fb_status = get_theme_mod('wc_footer_bottom_display');
	
	if(!empty($wc_special_fb_status)) { 
		if($wc_special_fb_status == 'on') { 
			$wc_footerbtm_status = 'enable';
		} else { 
			$wc_footerbtm_status = 'disable';
		}
	} else {
		if($wc_default_fb_status == 'on') { 
			$wc_footerbtm_status = 'disable';
		} else { 
			$wc_footerbtm_status = 'enable';
		}
	}

	//Enable or Disable Footer Bottom
	if(isset($wc_footerbtm_status) && $wc_footerbtm_status == 'enable'): 
	
	/**
	 * What to Display
	 * On Left Side
	 */
	$wc_fb_left_display_special = get_post_meta($object_id, 'wc_footer_bottom_ls_display', true);
	$wc_fb_left_display_default = get_theme_mod('wc_footer_bottom_ls');
         
	if($wc_fb_left_display_default != 'copyright-info' 	&& 
	   $wc_fb_left_display_default != 'selective-social-icons' 	&& 
	   $wc_fb_left_display_default != 'footer-menu') { 
	   		$wc_fb_left_display_default = 'selective-social-icons';
	}//set default Value for Left Side
	 
	if($wc_fb_left_display_special == 'copyright-info' 	|| 
	   $wc_fb_left_display_special == 'selective-social-icons'  || 
	   $wc_fb_left_display_special == 'footer-menu') { 
	  		$display_bottom_left =  $wc_fb_left_display_special;
	 } else { 
	 	$display_bottom_left = $wc_fb_left_display_default;
	 }
	 
	 
	 /**
	 * What to Display
	 * On Right Side
	 */
	$wc_fb_right_display_special = get_post_meta($object_id, 'wc_footer_bottom_rs_display', true);
	$wc_fb_right_display_default = get_theme_mod('wc_footer_bottom_rs');
         
	if($wc_fb_right_display_default != 'copyright-info' 	&& 
	   $wc_fb_right_display_default != 'selective-social-icons' 	&& 
	   $wc_fb_right_display_default != 'footer-menu') { 
	   		$wc_fb_right_display_default = 'copyright-info';
	}//set default Value for Left Side
	 
	if($wc_fb_right_display_special == 'copyright-info' 	|| 
	   $wc_fb_right_display_special == 'selective-social-icons'  || 
	   $wc_fb_right_display_special == 'footer-menu') { 
	  		$display_bottom_right =  $wc_fb_right_display_special;
	 } else { 
	 	$display_bottom_right = $wc_fb_right_display_default;
	 }

?>
<div class="footerbottom top">

    <div class="row">
    
        <div class="medium-12 small-12 columns text-center menu-centered">
        	<?php get_template_part("template-parts/footer/footer-bottom/".$display_bottom_left); ?>
        </div><!-- left side /-->
        
    </div><!-- Row /-->

</div><!-- footer Bottom /-->

<div class="footerbottom bottom">

    <div class="row">
    
        <div class="medium-12 small-12 columns text-center menu-centered">
        	<?php get_template_part("template-parts/footer/footer-bottom/".$display_bottom_right); ?>    
        </div><!-- Right Side /-->

    </div><!-- Row /-->

</div><!-- footer Bottom /-->
<?php endif; ?>