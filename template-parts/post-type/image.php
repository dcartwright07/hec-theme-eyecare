<?php
	/**
	 * Attachment Page
	 *
	 * Post Types
	 */
	
	$object_id = get_queried_object_id();
				
	//Getting Single Post Sidebar Position 
	$wc_sidebar_position_default = get_theme_mod("wc_blogsection_manage_sidebar");
	$wc_sidebar_position_special = get_post_meta($object_id, "wc_innerpage_sidebar_position", true);
	
	if($wc_sidebar_position_special == "disable_sidebar") { 
		$wc_columns = "disable_sidebar";
	} else if($wc_sidebar_position_default == "disable_sidebar" && empty($wc_sidebar_position_special)) { 
		$wc_columns = "disable_sidebar";
	} else { 
		$wc_columns = "";
	}
	
	if($wc_columns == "disable_sidebar") { 
		$wc_columns_quantity = "medium-12 small-12 columns";
	} else { 
		$wc_columns_quantity = "medium-9 small-12 columns";		
	}
?>
<div class="<?php echo esc_attr($wc_columns_quantity); ?> posts-wrap">    
    
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
    
    <!-- Post Starts -->
    <div id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class("eyecare-attachment"); ?>>

        <nav id="image-navigation" class="image-navigation">
            <div class="nav-links">
                <div class="nav-previous float-left"><?php previous_image_link( false, esc_html__( 'Previous Image', 'eyecare') ); ?></div>
                <div class="nav-next float-right"><?php next_image_link( false, esc_html__( 'Next Image', 'eyecare') ); ?></div>
            </div><!-- .nav-links -->
        	<div class="clearfix"></div>
        </nav><!-- .image-navigation -->
	
    	<div class="entry-attachment">
			<?php
                /**
                 * Filter the default Image Attachment Size
                 *
                 * @since 1.0.0
                 */
				$image_size = 'large';
                echo wp_get_attachment_image( get_the_ID(), $image_size, "", array("class" => "thumbnail") );
            ?>

            <?php the_excerpt('entry-caption'); ?>

        </div><!-- .entry-attachment -->
        	        

    </div><!-- post Ends here -->
    
	<?php endwhile; ?>
    	<!-- pagination starts -->
		<?php wc_pagination();//calling pagination ?>
    <?php else:  
		echo "<p>";
			 esc_html_e("Sorry but could not find anything related to your criteria.", "eyecare");
		echo "</p>";
	endif; ?>

</div>
<!-- content are ends -->