<?php
	$default_value = esc_html__('2017 &copy;', 'eyecare').' <a href="'.esc_url('http://www.webfulcreations.com/').'">Webful Creations Vision</a>'.esc_html__(' All Rights Reserved.', 'eyecare');
?>
<div class="copyrightinfo"><?php echo wp_kses_post(get_theme_mod('wc_footer_bottom_copyright', $default_value)); ?></div>