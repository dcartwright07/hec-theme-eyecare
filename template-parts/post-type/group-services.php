<?php
	/**
	 * Services Loop
	 *
	 * Post Types Services
	 */
?>

    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <div class="medium-4 small-12 columns service">
        <div class="serivce-block">
            <div class="service-thumb">
                <?php if( has_post_thumbnail() ) { ?>
                    <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'wc-service-small-thumb' ); ?>
                    </a>
                <?php } ?>
            </div><!-- Service Thumb /-->
            <div class="service-info">
                <h4><?php the_title(); ?></h4>
                <p>
								<?php
									// echo wc_custom_excerpt_length(150);
									the_content();
								?>
                </p>
            </div><!-- Service Info /-->
        </div><!-- Service /-->
    </div><!-- Service Blog column /-->


    <?php endwhile; ?>
	<div class="clearfix"></div>
    <?php
			wc_pagination(); //calling pagination
		else:
			echo "<p>";
				esc_html_e( "Sorry but could not find anything related to your criteria.", "eyecare" );
			echo "</p>";
	 	endif;
	 ?>
