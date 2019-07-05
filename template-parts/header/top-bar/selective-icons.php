<?php
	//Getting Selected Icons
	$wc_selected_icons = get_theme_mod('wc_tb_sel_icons');
	
	if(empty($wc_selected_icons)) { 
		//setting Default Values
		$wc_selected_icons = 'wc_socialoptions_fb_field,wc_socialoptions_tw_field,wc_socialoptions_in_field,wc_socialoptions_gp_field';
	}
?>

<ul class="menu social">
	<?php
		$icons_array 		= explode(',', $wc_selected_icons);
		$default_phone 		= "123-123-1234"; // Dummy Text as Placeholder
		$default_address 	= "248 Texas , 4353"; // Dummy Text as Placeholder
		$default_email 		= "youremail@site.com"; // Dummy Text as Placeholder
		$default_timings 	= esc_html__("Monday - Friday : 09:00-17:00", "eyecare"); // Dummy Text as Placeholder
		
		foreach($icons_array as $icon) { 
			switch ($icon) {
				case "wc_socialoptions_phone":
					echo '<li><i class="fa fa-phone"></i> '.esc_html(get_theme_mod('wc_socialoptions_phone', $default_phone)).'</li>';
					break;
				case "wc_socialoptions_small_add":
					echo '<li><i class="fa fa-map-marker"></i> '.esc_html(get_theme_mod('wc_socialoptions_small_add', $default_address)).'</li>';
					break;
				case "wc_socialoptions_email":
					echo '<li><i class="fa fa-envelope"></i> '.sanitize_email(get_theme_mod('wc_socialoptions_email', $default_email)).'</li>';
					break;
				case "wc_socialoptions_timings":
					echo '<li><i class="fa fa-clock-o"></i> '.esc_html(get_theme_mod('wc_socialoptions_timings', $default_timings)).'</li>';
					break;
				case "wc_socialoptions_fb_field":
					echo '<li class="first-social social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_fb_field')).'"><i class="fa fa-facebook"></i></a></li>';
					break;
				case "wc_socialoptions_tw_field":
					echo '<li class="social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_tw_field')).'"><i class="fa fa-twitter"></i></a></li>';
					break;
				case "wc_socialoptions_lin_field":
					echo '<li class="social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_lin_field')).'"><i class="fa fa-linkedin"></i></a></li>';
					break;
				case "wc_socialoptions_in_field":
					echo '<li class="social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_in_field')).'"><i class="fa fa-instagram"></i></a></li>';
					break;
				case "wc_socialoptions_gp_field":
					echo '<li class="social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_gp_field')).'"><i class="fa fa-google"></i></a></li>';
					break;
				case "wc_socialoptions_yt_field":
					echo '<li class="social"><a href="'.esc_url(get_theme_mod('wc_socialoptions_yt_field')).'"><i class="fa fa-youtube"></i></a></li>';
					break;
				default:
					//No Default Behaviour
			}//Switch End.

		}//End foreach.
	?>
</ul>