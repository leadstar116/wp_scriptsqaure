<?php
/**
 * Class Functions
 */

class PRELOADER_Functions {


	/**
	 * Return current preloader ID
	 *
	 * @param bool $post_id
	 *
	 * @return mixed|void
	 */
	function get_preloader_id( $post_id = false ) {

		$preloader    = $this->get_preloader( $post_id );
		$preloader_id = $this->get_args_option( 'id', '', $preloader );

		return apply_filters( 'preloader_filters_preloader_id', $preloader_id, $post_id );
	}


	/**
	 * Return active preloader upon global or for a specific post/page
	 *
	 * @param bool $post_id
	 *
	 * @return mixed
	 */
	function get_preloader( $post_id = false ) {

		$preloaders   = $this->get_preloaders();
		$preloader_id = $this->get_meta( 'preloader_active_id', $post_id, $this->get_option( 'preloader_active_id', 'preloader-1' ) );

		return $preloaders[ $preloader_id ];
	}

	/**
	 * Return preloaders array
	 *
	 * @return mixed|void
	 */
	function get_preloaders() {

		$preloaders = array(
			'preloader-1'  => array(
				'id'         => 'preloader-1',
				'label'      => esc_html__( 'Preloader - 1', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'circle,', 'bounce', 'scale' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-2'  => array(
				'id'         => 'preloader-2',
				'label'      => esc_html__( 'Preloader - 2', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-2' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-3'  => array(
				'id'         => 'preloader-3',
				'label'      => esc_html__( 'Preloader - 3', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-3' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-4'  => array(
				'id'         => 'preloader-4',
				'label'      => esc_html__( 'Preloader - 4', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-4' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-5'  => array(
				'id'         => 'preloader-5',
				'label'      => esc_html__( 'Preloader - 5', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-5' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-6'  => array(
				'id'         => 'preloader-6',
				'label'      => esc_html__( 'Preloader - 6', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-6' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-7'  => array(
				'id'         => 'preloader-7',
				'label'      => esc_html__( 'Preloader - 7', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-7' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-8'  => array(
				'id'         => 'preloader-8',
				'label'      => esc_html__( 'Preloader - 8', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-8' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-9'  => array(
				'id'         => 'preloader-9',
				'label'      => esc_html__( 'Preloader - 9', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-9' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-10' => array(
				'id'       => 'preloader-10',
				'label'    => esc_html__( 'Preloader - 10', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-10' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-11' => array(
				'id'       => 'preloader-11',
				'label'    => esc_html__( 'Preloader - 11', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-11' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-12' => array(
				'id'       => 'preloader-12',
				'label'    => esc_html__( 'Preloader - 12', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-12' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-13' => array(
				'id'       => 'preloader-13',
				'label'    => esc_html__( 'Preloader - 13', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-13' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-14' => array(
				'id'       => 'preloader-14',
				'label'    => esc_html__( 'Preloader - 14', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-14' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-15' => array(
				'id'       => 'preloader-15',
				'label'    => esc_html__( 'Preloader - 15', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-15' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-16' => array(
				'id'       => 'preloader-16',
				'label'    => esc_html__( 'Preloader - 16', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-16' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-17' => array(
				'id'       => 'preloader-17',
				'label'    => esc_html__( 'Preloader - 17', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-17' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-18' => array(
				'id'       => 'preloader-18',
				'label'    => esc_html__( 'Preloader - 18', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-18' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-19' => array(
				'id'       => 'preloader-19',
				'label'    => esc_html__( 'Preloader - 19', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'heart', 'preloader-19' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-20' => array(
				'id'       => 'preloader-20',
				'label'    => esc_html__( 'Preloader - 20', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-20' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-21' => array(
				'id'       => 'preloader-21',
				'label'    => esc_html__( 'Preloader - 21', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-21' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-22' => array(
				'id'       => 'preloader-22',
				'label'    => esc_html__( 'Preloader - 22', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-22' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-23' => array(
				'id'       => 'preloader-23',
				'label'    => esc_html__( 'Preloader - 23', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-23' ),
			),
			'preloader-24' => array(
				'id'       => 'preloader-24',
				'label'    => esc_html__( 'Preloader - 24', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-24' ),
				'dependency' => array( 'primary_color', 'secondary_color' ),
			),
			'preloader-25' => array(
				'id'       => 'preloader-25',
				'label'    => esc_html__( 'Preloader - 25', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-25' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-26' => array(
				'id'       => 'preloader-26',
				'label'    => esc_html__( 'Preloader - 26', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-26' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-27' => array(
				'id'       => 'preloader-27',
				'label'    => esc_html__( 'Preloader - 27', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-27' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-28' => array(
				'id'       => 'preloader-28',
				'label'    => esc_html__( 'Preloader - 28', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-28' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-29' => array(
				'id'       => 'preloader-29',
				'label'    => esc_html__( 'Preloader - 29', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-29' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-30' => array(
				'id'       => 'preloader-30',
				'label'    => esc_html__( 'Preloader - 30', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-30' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
			'preloader-31' => array(
				'id'       => 'preloader-31',
				'label'    => esc_html__( 'Preloader - 31', 'preloader-x' ),
				'category' => 'vehicle',
				'keywords' => array( 'cars', 'vehicle' ),
				'dependency' => array( 'bg_color' ),
			),
			'preloader-32' => array(
				'id'       => 'preloader-32',
				'label'    => esc_html__( 'Preloader - 32', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-32' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-33' => array(
				'id'       => 'preloader-33',
				'label'    => esc_html__( 'Preloader - 33', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-33' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-34' => array(
				'id'       => 'preloader-34',
				'label'    => esc_html__( 'Preloader - 34', 'preloader-x' ),
				'category' => 'general',
				'keywords' => array( 'keyword 1', 'preloader-34' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-35' => array(
				'id'         => 'preloader-35',
				'label'      => esc_html__( 'Preloader - 35', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'keyword 1', 'preloader-35' ),
				'dependency' => array( 'bg_color', 'primary_color', 'secondary_color' ),
			),
			'preloader-36' => array(
				'id'         => 'preloader-36',
				'label'      => esc_html__( 'Preloader - 36', 'preloader-x' ),
				'category'   => 'general',
				'keywords'   => array( 'circle', 'spinner', 'preloader-36' ),
				'dependency' => array( 'bg_color', 'primary_color' ),
			),
		);

		return apply_filters( 'preloader_filters_preloaders', $preloaders );
	}

	/**
	 * Return Post Meta Value
	 *
	 * @param bool $meta_key
	 * @param bool $post_id
	 * @param string $default
	 *
	 * @return mixed|string|void
	 */
	function get_meta( $meta_key = false, $post_id = false, $default = '' ) {

		if ( ! $meta_key ) {
			return '';
		}

		$post_id    = ! $post_id ? get_the_ID() : $post_id;
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		$meta_value = empty( $meta_value ) ? $default : $meta_value;

		return apply_filters( 'preloader_filters_get_meta', $meta_value, $meta_key, $post_id, $default );
	}

	/**
	 * Return option value
	 *
	 * @param string $option_key
	 * @param string $default_val
	 *
	 * @return mixed|string|void
	 */
	function get_option( $option_key = '', $default_val = '' ) {

		if ( empty( $option_key ) ) {
			return '';
		}

		$option_val = get_option( $option_key, $default_val );
		$option_val = empty( $option_val ) ? $default_val : $option_val;

		return apply_filters( 'preloader_filters_option_' . $option_key, $option_val );
	}

	/**
	 * Return Arguments Value
	 *
	 * @param string $key
	 * @param string $default
	 * @param array $args
	 *
	 * @return mixed|string
	 */
	function get_args_option( $key = '', $default = '', $args = array() ) {

		global $this_preloader;

		$args    = empty( $args ) ? $this_preloader : $args;
		$default = empty( $default ) ? '' : $default;
		$key     = empty( $key ) ? '' : $key;

		if ( isset( $args[ $key ] ) && ! empty( $args[ $key ] ) ) {
			return $args[ $key ];
		}

		return $default;
	}

	/**
	 * Return preloader selection options
	 *
	 * @return mixed|void
	 */
	function get_preloader_selection_options() {

		$preloader_args = array();
		foreach ( $this->get_preloaders() as $preloader_id => $preloader ) {

			$dependency = $this->get_args_option( 'dependency', array(), $preloader );
			$item_src   = sprintf( '%sassets/admin/images/%s.gif', PRELOADER_PLUGIN_URL, $preloader_id );

			$preloader_args[ $preloader_id ]['src'] = $item_src;

			if ( ! empty( $dependency ) ) {
				$preloader_args[ $preloader_id ]['dependency'] = $dependency;
			}
		}

		$selection_options = array(
			array(
				'id'      => 'preloader_active_id',
				'title'   => esc_html__( 'Select Preloader', 'preloader-x' ),
				'details' => esc_html__( 'Select a preloader that will apply in Frontend', 'preloader-x' ),
				'type'    => 'image_select',
				'args'    => $preloader_args,
			),
			array(
				'id'      => 'bg_color',
				'title'   => esc_html__( 'Page Background', 'preloader-x' ),
				'details' => esc_html__( 'Select page background color', 'preloader-x' ),
				'type'    => 'colorpicker',
			),
			array(
				'id'      => 'primary_color',
				'title'   => esc_html__( 'Primary Color', 'preloader-x' ),
				'details' => esc_html__( 'Select a preloader primary color', 'preloader-x' ),
				'type'    => 'colorpicker',
			),
			array(
				'id'      => 'secondary_color',
				'title'   => esc_html__( 'Secondary Color', 'preloader-x' ),
				'details' => esc_html__( 'Select a preloader secondary color', 'preloader-x' ),
				'type'    => 'colorpicker',
			),
		);

		return apply_filters( 'preloader_filters_preloader_selection_options', $selection_options );
	}

	/**
	 * Return preloader categories
	 *
	 * @return mixed|void
	 */
	function get_preloader_categories() {

		$categories = array(
			'general'    => esc_html__( 'General', 'preloader-x' ),
			'restaurant' => esc_html__( 'Restaurant', 'preloader-x' ),
			'event'      => esc_html__( 'Event', 'preloader-x' ),
		);

		return apply_filters( 'preloader_filters_categories', $categories );
	}

	/**
	 * Return PB_Settings class
	 *
	 * @param array $args
	 *
	 * @return PB_Settings
	 */
	function PB( $args = array() ) {

		return new PB_Settings( $args );
	}
}