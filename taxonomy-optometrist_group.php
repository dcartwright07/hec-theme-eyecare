<?php
	//Getting Header
	get_header();
?>
    	
    <!-- Content section -->
    <div class="our-team module">
        <div class="row our-staff-page">
        	<?php
				get_template_part('template-parts/post-type/group-optometrist');
			?>
        </div><!-- Row Ends /-->
    </div>
    <!-- Content Section Ends /-->

<?php
	//Getting Footer
	get_footer();