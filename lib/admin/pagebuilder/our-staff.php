<?php
/*
	* This file includes an Element to Kind Composer for Section doctors.
	*/

if( !function_exists( 'wc_our_doctors' ) && function_exists( 'wc_required_modules' ) ) {
	add_action( 'init', 'wc_our_doctors', 99 );

	function wc_our_doctors() {

		if( function_exists( 'kc_add_map' ) ) {
			//Getting doctors Groups Options to use below.
			$taxonomies = array( esc_html__( 'optometrist_group', 'eyecare' ) );
			$args = array(
				'orderby'		=> 'name',
				'order'			=> 'ASC',
				'hide_empty'=> true
			);
			$doctors_group = get_terms( $taxonomies, $args );
			$doctors_tax['default'] = esc_html__( 'All Groups', 'eyecare' );

			foreach( $doctors_group as $group ) {
				$group_slug = $group->slug;
				$group_name = $group->name;

				$doctors_tax[$group_slug] = $group_name;
			}
			//taxanomy Choices Ends.

			kc_add_map(
				array(
					'wc_kc_our_doctors' => array(
						'name' 				=> esc_html__( 'Our Doctors', 'eyecare' ),
						'description' => esc_html__( 'List Our doctors from Post Type Optometrists', 'eyecare' ),
						'icon' 				=> 'fa-user-md',
						'category' 		=> esc_html__( 'Optometrist', 'eyecare' ),
						'params' 			=> array(
							array(
								'name' 				=> 'wc_ourdoctors_display_type',
								'label' 			=> esc_html__( 'Type of Display', 'eyecare' ),
								'type' 				=> 'radio',
								'options' 		=> array(
									'show_carousel' => esc_html__( 'Display Carousel', 'eyecare' ),
									'show_grid' 		=> esc_html__( 'Display Grid', 'eyecare' )
								),
								'admin_label' => true,
								'description' => esc_html__( 'You want to Display Carousel or Grid.', 'eyecare' )
							),
							array(
								'name' 				=> 'wc_ourstaff_special_appearance',
								'label' 			=> esc_html__( 'Special Apperaance', 'eyecare' ),
								'type' 				=> 'checkbox',
								'options' 		=> array(
									'yes' => esc_html__( 'Yes', 'eyecare' ),
								),
								'admin_label' => true,
								'description' => esc_html__( 'If Checked Special Appearance for Staff, four Members per row with name display only. On hover other information come up.', 'eyecare' )
							),
							array(
								'name' 					=> 'wc_ourdoctors_display_group',
								'label' 				=> esc_html__( 'Group Of doctors', 'eyecare' ),
								'type' 					=> 'select',
								'options' 			=> $doctors_tax,
								'admin_label' 	=> true,
								'description' 	=> esc_html__( 'Select Group of doctors to Fetch Data from.', 'eyecare' )
							),
							array(
								'name' 					=> 'wc_ourdoctors_max_posts',
								'label' 				=> esc_html__( 'Maximum doctors', 'eyecare' ),
								'type' 					=> 'text',
								'admin_label' 	=> true,
								'description' 	=> esc_html__( 'Maximum doctors you want to display. Leave Blank to Fetch all.', 'eyecare' )
							)
						)// Param ends
					),  // End element

				)
			); // End add map

		} // End if

	}
} //Function exist/not


/*
	* Generating Short Code
	*
	* This will help to Generate Shortcode for The Element we created above.
	*
	* Requires Composer plugin activated
	*/

