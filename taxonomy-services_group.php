<?php
	//Getting Header
	get_header();
?>
    	
    <!-- Content section -->
    <div class="content-area services module">
        <div class="row">
        	<?php
				get_template_part('template-parts/post-type/group-services');
			?>
        </div><!-- Row Ends /-->
    </div>
    <!-- Content Section Ends /-->

<?php
	//Getting Footer
	get_footer();