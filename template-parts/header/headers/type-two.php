<!-- Header Starts -->
<div class="header header-new header-type-two">
    <div class="row">

        <div class="large-6 medium-12 small-12 columns">
					<div class="logo">

						<?php if( !has_custom_logo() ) : ?>

							<!-- Print Site Title -->
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>

						<?php else : ?>

							<!-- Print custom logo and site title -->
							<a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<div class="row custom-logo">
									<div class="small-4 columns">
										<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
									</div>
									<div class="small-8 columns">
										<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
										<small><?php bloginfo( 'description' ); ?></small>
									</div>
								</div>
							</a>

						<?php endif; ?>

					</div><!-- logo /-->
        </div><!-- left Ends /-->

        <div class="large-6 medium-12 small-12 columns header-icon-container">
        <?php
			$wc_box_one_icon 	= get_theme_mod("wc_header_type_icon_class_one");
			$wc_box_one_title 	= get_theme_mod("wc_header_type_title_one");
			$wc_box_one_detail 	= get_theme_mod("wc_header_type_detail_one");

			$wc_box_two_icon 	= get_theme_mod("wc_header_type_icon_class_two");
			$wc_box_two_title 	= get_theme_mod("wc_header_type_title_two");
			$wc_box_two_detail 	= get_theme_mod("wc_header_type_detail_two");


			//Setting Default values first box
			if(empty($wc_box_one_icon)) {
				$wc_box_one_icon = "fa-map-marker";
			}

			if(empty($wc_box_one_title)) {
				$wc_box_one_title = esc_html__("Our Location", "eyecare");
			}

			if(empty($wc_box_one_detail)) {
				$wc_box_one_detail = esc_html__("6th Avenue, NeHoland", "eyecare");
			}

			//Second Box Default values
			if(empty($wc_box_two_icon)) {
				$wc_box_two_icon = "fa-phone";
			}

			if(empty($wc_box_two_title)) {
				$wc_box_two_title = esc_html__("Call Us", "eyecare");
			}

			if(empty($wc_box_two_detail)) {
				$wc_box_two_detail = esc_html__("+123-123-1234", "eyecare");
			}
		?>


            <div class="medium-6 small-12 columns large-offset-1">
                <div class="icon-box">
                    <div class="icon-side float-left">
                        <i class="fa <?php echo esc_attr($wc_box_one_icon); ?>" aria-hidden="true"></i>
                    </div><!-- icon side /-->
                    <div class="info-side float-left">
                        <p><?php echo esc_html($wc_box_one_title); ?><br>
                            <strong><?php echo esc_html($wc_box_one_detail); ?></strong>
                        </p>
                    </div><!-- info side /-->
                    <div class="clearfix"></div>
                </div><!-- icon-box /-->
            </div><!-- Column Ends /-->

            <div class="medium-5 small-12 columns">
                <div class="icon-box">
                    <div class="icon-side float-left">
                        <i class="fa <?php echo esc_attr($wc_box_two_icon); ?>" aria-hidden="true"></i>
                    </div><!-- icon side /-->
                    <div class="info-side float-left">
                        <p><?php echo esc_html($wc_box_two_title); ?><br>
                            <strong><?php echo esc_html($wc_box_two_detail); ?></strong>
                        </p>
                    </div><!-- info side /-->
                    <div class="clearfix"></div>
                </div><!-- icon-box /-->
            </div><!-- Column Ends /-->

        </div><!-- Right side /-->
    </div><!-- Row Ends /-->
</div>
<!-- Header Ends /-->


<!-- Navigation Wrapper -->
<div class="navigation">
    <div class="row nav-wrap">
        <!-- navigation Code STarts here.. -->
        <div class="top-bar float-left">
            <div class="top-bar-title">
                <span data-responsive-toggle="responsive-menu" data-hide-for="large">
                    <a data-toggle><span class="menu-icon dark float-left"></span></a>
                </span>
            </div>

            <?php
				if(has_nav_menu('main_navigation')):
					//Calling Main Navigation
					$args = array(
								'theme_location'  => 'main_navigation',
								'container'       => 'nav',
								'container_class' => 'menu-left',
								'container_id'    => 'responsive-menu',
								'menu_id'         => '',
								'echo'            => true,
								'depth'           => 0,
								'items_wrap' 	  => '<ul class="menu vertical large-horizontal" data-responsive-menu="accordion large-dropdown">%3$s</ul>',
								'walker' 		  => new Wc_Walker_Nav_Menu()
							);
					wp_nav_menu($args);
			else :
				echo "<a href='".esc_url( home_url( '/wp-admin/nav-menus.php?action=locations' ) )."'>";
					esc_html_e('Add Menu going Appearance >> Menus', 'eyecare');
				echo "</a>";
			endif;
			?>
        </div><!-- top-bar Ends -->
        <!-- Navigation Code Ends here -->

            <?php
                $header_appointment_btn = get_theme_mod("wc_header_appointment_disable");
                $header_btn_text		= get_theme_mod("wc_header_type_appointment_text");
                $header_shortcode		= get_theme_mod("wc_header_type_form_shortcode");

				if(empty($header_btn_text)) {
					$header_btn_text = esc_html__("Book Appointment", "eyecare");
				}

				if(!empty($header_appointment_btn) || class_exists( 'WooCommerce')):

				$extra_classes = "";

				if(!empty($header_appointment_btn) && class_exists( 'WooCommerce')) {
					$extra_classes = "cartbtn apntbtn";
				} else if(!empty($header_appointment_btn)) {
					$extra_classes = "apntbtn";
				} else if(class_exists( 'WooCommerce')) {
					$extra_classes = "cartbtn";
				}
            ?>
            <div class="float-right button-big <?php echo esc_attr($extra_classes); ?>">
                <?php if(class_exists( 'WooCommerce' )): ?>
					<a class="search-icon-toggle button secondary btncart" data-open="ourShoppingCart">
						<i class="fa fa-shopping-cart"></i>
					</a>
				<?php endif; ?>

               	<?php if(!empty($header_appointment_btn)): ?>
					<a data-open="header_appointment_modal" class="button secondary" aria-controls="header_appointment_modal" aria-haspopup="true" tabindex="0"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?php echo esc_html($header_btn_text); ?></a>
                <?php endif; ?>
           	</div><!-- Big Button Ends -->
		   <?php
				endif;
		   ?>

    </div><!-- right Ends /-->
</div>
<!-- Navigation Wrapper Ends /-->

<?php if(class_exists( 'WooCommerce' )): ?>
<div class="reveal" id="ourShoppingCart" data-reveal>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
	<!-- Hidden Menus -->
	<div class="cart-table">
		<h5><?php esc_html_e("Your Cart Details", "eyecare"); ?></h5>
		<?php
			the_widget('WC_Widget_Cart');
		?>
		<div class="clearfix"></div>
	</div><!-- Cart Table /-->
</div><!-- Right Side /-->
<?php endif; ?>

<?php
	if(!empty($header_appointment_btn)):
?>
<div class="reveal" id="header_appointment_modal" data-reveal>
	<?php
        if(empty($header_shortcode)) {
            esc_html_e("Go to Appearance >> Customize >> Header to add shortcode for form.", "eyecare");
        } else {
            echo do_shortcode($header_shortcode);
        }
    ?>
</div><!-- Modal Ends /-->
<?php endif; ?>
