<?php
	/**
	 * Optometrist Loop
	 *
	 * Post Types Services
	 */
?>

   <?php
   		$counter = 0;

		if(have_posts()) : while(have_posts()): the_post();

		$counter++;

		if($counter % 2 == 0) {
			//Even Posts
			$float_class = "float-left";
			$item_class = "item-two";
		} else {
			//Odd Posts
			$float_class = "float-right";
			$item_class = "item-one";
		}

		$wc_doctor_facebook 	= get_post_meta($post->ID, 'wc_doctor_facebook', true);
		$wc_doctor_twitter 		= get_post_meta($post->ID, 'wc_doctor_twitter', true);
		$wc_doctor_googleplus 	= get_post_meta($post->ID, 'wc_doctor_googleplus', true);
		$wc_doctor_linkedin 	= get_post_meta($post->ID, 'wc_doctor_linkedin', true);
		$wc_doctor_slogan 		= get_post_meta($post->ID, 'wc_doctor_slogan', true);
	?>

    <div class="doctor-column medium-6 small-12 columns">
        <div class="doctor">
            <div class="doctor-thumb <?php echo esc_attr($float_class); ?>">
                <?php if ( has_post_thumbnail() ) { ?>
                    <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('wc-doctor-thumbnail'); ?>
                    </a>
                <?php } ?>
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="button">
                    <?php esc_html_e("Visit Profile", "eyecare"); ?>
                </a>
            </div><!-- Doctor thumb /-->
            <div class="doctor-meta <?php echo esc_attr($item_class); ?>">
                <h4><?php if(!empty($wc_doctor_slogan)) {echo esc_html($wc_doctor_slogan); } else { echo "&nbsp;"; }?></h4>
                <h3><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html(wc_custom_excerpt_length(220)); ?></p>
                <div class="doctor-links">
                    <ul class="menu">
                    	<?php if(!empty($wc_doctor_facebook)) {
							echo '<li><a href="'.esc_url($wc_doctor_facebook).'"><i class="fa fa-facebook"></i></a></li>';
						} if(!empty($wc_doctor_twitter)) {
							echo '<li><a href="'.esc_url($wc_doctor_twitter).'"><i class="fa fa-twitter"></i></a></li>';
						} if(!empty($wc_doctor_googleplus)) {
							echo '<li><a href="'.esc_url($wc_doctor_googleplus).'"><i class="fa fa-google-plus"></i></a></li>';
						} if(!empty($wc_doctor_linkedin)) {
							echo '<li><a href="'.esc_url($wc_doctor_linkedin).'"><i class="fa fa-linkedin"></i></a></li>';
						} ?>
                    </ul>
                </div><!-- Doctor links /-->
            </div><!-- Doctor meta /-->
            <div class="clearfix"></div>
        </div><!-- Doctor Ends /-->
    </div><!-- Docot Column Ends /-->

    <?php endwhile; ?>
	<div class="clearfix"></div>
    <?php
			wc_pagination(); //calling pagination
		else:
			echo "<p>";
				esc_html_e("Sorry but could not find anything related to your criteria.", "eyecare");
			echo "</p>";
	 	endif;
	 ?>