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
	$wc_special_status = get_post_meta($object_id, 'wc_topbar_enable', true);
	$wc_default_status = get_theme_mod('wc_topbar_sty_disable');
	
	if(!empty($wc_special_status)) { 
		if($wc_special_status == 'on') { 
			$wc_topbar_status = 'enable';
		} else { 
			$wc_topbar_status = 'disable';
		}
	} else {
		if(empty($wc_default_status)) { 
			$wc_topbar_status = 'disable';
		} else { 
			$wc_topbar_status = 'enable';
		}
	}
	
	/**
	 * What to Display
	 * On Left Side
	 */
	$wc_topbar_left_display_special = get_post_meta($object_id, 'wc_topbar_ls_display', true);
	$wc_topbar_left_display_default = get_theme_mod('wc_tb_ls_type'); 
	
	if($wc_topbar_left_display_default != 'top-menu' 	&& 
	   $wc_topbar_left_display_default != 'text-field' 	&& 
	   $wc_topbar_left_display_default != 'selective-icons') { 
	   		$wc_topbar_left_display_default = 'text-field';
	}//set default Value for Left Side
	 
	if($wc_topbar_left_display_special == 'top-menu' 	|| 
	   $wc_topbar_left_display_special == 'text-field'  || 
	   $wc_topbar_left_display_special == 'selective-icons') { 
	  		$display_top_left =  $wc_topbar_left_display_special;
	 } else { 
	 	$display_top_left = $wc_topbar_left_display_default;
	 }
	 
	 
	 /**
	 * What to Display
	 * On Right Side
	 */
	$wc_topbar_right_display_special = get_post_meta($object_id, 'wc_topbar_rs_display', true);
	$wc_topbar_right_display_default = get_theme_mod('wc_tb_rs_type'); 
	
	if($wc_topbar_right_display_default != 'top-menu' 	&& 
	   $wc_topbar_right_display_default != 'text-field' 	&& 
	   $wc_topbar_right_display_default != 'selective-icons') { 
	   		$wc_topbar_right_display_default = 'selective-icons';
	}//set default Value for Left Side
	 
	if($wc_topbar_right_display_special == 'top-menu' 	|| 
	   $wc_topbar_right_display_special == 'text-field'  || 
	   $wc_topbar_right_display_special == 'selective-icons') { 
	  		$display_top_right =  $wc_topbar_right_display_special;
	 } else { 
	 	$display_top_right = $wc_topbar_right_display_default;
	 }
	 
	 //Check status of Search box
	 $search_box_status = get_theme_mod("wc_topbar_search_box");
	 
	 if($search_box_status == "on") { 
	 	$search_box_status = "disabled";
	 } else { 
	 	$search_box_status = "enable";
		$search_class = "present-search";
	 }
?>

<?php if(isset($wc_topbar_status) && $wc_topbar_status == 'enable'): ?>
<!-- Top Bar Starts -->
<div class="topBar">
    <div class="row">
    
        <div class="large-6 medium-12 small-12 columns left-side">
        	<?php get_template_part('template-parts/header/top-bar/'.$display_top_left); ?>
        </div><!-- Left Column Ends /-->
    
        <div class="large-6 medium-12 small-12 columns right-side <?php echo esc_attr($search_class); ?>">
        	<?php 
				//Getting searchbox if Enabled
				if($search_box_status == "enable") { 
					get_search_form();
				}
				
				get_template_part('template-parts/header/top-bar/'.$display_top_right); 
			?>
            
        </div><!-- Right column Ends /-->
    
    </div><!-- Row ends /-->
</div>
<!-- Top bar Ends /-->
<?php endif; ?>