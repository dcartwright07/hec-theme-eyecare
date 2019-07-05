<?php
	//Footer Navigation
	
	if(has_nav_menu('footer_navigation')):
		wp_nav_menu( array(
			'theme_location' 	=> 'footer_navigation',
			'container_class' 	=> 'menu-centered',
		));
	else :
		echo "<a href='".esc_url( home_url( '/wp-admin/nav-menus.php?action=locations' ) )."'>";
			esc_html_e('Add Menu going Appearance >> Menus', 'eyecare');
		echo "</a>";
	endif;