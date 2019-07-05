<!-- Header Starts -->
        <div class="header">
        	<div class="row">
            	
                <div class="large-4 medium-12 small-12 columns">
                	<div class="logo">
                    	<?php if(!has_custom_logo()) { ?> 
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php } else { 
                            //Load custom logo
                            //If set 
                            the_custom_logo();
                        } ?>    
                    </div><!-- logo /-->
                </div><!-- left Ends /-->
                
                <div class="large-8 medium-12 small-12 columns nav-wrap nav-dark">
                	<!-- navigation Code STarts here.. -->
                    <div class="top-bar">
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
											'container_class' => '',
											'container_id'    => 'responsive-menu',
											'menu_id'         => '',
											'echo'            => true,
											'depth'           => 0,
											'items_wrap' 	  => '<ul class="menu vertical large-horizontal float-right" data-responsive-menu="accordion large-dropdown">%3$s</ul>',
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
                    <div class="search-wrap special-buttons float-right">
                    	<?php if(class_exists( 'WooCommerce' )): ?>
							<a class="search-icon-toggle btncart" data-open="ourShoppingCart">
								<i class="fa fa-shopping-cart"></i>
							</a>
						<?php endif; ?>
                    	
	                    <a href="#" class="search-icon-toggle" data-toggle="search-dropdown"><i class="fa fa-search"></i></a>
    				</div><!-- search wrap ends -->
                    <div class="dropdown-pane" id="search-dropdown" data-dropdown data-auto-focus="true">
                      	<?php echo get_search_form(); ?>
                    </div>
                </div><!-- right Ends /-->
                
            </div><!-- Row Ends /-->
        </div>
        <!-- Header Ends /-->
        

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