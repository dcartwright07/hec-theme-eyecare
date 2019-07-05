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

	//Generate No meta class
	if(get_theme_mod("wc_blogsection_metainfo") == 'on'):
		$havemeta = "no-meta";
	else:
		$havemeta = "have-meta";
	endif;
?>
<div class="<?php echo esc_attr($wc_columns_quantity); ?> posts-wrap">
	<div class="posts-container row">
    <?php if(have_posts()) : while(have_posts()): the_post(); ?> 
    
    <div class="medium-12 small-12 columns">
    <div <?php post_class("post"); ?>>
        
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
				the_excerpt();	
			?>
            
            <div class="post-meta">
            	<ul class="no-bullet">
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li> 
                    <li><i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?></li> 
                    <li><i class="fa fa-comments-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number(); ?></a></li>
                </ul>
            </div><!-- Post Meta /-->
        </div><!-- post content /-->
    </div><!-- Column Ends /-->    
    </div><!-- blog-post Ends here /-->
    
    <?php endwhile; ?> 
		<!-- pagination starts -->
		<?php wc_pagination(); //calling pagination ?>
	<?php else:
		echo "<h2>";
		 	esc_html_e("Nothing Found For:", "eyecare");
			echo "<strong>";
			echo esc_html(get_search_query()); 
		echo "</strong></h2>"; 
		echo "<p>";
		 	esc_html_e("Sorry, but nothing matched your search terms. Please try again with some different keywords.", "eyecare");
		echo "</p>";
		echo '<div class="row"><div class="medium-6 small-12 columns">';
			echo get_search_form();
		echo '</div></div>';
	endif; ?>
    </div><!-- Posts Container /-->
</div><!-- Posts wrap /-->