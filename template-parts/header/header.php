<?php 
	/**
     * Get Header Type
     * Include Appropriate Header
     */
	
	$object_id = get_queried_object_id();
	
	if(class_exists('WooCommerce')):
		if(is_shop() || is_product() || is_product_category() || is_product_tag()) { 
			$object_id = get_option('woocommerce_shop_page_id');
		}
	endif;
	
	$wc_special_header = get_post_meta($object_id, 'wc_header_type_display', true);
	$wc_default_header = get_theme_mod('wc_header_type_display'); 

	if($wc_special_header == "type-one" || $wc_special_header == "type-two" || $wc_special_header == "type-three") { 
	  	$header_type = $wc_special_header; 
	 } else if($wc_default_header == "type-one" || $wc_default_header == "type-two" || $wc_default_header == "type-three") { 
		$header_type = $wc_default_header;		   
	} else { 
		//Sets Default Header Type 3
		$header_type = 'type-three';
	}
	
	//getting Appropriate template
	get_template_part("template-parts/header/headers/".$header_type);