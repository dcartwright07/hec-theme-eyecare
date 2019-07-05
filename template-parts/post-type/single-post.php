<?php
	/**
	 * Blog Page
	 *
	 * Post Types
	 */
	
	$object_id = get_queried_object_id();
				
	//Getting Single Post Sidebar Position 
	$wc_sidebar_position_default = get_theme_mod("wc_singlepost_sidebar");
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
    <div <?php post_class("blog-post"); ?>>
        <?php if(is_sticky() && is_home() && !is_paged()) : ?>
            <span class="sticky-post"><?php esc_html_e('Featured', 'eyecare'); ?></span>
        <?php endif; ?>

		<?php 
			//Generate No meta class
			if(get_theme_mod("wc_singlepost_metainfo") == 'on'):
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
            <?php if(get_theme_mod("wc_singlepost_metainfo") != "on"): ?>
            <div class="post-meta">
            	<ul class="no-bullet">
                    <li><i class="fa fa-clock-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li> 
                    <li><i class="fa fa-user" aria-hidden="true"></i> <?php the_author_posts_link(); ?></li> 
                    
                    <li><i class="fa fa-list" aria-hidden="true"></i> <?php echo get_the_category_list(', '); ?></li> 
                    <li><i class="fa fa-comments-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_comments_link()); ?>"><?php comments_number(); ?></a></li>
                </ul>
            </div><!-- Post Meta /-->
        	<?php endif; ?>
           <?php 
				the_content();
			?>
            <?php
			wp_link_pages( array( 'before' => '<div class="pagination-container single-post-pagination"><ul class="pagination"><li>'.esc_html__("Pages", "eyecare").'</li> ', 'after' => '</div>' ) );
		?>
        </div><!-- post content /-->
    </div><!-- blog-post Ends here /-->
    	
         <?php if(get_theme_mod('wc_singlepost_tags')  != 'on' || get_theme_mod('wc_singlepost_sharingicons')  != 'on' ) : ?>
        <div class="sharing-posts">
        	<?php if(get_theme_mod('wc_singlepost_tags')  != 'on'): ?>
             <div class="medium-10 small-12 columns">
                 <div class="post-tags">
                 	<?php 
						if(get_the_tag_list()) {
							$tag_title = esc_html__('Tags', 'eyecare');
							echo get_the_tag_list('<ul class="tags"><li><strong>'.$tag_title.': </strong></li><li>','</li><li>','</li></ul>');
						}
					?>
                </div>
             </div>
             <?php endif; //disable tags ?>   
                            
             <?php if(get_theme_mod('wc_singlepost_sharingicons')  != 'on'): ?>
             <div class="medium-2 small-12 columns">
                <div class="post-share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google"></i></a>
                </div>
            </div><!-- share post ends -->
            <?php endif; //disable sharing icons ?>
	
            <div class="clearfix"></div>
        </div><!-- sharing row Ends -->
        <?php endif; //disable social sharing posts. ?>
       
       
       
       <?php 
		$author_description = get_the_author_meta('description');
		
		if(!empty($author_description) && get_theme_mod('wc_singlepost_authorbox')  != 'on'): ?>
		<div class="author-box">
			<div class="medium-2 small-2 columns">
				<?php echo get_avatar( get_the_author_meta('ID'), 96 ); ?>
			</div>
			<div class="medium-10 small-10 columns">
				<p><strong><?php esc_html_e('About', 'eyecare'); ?> <?php the_author_posts_link(); ?></strong><br> <?php echo nl2br(get_the_author_meta('description')); ?></p>
			</div>
			<div class="clearfix"></div>
		</div><!-- author Box ends here -->
		<div class="spacer-border"></div>
		<?php endif; //Disbale Author Box ?>
		
		<?php 
			//Giving User access to disable Comments easily!
			if(get_theme_mod('wc_singlepost_comments')  != 'on'): 
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endif; //Disable Comments 
		?>
       
       
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