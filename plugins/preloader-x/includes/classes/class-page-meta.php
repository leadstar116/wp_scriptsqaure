<?php
/*
* @Author 		Pluginbazar
* Copyright: 	2015 Pluginbazar
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

class PRELOADER_Page_meta {

	function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_data' ) );
	}


	/**
	 * Save meta box
	 *
	 * @param $post_id
	 */
	function save_meta_data( $post_id ) {

		$nonce = isset( $_POST['preloader_nonce_val'] ) ? $_POST['preloader_nonce_val'] : '';

		if ( wp_verify_nonce( $nonce, 'preloader_nonce' ) ) {
			foreach ( preloader()->get_preloader_selection_options() as $option ) {

				$option_id    = preloader()->get_args_option( 'id', '', $option );
				$option_value = preloader()->get_args_option( $option_id, '', wp_unslash( $_POST ) );

				update_post_meta( $post_id, $option_id, $option_value );
			}
		}
	}


	/**
	 * Display Preloader Selection Box
	 *
	 * @param WP_Post $post
	 */
	function display_preloader_box( \WP_Post $post ) {

		wp_nonce_field( 'preloader_nonce', 'preloader_nonce_val' );

		printf( '<h3>%s</h3>', esc_html__( 'Select a preloader that will apply for this page only.', 'preloader-x' ) );

		preloader()->PB()->generate_fields( array( array( 'options' => preloader()->get_preloader_selection_options() ) ), $post->ID );
	}


	/**
	 * Add meta box
	 *
	 * @param $post_type
	 */
	function add_meta_boxes( $post_type ) {

		if ( in_array( $post_type, array( 'page' ) ) ) {

			add_meta_box( 'preloader_box', esc_html__( 'Preloader selection box', 'preloader-x' ), array(
				$this,
				'display_preloader_box'
			), $post_type, 'normal', 'high' );
		}
	}
}

new PRELOADER_Page_meta();