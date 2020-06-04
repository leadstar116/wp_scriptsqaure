<?php
/*
* @Author 		Pluginbazar
* Copyright: 	2015 Pluginbazar
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

class PRELOADER_Hooks {

	/**
	 * PRELOADER_Hooks constructor.
	 */
	function __construct() {

		$this->generate_settings_page();

		add_action( 'wp_footer', array( $this, 'load_preloader' ) );
		add_action( 'pb_settings_after_page_preloader-general', array( $this, 'add_backend_loader' ) );
		add_filter( 'upload_mimes', array( $this, 'add_mimes' ) );

	}

	/**
	 * Generate settings page
	 */
	function generate_settings_page() {

		$pages['preloader-general'] = array(
			'page_nav'      => esc_html__( 'General', 'preloader-x' ),
			'page_settings' => array(
				array(
					'title'   => esc_html__( 'General Settings', 'preloader-x' ),
					'options' => preloader()->get_preloader_selection_options(),
				),
			),
		);

		$pages['preloader-custom'] = array(
			'page_nav'      => esc_html__( 'Custom Preloader', 'preloader-x' ),
			'page_settings' => array(
				array(
					'title'   => esc_html__( 'Custom Preloader Settings', 'preloader-x' ),
					'options' => array(
						array(
							'id'    => 'custom_preloader_img',
							'title' => esc_html__( 'Preloader Image', 'preloader-x' ),
							'type'  => 'media',
						),
                        array(
							'id'    => 'enable_custom_preloader',
							'title' => esc_html__( 'Enable Custom Preloader', 'preloader-x' ),
							'type'  => 'checkbox',
							'args'  => array(
								'yes' => esc_html__( 'Enable / Disable', 'preloader-x' ),
							),
						),
						array(
							'id'    => 'enable_svg_upload',
							'title' => esc_html__( 'Enable SVG Upload', 'preloader-x' ),
							'type'  => 'checkbox',
							'args'  => array(
								'yes' => esc_html__( 'Enable / Disable', 'preloader-x' ),
							),
						),
						array(
							'id'      => 'custom_bg_color',
							'title'   => esc_html__( 'Page Background', 'preloader-x' ),
							'details' => esc_html__( 'Select page background color', 'preloader-x' ),
							'type'    => 'colorpicker',
						),
					)
				),
			),
		);

		preloader()->PB( array(
			'add_in_menu'     => true,
			'menu_type'       => 'menu',
			'menu_title'      => esc_html__( 'Preloader', 'preloader-x' ),
			'menu_name'       => esc_html__( 'Preloader Settings', 'preloader-x' ),
			'menu_page_title' => esc_html__( 'Preloader - Control Panel', 'preloader-x' ),
			'capability'      => "manage_options",
			'menu_slug'       => "preloader-settings",
			'pages'           => $pages,
			'menu_icon'       => PRELOADER_PLUGIN_URL . 'assets/images/preloader.svg',
			'position'        => 65,
		) );
	}

	/**
	 * Add svg Support
	 *
	 * @param $mimes
	 *
	 * @return mixed
	 */
	function add_mimes( $mimes ) {

		if ( in_array( 'yes', preloader()->get_option( 'enable_svg_upload', array() ) ) ) {

			define('ALLOW_UNFILTERED_UPLOADS', true);

			$mimes['svg'] = 'image/svg+xml';
		}

		return $mimes;
	}

	/**
	 * Add Preloader Output
	 */
	function add_backend_loader() {

		?>

        <div class="preloader-x preloader-13">
            <div class="preloader-general-inner">
                <svg class="loader-star" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     version="1.1">
                    <polygon
                            points="29.8 0.3 22.8 21.8 0 21.8 18.5 35.2 11.5 56.7 29.8 43.4 48.2 56.7 41.2 35.1 59.6 21.8 36.8 21.8 "
                            fill="#FF9800"></polygon>
                </svg>
                <div class="loader-circles"></div>
            </div>
        </div>

		<?php
	}

	/**
	 * Render preloader markup in footer
	 */
	function load_preloader() {

		/**
		 * Check custom preloader and return execution
		 */
		if ( in_array( 'yes', preloader()->get_option( 'enable_custom_preloader', array() ) ) ) {
			include sprintf( '%stemplates/custom/view.php', PRELOADER_PLUGIN_DIR );

			return;
		}

		global $this_preloader;

		$post_id         = is_page() ? get_the_ID() : false;
		$this_preloader  = preloader()->get_preloader( $post_id );
		$bg_color        = preloader()->get_option( 'bg_color' );
		$primary_color   = preloader()->get_option( 'primary_color' );
		$secondary_color = preloader()->get_option( 'secondary_color' );

		if ( $post_id ) {
			$this_preloader['bg_color']        = preloader()->get_meta( 'bg_color', $post_id, $bg_color );
			$this_preloader['primary_color']   = preloader()->get_meta( 'primary_color', $post_id, $primary_color );
			$this_preloader['secondary_color'] = preloader()->get_meta( 'secondary_color', $post_id, $secondary_color );
		} else {
			$this_preloader['bg_color']        = $bg_color;
			$this_preloader['primary_color']   = $primary_color;
			$this_preloader['secondary_color'] = $secondary_color;
		}

		include sprintf( '%stemplates/%s/view.php', PRELOADER_PLUGIN_DIR, preloader()->get_preloader_id( $post_id ) );
	}
}

new PRELOADER_Hooks();