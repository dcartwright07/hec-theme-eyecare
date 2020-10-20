<?php
/**
 *
 * EyeCare - child theme functions and definitions
 * You can Define your Functions in this file if using Child Theme.
 */

// Actions for functions
add_action( 'wp_enqueue_scripts', 'hec_child_scripts', 99 ); //High Priority Action
add_action( 'wc_after_body_start', 'hec_facebook_javascript_sdk' );
add_filter( 'woocommerce_is_purchasable', '__return_false'); // Hide WooCommerce Cart Icon

function hec_child_scripts() {

	wp_enqueue_style( 'wc-parent-style', get_template_directory_uri(). '/style.css', array(), WC_VER, 'all' );

}

// Add Facebook Javascript SDK right after the opening of the body tag for Facebook feed.
function hec_facebook_javascript_sdk() {

	?>

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>

	<?php

}