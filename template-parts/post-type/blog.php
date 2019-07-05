<?php
	/**
	 * Blog Page
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
		$wc_columns_quantity = "medium-12 small-12 columns content-side";
	} else { 
		$wc_columns_quantity = "medium-9 small-12 columns content-side";		
	}
?>
<div class="<?php echo esc_attr($wc_columns_quantity); ?> posts-wrap">
	<div class="posts-container row">
    <?php if(have_posts()) : while(have_posts()): the_post(); ?> 
    
    <div class="medium-12 small-12 columns">
    <?php
		$padd_class = "no_padd";
		if ( has_post_thumbnail() ) {
			$padd_class = "yes_padd";
		}
	?>	
    <div <?php post_class($padd_class." blog-post"); ?>>
        <?php if(is_sticky() && is_home() && !is_paged()) : ?>
            <span class="sticky-post"><?php esc_html_e('Featured', 'eyecare'); ?></span>
        <?php endif; ?>

		<?php 
			//Generate No meta class
			if(get_theme_mod("wc_blogsection_metainfo") == 'on'):
        		$havemeta = "no-meta";
			else:
				$havemeta = "have-meta";
			endif;
		?>
        
        <div class="post-thumb">
            <?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('wc-blog-page'); ?>
				</a>
			<?php } ?>   
        </div><!-- Thumb /-->
        
        <div class="post-content <?php echo esc_attr($havemeta); ?>">
            <h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
           <?php 
		   		if(get_theme_mod('wc_display_full_excerpt') == 'full_content') { 
					the_content();
				} else { 
					the_excerpt();	
				} 
			?>
            
            <?php if(get_theme_mod("wc_blogsection_metainfo") != "on"): ?>
            <div class="post-meta">
            	<ul class="no-bullet">
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li> 
                    <li><i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?></li> 
                    
                    <li><i class="fa fa-list" aria-hidden="true"></i> <?php echo get_the_category_list(', '); ?></li> 
                    <li><i class="fa fa-comments-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number(); ?></a></li>
                </ul>
            </div><!-- Post Meta /-->
        	<?php endif; ?>
        </div><!-- post content /-->
    </div><!-- Column Ends /-->    
    </div><!-- blog-post Ends here /-->
    
    <?php endwhile; ?> 
		<!-- pagination starts -->
		<?php wc_pagination(); //calling pagination ?>
	<?php 
		else: 
			echo "<p>";
				esc_html_e("Sorry but could not find anything related to your criteria.", "eyecare");
			echo "</p>";
	 	endif; 
	 ?>
    </div><!-- Posts Container /-->
</div><!-- Posts wrap /-->