<?php 
add_action( 'wp_enqueue_scripts', 'listeo_enqueue_styles' );
function listeo_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('bootstrap','listeo-icons','listeo-woocommerce') );

}

 
function remove_parent_theme_features() {
   	
}
add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'SS Page Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );


?>