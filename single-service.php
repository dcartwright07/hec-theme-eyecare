<?php
	//Getting Header
	get_header();

	$object_id = get_queried_object_id();

	//Getting Single Post Sidebar Position
	$wc_sidebar_position_default = get_theme_mod("wc_services_sidebar");
	$wc_sidebar_position_special = get_post_meta($object_id, "wc_innerpage_sidebar_position", true);

	if($wc_sidebar_position_special == "left_sidebar"  ||
	   $wc_sidebar_position_special == "right_sidebar" ||
	   $wc_sidebar_position_special == "disable_sidebar") {
		$wc_sidebar_position = $wc_sidebar_position_special;
	} else {
		$wc_sidebar_position = $wc_sidebar_position_default;
	}

	$sidebar_position_class = "left_sidebar";
	if($wc_sidebar_position == "right_sidebar") {
		$sidebar_position_class = "right_sidebar";
	} else if($wc_sidebar_position == "disable_sidebar") {
		$sidebar_position_class = "disable_sidebar";
	}
?>

    <!-- Content section -->
    <div class="content-area single-service module <?php esc_attr_e($sidebar_position_class); ?>">
        <div class="row">

				<p>Testing this code.</p>
        	<?php
				//Getting posts sides
				get_template_part('template-parts/post-type/single-service');

				if($wc_sidebar_position != "disable_sidebar"){
					//Right Sidebar
					get_template_part('template-parts/sidebar/services-sidebar');
				}
			?>
        </div><!-- Row Ends /-->
    </div>
    <!-- Content Section Ends /-->

	<?php
		$default_enable_team = get_theme_mod("wc_services_activate");

		if(empty($default_enable_team)) {
			$wc_team_status = 'disable';
		} else {
			$wc_team_status = 'enable';
		}

		if($wc_team_status == 'enable'):

		$section_title 			= get_theme_mod("wc_services_team_title");
		$section_description 	= get_theme_mod("wc_services_team_title_desc");

		if(empty($section_title)) {
			$section_title = esc_html__('Meet Our', 'eyecare'). ' <span>'.esc_html__("Optometrists", "eyecare").'</span>';
		}

		if(empty($section_description)) {
			$section_description = esc_html__("We Have Best Professional Team To Care Your Eyes", "eyecare");
		}
	?>
    <!-- Our Team -->
    <div class="our-team module">
        <div class="section-title-wrapper row">
            <div class="section-title">
                <h2><?php echo wp_kses_post($section_title); ?></h2>
                <p><?php echo esc_html($section_description); ?></p>
            </div>
        </div><!-- Section Title /-->

        <div class="row">
            <div class="teams-wrapper side-controls">

                <?php
					$post_args = array(
						'post_type' 		=> esc_html__('optometrist', 'eyecare'),
						'order' 			=> 'DESC',
						'posts_per_page' 	=> 4
					);

					$optometrist_query = new WP_Query($post_args);

					if($optometrist_query->have_posts()) {
						while($optometrist_query->have_posts()) {
							$optometrist_query->the_post();
							global $post;

							$wc_doctor_facebook 	= get_post_meta($post->ID, 'wc_doctor_facebook', true);
							$wc_doctor_twitter 		= get_post_meta($post->ID, 'wc_doctor_twitter', true);
							$wc_doctor_googleplus 	= get_post_meta($post->ID, 'wc_doctor_googleplus', true);
							$wc_doctor_linkedin 	= get_post_meta($post->ID, 'wc_doctor_linkedin', true);
							$wc_doctor_slogan 		= get_post_meta($post->ID, 'wc_doctor_slogan', true);
					?>
                    	<div class="doctor-column">
                            <div class="doctor">
                                <div class="doctor-thumb">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('wc-doctor-thumbnail'); ?>
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="button secondary">
										<?php esc_html_e("Visit Profile", "eyecare"); ?>
                                    </a>
                                </div><!-- Doctor thumb /-->
                                <div class="doctor-meta">
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
                            </div><!-- Doctor Ends /-->
                        </div><!-- Docot Column Ends /-->

                    <?php
						} //End While

						wp_reset_postdata(); //reset Loop
					} else {
						esc_html_e("No post in Optometrist section. Disable this section from Appearance >> Customize or add posts", "eyecare");
					} //End If
				?>
            </div><!-- Teams Wrapper /-->

        </div><!-- Row /-->

    </div>
    <!-- Our Team Ends /-->
	<?php endif; //Enable/Active Team Section ?>


<?php
	//Getting Footer
	get_footer();