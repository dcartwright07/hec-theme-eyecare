<?php
	/**
	 * Sidebar For Single Doctor
	 * Sidebar Page
	 */ 
	$object_id = get_queried_object_id();
	
	$post_thumbnail 				= get_the_post_thumbnail($object_id, 'wc-doctor-thumbnail', array('class' => 'thumbnail'));

	$wc_doctor_speciality 			= get_post_meta($object_id, 'wc_doctor_speciality', true);
	$wc_doctor_availability_field1 	= get_post_meta($object_id, 'wc_doctor_availability_field1', true);
	$wc_doctor_availability_field2 	= get_post_meta($object_id, 'wc_doctor_availability_field2', true);
	$wc_doctor_facebook 			= get_post_meta($object_id, 'wc_doctor_facebook', true);
	$wc_doctor_twitter 				= get_post_meta($object_id, 'wc_doctor_twitter', true);
	$wc_doctor_googleplus 			= get_post_meta($object_id, 'wc_doctor_googleplus', true);
	$wc_doctor_linkedin 			= get_post_meta($object_id, 'wc_doctor_linkedin', true);
?>
<div class="medium-3 small-12 columns single-doctor sidebar special-sidebar">
    
   <?php
   		if(!empty($post_thumbnail)) { 
			echo wp_kses_post($post_thumbnail);
		}
   ?>
   <div class="widget">
   <?php if(!empty($wc_doctor_speciality)): ?>
        <h2><?php esc_html_e('Speciality', 'eyecare'); ?></h2>
        <div class="widget-content">
            <?php echo wp_kses_post($wc_doctor_speciality); ?>
        </div>
	<?php endif; //Speciality ?>
		
	<?php if(!empty($wc_doctor_availability_field1) || !empty($wc_doctor_availability_field2)): ?>
        <h2><?php esc_html_e('Availability', 'eyecare'); ?></h2>
		<div class="widget-content">
        <p>
           <?php 
                if(!empty($wc_doctor_availability_field1)) {
                    echo wp_kses_post($wc_doctor_availability_field1);   
                } 
                if(!empty($wc_doctor_availability_field2)) {
                    echo '<br>'.wp_kses_post($wc_doctor_availability_field2);   
                }
            ?>
        </p>
            	
		<?php if(!empty($wc_doctor_facebook) || !empty($wc_doctor_twitter) || !empty($wc_doctor_googleplus)): ?>
        <div class="socialicons">
            <strong><?php esc_html_e('Social', 'eyecare'); ?>:</strong> 
            <?php if(!empty($wc_doctor_facebook)) {
                echo '<a href="'.esc_url($wc_doctor_facebook).'"><i class="fa fa-facebook"></i></a>';		
            } if(!empty($wc_doctor_twitter)) {
                echo '<a href="'.esc_url($wc_doctor_twitter).'"><i class="fa fa-twitter"></i></a>';
            } if(!empty($wc_doctor_googleplus)) {
                echo '<a href="'.esc_url($wc_doctor_googleplus).'"><i class="fa fa-google-plus"></i></a>';
            } if(!empty($wc_doctor_linkedin)) { 
				echo '<a href="'.esc_url($wc_doctor_linkedin).'"><i class="fa fa-linkedin"></i></a>';
			} ?>
        </div>
        <?php endif; //social icons presence ?>
        </div><!-- Widget Content /-->
    <?php endif; ?>
</div><!-- Widget Ends /-->
</div><!-- Thumbnail /-->