<?php
	/**
	 * Sidebar Template
	 */
?>

<div class="medium-3 small-12 columns sidebar">
                
    <?php
		//Shop Sidebar if single page
		$wc_sidebar = esc_html__('services-sidebar', 'eyecare');	
	
		if(is_active_sidebar($wc_sidebar)) { 
			dynamic_sidebar($wc_sidebar);
		}
	?>
    
</div><!-- right bar ends here /-->