<?php
	//Getting Header
	get_header();

	$object_id = get_queried_object_id();

	//Getting Single Post Sidebar Position
	$wc_sidebar_position_default = get_theme_mod("wc_blogsection_manage_sidebar");
	$wc_sidebar_position_special = get_post_meta($object_id, "wc_innerpage_sidebar_position", true);

	if($wc_sidebar_position_special == "left_sidebar"  ||
	   $wc_sidebar_position_special == "right_sidebar" ||
	   $wc_sidebar_position_special == "disable_sidebar") {
		$wc_sidebar_position = $wc_sidebar_position_special;
	} else {
		$wc_sidebar_position = $wc_sidebar_position_default;
	}

	$sidebar_position_class = "right_sidebar";
	if($wc_sidebar_position == "left_sidebar") {
		$sidebar_position_class = "left_sidebar";
	} else if($wc_sidebar_position == "disable_sidebar") {
		$sidebar_position_class = "disable_sidebar";
	}
?>

    <!-- Content section -->
    <div class="content-area module blog-page <?php esc_attr_e($sidebar_position_class); ?>">
        <div class="row">
        	<?php
				//Getting posts sides
				get_template_part('template-parts/post-type/blog');
				if($wc_sidebar_position != "disable_sidebar"){
					//Right Sidebar
					get_sidebar();
				}
			?>
        </div><!-- Row Ends /-->
    </div>
    <!-- Content Section Ends /-->

<?php
	//Getting Footer
	get_footer();