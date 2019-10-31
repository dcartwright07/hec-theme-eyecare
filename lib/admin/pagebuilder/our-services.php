<?php
	/*
	 * This file includes an Element to Kind Composer for Section Services.
	 */



	if(!function_exists('wc_our_services') && function_exists('wc_required_modules')):
	add_action('init', 'wc_our_services', 99 );

	function wc_our_services() {

		if(function_exists('kc_add_map')) {
			//Getting Services Groups Options to use below.
			$taxonomies = array(esc_html__('services_group', 'eyecare'));
			$args = array('orderby'=>'name','order'=>'ASC','hide_empty'=>true);

			$services_group = get_terms($taxonomies, $args);

			$services_tax['default'] = esc_html__('All Groups', 'eyecare');

			foreach($services_group as $group){
				$group_slug = $group->slug;
				$group_name = $group->name;

				$services_tax[$group_slug] = $group_name;
			}

			//taxanomy Choices Ends.

			kc_add_map(
				array(
					'wc_kc_our_services' => array(
						'name' => esc_html__('Our Services', 'eyecare'),
						'description' => esc_html__('List Our Services from Post Type Services', 'eyecare'),
						'icon' => 'fa-eye',
						'category' => esc_html__('Optometrist', 'eyecare'),
						'params' => array(
							array(
								'name' => 'wc_ourservices_display_type',
								'label' => esc_html__('Type of Display', 'eyecare'),
								'type' => 'radio',
								'options' => array(
												'show_carousel' => esc_html__('Display Carousel', 'eyecare'),
												'show_grid' 	=> esc_html__('Display Grid', 'eyecare')
											),
								'admin_label' => true,
								'description' => esc_html__('You want to Display Carousel or Grid.', 'eyecare')
							),
							array(
								'name' => 'wc_ourservices_display_columns',
								'label' => esc_html__('Number of columns if Grid', 'eyecare'),
								'type' => 'radio',
								'options' => array(
												'columns_two' 		=> esc_html__('Two Columns', 'eyecare'),
												'columns_three' 	=> esc_html__('Three Columns', 'eyecare'),
												'columns_four' 		=> esc_html__('Four Columns', 'eyecare')
											),
								'admin_label' => true,
								'description' => esc_html__('Number of Columns Per Row.', 'eyecare')
							),
							array(
								'name' => 'wc_ourservices_display_group',
								'label' => esc_html__('Group Of Services', 'eyecare'),
								'type' => 'select',
								'options' => $services_tax,
								'admin_label' => true,
								'description' => esc_html__('Select Group of Services to Fetch Data from.', 'eyecare')
							),
							array(
								'name' => 'wc_ourservices_max_posts',
								'label' => esc_html__('Maximum Services', 'eyecare'),
								'type' => 'text',
								'admin_label' => true,
								'description' => esc_html__('Maximum services you want to display. Leave Blank to Fetch all.', 'eyecare')
							),
							array(
								'name' => 'wc_ourservices_show_excerpt',
								'label' => esc_html__('Show Expert', 'eyecare'),
								'type' => 'radio',
								'options' => array(
												'yes' => esc_html__('Yes', 'eyecare'),
												'no' => esc_html__('No', 'eyecare')
											),
								'admin_label' => true,
								'description' => esc_html__('Short Description of Service.', 'eyecare')
							)
						)// Param ends
					),  // End element

				)
			); // End add map

		} // End if
	}
	endif; //Function exist/not


	/*
	 * Generating Short Code
	 *
	 * This will help to Generate Shortcode for The Element we created above.
	 *
	 * Requires Composer plugin activated
	 */

	if(!function_exists('wc_kc_our_services_shortcode') && function_exists('wc_shortcode')):

	//adds shortcode with callback
	wc_shortcode('wc_kc_our_services', 'wc_kc_our_services_shortcode');


	function wc_kc_our_services_shortcode($atts){
		extract(wc_html_decode(shortcode_atts(array(
			//Parameters of Shortcode
			"wc_ourservices_display_type" 		=> "",
			"wc_ourservices_max_posts"			=> "",
			"wc_ourservices_show_excerpt" 		=> "",
			"wc_ourservices_display_group" 		=> "",
			"wc_ourservices_display_columns"	=> "",
			"_id" 								=> "",
		), $atts)));

		//Setting Taxanomy if selected
		$display_tax = ''; //Empty array
		if( esc_attr( $wc_ourservices_display_group ) != 'default' ) {
			// $display_tax['taxonomy'] = esc_html__('services_group', 'eyecare');
			// $display_tax['field'] = 'slug';
			// $display_tax['terms'] = esc_attr($wc_ourservices_display_group);

			$display_tax = array(
				'taxonomy' 	=> esc_html__( 'services_group', 'eyecare' ),
				'field'			=> 'slug',
				'terms'			=> esc_attr( $wc_ourservices_display_group )
			);
			echo 'Yes!';
		}

		//Number of Columns to Display
		if(!empty($wc_ourservices_display_columns) 				||
			$wc_ourservices_display_columns == "columns_two" 	||
			$wc_ourservices_display_columns == "columns_three"	||
			$wc_ourservices_display_columns == "columns_four") {
			$columns_number = $wc_ourservices_display_columns;
		} else {
			$columns_number = "columns_three";
		}

		//Setting posts to Display
		if(is_numeric($wc_ourservices_max_posts)) {
			$posts_to_display = esc_attr($wc_ourservices_max_posts);
		} else {
			$posts_to_display = -1;
		}

		//Show Grid or Carousel
		if($wc_ourservices_display_type == 'show_grid') {
			if($columns_number == "columns_two") {
				$classes = 'small-12 medium-6 columns service';
			} elseif($columns_number == "columns_three") {
				$classes = 'small-12 large-4 medium-6 columns service';
			} elseif($columns_number == "columns_four") {
				$classes = 'small-12 large-3 medium-6 columns service';
			} else {
				$classes = 'small-12 large-4 medium-6 columns service';
			}

			$parent_class = 'services row';
		} else {
			$classes = 'service';
			$parent_class = 'services-blocks services-carousel dots-style';
		}

		$post_args = array(
						'post_type' => esc_html__('service', 'eyecare'),
						'order' => 'DESC',
						'posts_per_page' => $posts_to_display,
						'tax_query' => array($display_tax),
					);

		$services_query = new WP_Query($post_args);

		// The Loop
		if ($services_query->have_posts() ) {
			$output = '<div id="'.esc_attr($_id).'" class="'.esc_attr($parent_class).'">';
			while ($services_query->have_posts() ) {
				$services_query->the_post();
				global $post;

				$end_class = '';
				if($services_query->current_post +1 == $services_query->post_count) {
    				// this is the last post
					$end_class = " end";
				}


				$output .= '<div class="'.esc_attr($classes).esc_attr($end_class).'">';
				$output .= '<div class="serivce-block">';

				if(has_post_thumbnail()) {
				$output .= '<div class="service-thumb">';
				$output .= '<a href="'.esc_url(get_the_permalink()).'">';
				$output .= get_the_post_thumbnail($services_query->ID, 'wc-service-small-thumb');
				$output .= '</a></div>';
				}

				$output .= '<div class="service-info">';
				$output .= '<h4><a href="'.esc_url(get_the_permalink()).'">'.esc_html(get_the_title()).'</a></h4>';
				if($wc_ourservices_show_excerpt == 'yes') {
				$output .= '<p>'.esc_html(wc_custom_excerpt_length('140')).'</p>';
				$output .= '<a href="'.esc_url(get_the_permalink()).'" class="service-read">'.esc_html__('Read More', 'eyecare').'&raquo;</a>';
				}
				$output .= '</div>';

				$output .= '</div><!-- service block /-->
							</div><!-- service Ends -->';
			}
			$output .= '</div><!-- services -->';
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			// no posts found
		}

		//return output for work!
		return $output;
	}//End of short code callback function
	endif; //function exists
