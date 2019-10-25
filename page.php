<?php
	//Getting Header
	get_header();
?>

    <!-- Content section -->
    <div class="content-area module page">
        <div class="row">
        	<?php
				$object_id = get_queried_object_id();

				//Getting Single Post Sidebar Position
				$wc_sidebar_position_default = get_theme_mod("wc_default_page_sidebar");
				$wc_sidebar_position_special = get_post_meta($object_id, "wc_innerpage_sidebar_position", true);

				if($wc_sidebar_position_special == "left_sidebar"  ||
				   $wc_sidebar_position_special == "right_sidebar" ||
				   $wc_sidebar_position_special == "disable_sidebar") {
					$wc_sidebar_position = $wc_sidebar_position_special;
				} else {
					$wc_sidebar_position = $wc_sidebar_position_default;
				}

				switch($wc_sidebar_position) {
					case "left_sidebar":
						//left sidebar
						get_sidebar();
						//Getting posts sides
						get_template_part('template-parts/post-type/default-page');
					break;

					case "right_sidebar":
						//Getting posts sides
						get_template_part('template-parts/post-type/default-page');
						//Right Sidebar
						get_sidebar();
					break;

					case "disable_sidebar":
						//Getting posts sides
						get_template_part('template-parts/post-type/default-page');
					break;

					default:
						//Getting posts sides
						get_template_part('template-parts/post-type/default-page');
						//Right Sidebar
						get_sidebar();
				}//Ends Switch
			?>
        </div><!-- Row Ends /-->
    </div>
    <!-- Content Section Ends /-->

<?php
	//Getting Footer
	get_footer();