if( !function_exists( 'wc_kc_our_doctors_shortcode' ) && function_exists( 'wc_shortcode' ) ) {

//adds shortcode with callback
wc_shortcode( 'wc_kc_our_doctors', 'wc_kc_our_doctors_shortcode' );


	function wc_kc_our_doctors_shortcode( $atts ) {
		extract( wc_html_decode( shortcode_atts( array(
			//Parameters of Shortcode
			"wc_ourdoctors_display_type"	 		=> "",
			"wc_ourdoctors_max_posts"					=> "",
			"wc_ourdoctors_display_group" 		=> "",
			"wc_ourstaff_special_appearance"	=> "",
			"_id" 														=> "",
		), $atts )));

		//Setting Taxanomy if selected
		if( esc_attr( $wc_ourdoctors_display_group ) != 'default' ) {
			$display_tax['taxonomy'] = esc_html__( 'optometrist_group', 'eyecare' );
			$display_tax['field'] = 'slug';
			$display_tax['terms'] = esc_attr( $wc_ourdoctors_display_group );
		}

		//Setting posts to Display
		if( is_numeric( $wc_ourdoctors_max_posts ) ) {
			$posts_to_display = esc_attr( $wc_ourdoctors_max_posts );
		} else {
			$posts_to_display = -1;
		}

		//Show Grid or Carousel
		if( $wc_ourdoctors_display_type == 'show_grid' ) {
			$parent_class	= 'grid-doctors our-staff-page row';
			if( $wc_ourstaff_special_appearance == "yes" ) {
				$classes = 'doctor-column large-4 medium-6 small-12 columns special-doctor';
			} else {
				$classes = 'doctor-column medium-6 small-12 columns';
			}
		} else {
			$parent_class	= 'teams-wrapper side-controls';
			$classes = 'doctor-column';
		}

		if( isset( $display_tax ) ) {
			$post_args = array(
				'post_type' 			=> esc_html__( 'optometrist', 'eyecare' ),
				'order' 					=> 'ASC',
				'posts_per_page'	=> $posts_to_display,
				'tax_query' 			=> array( $display_tax ),
			);
		} else {
			$post_args = array(
				'post_type' 			=> esc_html__( 'optometrist', 'eyecare' ),
				'order' 					=> 'ASC',
				'posts_per_page' 	=> $posts_to_display,
			);
		}

		$doctors_query = new WP_Query( $post_args );

		// The Loop
		if( $doctors_query->have_posts() ) {
			$output = '<div id="' . esc_attr( $_id ) . '" class="'.esc_attr( $parent_class ) . '">';
			$counter = 0;
			while( $doctors_query->have_posts() ) {
				$doctors_query->the_post();
				global $post;

				$counter++;

				if( $counter % 2 == 0 ) {
					//Even Posts
					$float_class = "float-left";
					$item_class = "item-two";
				} else {
					//Odd Posts
					$float_class = "float-right";
					$item_class = "item-one";
				}

				if( $wc_ourstaff_special_appearance == "yes" ) {
					$float_class = "";
					$item_class = "";
				}

				$wc_doctor_facebook = get_post_meta( $post->ID, 'wc_doctor_facebook', true );
				$wc_doctor_twitter = get_post_meta( $post->ID, 'wc_doctor_twitter', true );
				$wc_doctor_googleplus = get_post_meta( $post->ID, 'wc_doctor_googleplus', true );
				$wc_doctor_linkedin = get_post_meta( $post->ID, 'wc_doctor_linkedin', true );
				$wc_doctor_slogan = get_post_meta( $post->ID, 'wc_doctor_slogan', true );

				$end_class = '';
				if( $doctors_query->current_post +1 == $doctors_query->post_count ) {
    				// this is the last post
					$end_class = " end";
				}

				$output .= '<div class="'.esc_attr( $classes ) . ' ' . esc_attr( $end_class ) . '">';
				if( $wc_ourstaff_special_appearance == "yes" ) {
					$output .= '<div class="doctor special-staff">';
				} else {
					$output .= '<div class="doctor">';
				}
				$output .= '<div class="doctor-thumb ' . esc_attr( $float_class ) . '">';

				if( has_post_thumbnail() ) {
					$output .= '<a href="' . esc_url( get_the_permalink() ) . '">';
					$output .= get_the_post_thumbnail( $post->ID, 'wc-doctor-thumbnail' );
					$output .= '</a>';
				}
				$output .= '<a href="' . esc_url( get_the_permalink() ) . '" class="button secondary">';
				$output .= esc_html__( "Visit Profile", "eyecare" );
				$output .= '</a></div><!-- Doctor thumb /-->';
				$output .= '<div class="doctor-meta ' . esc_attr( $item_class ) . '">';
				$output .= '<h4>';
				if( !empty( $wc_doctor_slogan ) ) {
					$output .= esc_html( $wc_doctor_slogan );
				} else {
					$output .= "&nbsp;";
				}
				$output .= '</h4>';
				$output .= '<h3><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a></h3>';

				if( $wc_ourstaff_special_appearance != "yes" ) {
				  $output .= '<p>' . esc_html( wc_custom_excerpt_length( 220 ) ) . '</p>';
				}
				$output .= '<div class="doctor-links"><ul class="menu">';

  			if( !empty( $wc_doctor_facebook ) ) {
					$output .= '<li><a href="' . esc_url( $wc_doctor_facebook ) . '"><i class="fa fa-facebook"></i></a></li>';
				}

				if( !empty( $wc_doctor_twitter ) ) {
					$output .= '<li><a href="' . esc_url( $wc_doctor_twitter ) . '"><i class="fa fa-twitter"></i></a></li>';
				}

				if( !empty( $wc_doctor_googleplus ) ) {
					$output .= '<li><a href="' . esc_url( $wc_doctor_googleplus ) . '"><i class="fa fa-google-plus"></i></a></li>';
				}

				if( !empty( $wc_doctor_linkedin ) ) {
					$output .= '<li><a href="' . esc_url( $wc_doctor_linkedin ) . '"><i class="fa fa-linkedin"></i></a></li>';
				}

				$output .= '</ul></div><!-- Doctor links /--></div><!-- Doctor meta /--><div class="clearfix"></div></div><!-- Doctor Ends /--></div><!-- Column Div /-->';
			}
			$output .= '</div><!-- doctors -->';
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}

		//return output for work!
		return $output;
	}//End of short code callback function
} //function exists