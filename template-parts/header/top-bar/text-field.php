<?php
	//Top Text Field File
	
	$wc_text_field = get_theme_mod('wc_tb_sel_textfield');
	
	if(empty($wc_text_field)) { 
		$wc_text_field = esc_html__('We are Serving the Entire Texas Area So reach us today!', 'eyecare'); //Default Text As placeholder
	}
?>
<p><?php echo wp_kses_post($wc_text_field); ?></p>