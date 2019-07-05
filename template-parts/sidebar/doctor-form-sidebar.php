<?php
	/**
	 * Appointment Form
	 * Single Doctor Page
	 *
	 * @Since 1.0.0
	 */
	 
	$object_id = get_queried_object_id();

	$wc_default_appointment_status = get_theme_mod("wc_disable_appointment");
	$wc_special_appointment_status = get_post_meta($object_id, "wc_appointment_disable", true);


	if(!empty($wc_special_appointment_status)) { 
		if($wc_special_appointment_status == 'on') { 
			$wc_form_status = 'enable';
		} else { 
			$wc_form_status = 'disable';
		}
	} else {
		if(empty($wc_default_appointment_status)) { 
			$wc_form_status = 'enable';
		} else { 
			$wc_form_status = 'disable';
		}
	}
	
	if($wc_form_status == "enable"):
	
	$wc_special_shortcode = get_post_meta($object_id, "wc_appointment_shortcode", true);
	$wc_default_shortcode = get_theme_mod("wc_appointment_shortocde");
?>	

<div class="medium-3 small-12 columns sidebar">
   <div class="inner-column">
        <div class="widget-content">	
			<!-- Form Place /-->
            <?php
				if(!empty($wc_special_shortcode)) { 
					echo do_shortcode($wc_special_shortcode);
				} elseif(!empty($wc_default_shortcode)) { 
					echo do_shortcode($wc_default_shortcode);
				} else { 
					esc_html_e("Create a Form in Contact Form 7, and place shortcode in Customizer for default behaviour. And in Doctor post for special form for this doctor.", "eyecare");
				}
			?>
        </div><!-- Widget Content Ends /-->
   </div>

</div><!-- Side Bar Ends /-->
                
<?php
	endif; //Check if Form active or InacTive
?>	                