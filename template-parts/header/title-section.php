<?php
	/**
	 * Title Section
	 * Template
	 */
	 
	$object_id = get_queried_object_id();
	
	if(class_exists('WooCommerce')):
		if(is_shop() || is_product() || is_product_category() || is_product_tag()) { 
			$object_id = get_option('woocommerce_shop_page_id');
		}
	endif;
	
	$wc_special_ts_status = get_post_meta($object_id, "wc_display_title_section", true);
	$wc_default_ts_status = get_theme_mod("wc_disable_sectiontitle");

	if(!empty($wc_special_ts_status)) { 
		if($wc_special_ts_status == 'on') { 
			$title_section_status = 'enable';
		} else { 
			$title_section_status = 'disable';
		}
	} else {
		if($wc_default_ts_status == 'on') { 
			$title_section_status = 'disable';
		} else { 
			$title_section_status = 'enable';
		}
	}


	//Header Type Clss
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
?>

<?php if($title_section_status == "enable"): ?>
<!-- Title Section -->
<div class="title-section module <?php echo esc_attr($header_type); ?>">
    <div class="row">

        <div class="small-12 columns">
            <h1><?php wc_pages_titles(); //lib/core-functions.php ?></h1>
        </div><!-- Top Row /-->
		
        <?php
			// BreadCrumbs Section
			$wc_special_bc_status = get_post_meta($object_id, "wc_display_breadcrumbs", true);
			$wc_default_bc_status = get_theme_mod("wc_disable_breadcrumbs");
			
			if(!empty($wc_special_bc_status)) { 
				if($wc_special_bc_status == 'on') { 
					$bc_status = 'enable';
				} else { 
					$bc_status = 'disable';
				}
			} else {
				if($wc_default_bc_status == 'on') { 
					$bc_status = 'disable';
				} else { 
					$bc_status = 'enable';
				}
			}
			
			if($bc_status == "enable"):
		?>	
        <div class="small-12 columns">
            <?php wc_custom_breadcrumbs(); ?>
        </div><!-- Bottom Row /-->
        <?php endif; ?>
        
    </div><!-- Row /-->
</div>
<!-- Title Section Ends /-->
<?php else:  
	//Add Spacer to all files not in Modules
	$template_name = get_page_template_slug( $post->ID );
	
	if($template_name != 'template-modules.php') { 
		echo "<div class='module'><!-- Works as spacer--></div>";
	}
	
	endif; 
?>