<?php
/**
 * View - Custom Preloader
 *
 * @package custom/view.php
 * @copyright Pluginbazar 2020
 */


$custom_bg_color = preloader()->get_option( 'custom_bg_color' );

$image_url = wp_get_attachment_image_src( preloader()->get_option( 'custom_preloader_img' ), 'full' );

?>

<div class="preloader-x preloader-custom">
    <div class="preloader-general-inner">
        <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php esc_attr_e( 'Custom Preloader', 'preloader-x' ); ?>">
    </div>
	<?php if ( ! empty( $custom_bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $custom_bg_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>