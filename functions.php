<?php
/**
 *
 * EyeCare - child theme functions and definitions
 * You can Define your Functions in this file if using Child Theme.
 */

function wc_child_scripts() {
    wp_enqueue_style( 'wc-parent-style', get_template_directory_uri(). '/style.css', array(), WC_VER, 'all');
}
//High Priority Action
add_action( 'wp_enqueue_scripts', 'wc_child_scripts', 99);