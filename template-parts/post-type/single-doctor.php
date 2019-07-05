<?php
	/**
	 * Blog Page
	 *
	 * Post Types
	 */
	
	$object_id = get_queried_object_id();
				
	//Getting Single Post Sidebar Position 
	$wc_sidebar_position_default = get_theme_mod("wc_disable_rightleft_optsidebar");
	$wc_sidebar_position_special = get_post_meta($object_id, "wc_innerpage_sidebar_position", true);
	
	
	/**
	 * Status Of Doctor Sidebar
	 * If Enable Or Disable
	 */
	if($wc_sidebar_position_special == "disable_sidebar") { 
		$wc_columns = "disable_sidebar";
	} else if($wc_sidebar_position_default == "disable_sidebar" && empty($wc_sidebar_position_special)) { 
		$wc_columns = "disable_sidebar";
	} else { 
		$wc_columns = "";
	}
	
	/**
	 * Status Of Sidebar Appointment
	 * If Enable Or Disable
	 */
	$wc_default_appointment_status = get_theme_mod("wc_disable_appointment");
	$wc_special_appointment_status = get_post_meta($object_id, "wc_appointment_disable", true);


	if(!empty($wc_special_appointment_status)) { 
		if($wc_special_appointment_status == 'on') { 
			$wc_form_status = 'enable';
		} else { 
			$wc_form_status = 'disable';
		}
	} else {
		if(empty($wc_default_appointment_status)) { 
			$wc_form_status = 'enable';
		} else { 
			$wc_form_status = 'disable';
		}
	}
	
	if($wc_columns == "disable_sidebar") { 
		if($wc_form_status == "enable") { 
			$wc_columns_quantity = "medium-9 small-12 columns content-side";	
		} elseif($wc_form_status == "disable") { 
			$wc_columns_quantity = "medium-12 small-12 columns content-side";
		}
	} else { 
		if($wc_form_status == "enable") { 
			$wc_columns_quantity = "medium-6 small-12 columns content-side";	
		} elseif($wc_form_status == "disable") { 
			$wc_columns_quantity = "medium-9 small-12 columns content-side";
		}		
	}
?>
<div class="<?php echo esc_attr($wc_columns_quantity); ?> posts-wrap">
	<div class="posts-container row">
    <?php if(have_posts()) : while(have_posts()): the_post(); ?> 
    
    <div class="medium-12 small-12 columns">
    <div <?php post_class(); ?>>
	   <?php 
            the_content();

            wp_link_pages( array( 'before' => '<div class="pagination-container single-post-pagination"><ul class="pagination"><li>'.esc_html__("Pages", "eyecare").'</li> ', 'after' => '</div>' ) );
        ?>
    </div><!-- blog-post Ends here /-->
    </div><!-- Column Ends /-->
    
    <?php 
		endwhile;
		
		else: 
			echo "<p>";
				esc_html_e("Sorry but could not find anything related to your criteria.", "eyecare");
			echo "</p>";
	 	endif; 
	 ?>
    </div><!-- Posts Container /-->
</div><!-- Posts wrap /-->