<?php
	/**
	 * Blog Page
	 *
	 * Post Types
	 */

	$object_id = get_queried_object_id();

	//Getting Single Post Sidebar Position
	$wc_sidebar_position_default = get_theme_mod("wc_services_sidebar");
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

<div class="<?php echo esc_attr( $wc_columns_quantity ); ?> posts-wrap">
	<div class="posts-container row">
    <?php if( have_posts() ) : while( have_posts() ): the_post(); ?>

    <div class="medium-12 small-12 columns">
    	<div <?php post_class(); ?>>
        <div class="block-image">
          <?php
						if( has_post_thumbnail() ) {
							the_post_thumbnail( 'wc-blog-page' );
						}
					?>
        </div><!-- Thumb /-->

        <div class="block-info">
					<?php

						the_content();

						if( the_field( 'services_button' ) == "yes" ) {
							echo '<div class="content-button">';
							echo '<a href="' . the_field( 'service_link' ) . '" target="_self" title="' . the_title() . '">Read more</a>';
							echo '</div>';
						}

					?>
        </div><!-- post content /-->
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