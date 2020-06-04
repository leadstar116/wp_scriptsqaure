<?php
/*
	Plugin Name: Preloader X
	Plugin URI: https://pluginbazar.com/plugins/preloader-x/
	Description: Unlimited preloader for your WordPress website
	Version: 1.0.1
	Author: Pluginbazar
	Text Domain: preloader-x
	Author URI: https://pluginbazar.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

define( 'PRELOADER_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'PRELOADER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PRELOADER_PLUGIN_FILE', plugin_basename( __FILE__ ) );

if ( ! class_exists( 'PreloaderX' ) ) {
	class PreloaderX {

		/**
		 * PreloaderX constructor
		 */
		function __construct() {

			$this->load_scripts();
			$this->define_classes_functions();

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		}


		/**
		 * Loading TextDomain
		 */
		function load_textdomain() {

			load_plugin_textdomain( 'preloader-x', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Loading Functions
		 */
		function define_classes_functions() {

			require_once( PRELOADER_PLUGIN_DIR . 'includes/classes/class-pb-settings.php' );
			require_once( PRELOADER_PLUGIN_DIR . 'includes/classes/class-functions.php' );
			require_once( PRELOADER_PLUGIN_DIR . 'includes/functions.php' );
			require_once( PRELOADER_PLUGIN_DIR . 'includes/classes/class-hook.php' );
			require_once( PRELOADER_PLUGIN_DIR . 'includes/classes/class-page-meta.php' );
		}


		/**
		 * Loading Scripts frontend and backend
		 */
		function load_scripts() {

			add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}


		/**
		 * Front Scripts Loading
		 */
		function front_scripts() {

			wp_enqueue_script( 'preloader-front', plugins_url( 'assets/front/js/scripts.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_style( 'preloader-front', PRELOADER_PLUGIN_URL . 'assets/front/css/style.css' );
		}


		/**
		 * Admin Scripts Loading
		 */
		function admin_scripts() {

			wp_enqueue_script( 'preloader-admin', plugins_url( 'assets/admin/js/scripts.js', __FILE__ ), array(), uniqid() );
			wp_enqueue_style( 'preloader-admin', PRELOADER_PLUGIN_URL . 'assets/admin/css/style.css' );
		}
	}

	new PreloaderX();
}