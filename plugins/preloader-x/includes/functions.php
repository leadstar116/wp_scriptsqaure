<?php
/**
 * Preloader Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


if ( ! function_exists( 'preloader_wrapper_classes' ) ) {
	/**
	 * Render classes for preloader wrapper
	 *
	 * @param array $classes
	 */
	function preloader_wrapper_classes( $classes = array() ) {

		if ( ! is_array( $classes ) ) {
			$classes = explode( "~", str_replace( array( ' ', ',', ', ' ), '~', $classes ) );
		}

		$classes[] = 'preloader-x';
		$classes[] = preloader()->get_preloader_id();

		printf( 'class="%s"', esc_attr( implode( " ", apply_filters( 'preloader_filters_wrapper_classes', $classes ) ) ) );
	}
}


if ( ! function_exists( 'preloader' ) ) {
	/**
	 * Return PRELOADER_Functions
	 *
	 * @return PRELOADER_Functions
	 */
	function preloader() {

		global $preloader;

		if ( empty( $preloader ) || ! $preloader ) {
			return new PRELOADER_Functions();
		}

		return $preloader;
	}
}