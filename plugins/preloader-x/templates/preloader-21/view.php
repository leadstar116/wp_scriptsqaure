<?php
/**
 * View - Preloader 21
 *
 * @package preloader-21/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x, .preloader-21 .preloader-general-inner > div:first-of-type:before {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-21 .preloader-general-inner > div:first-of-type, .preloader-21 .preloader-general-inner > div:nth-child(2) {
                border-color: <?php echo esc_attr( $primary_color ); ?>;
                border-right-color: transparent;
            }
            
            .preloader-21 .preloader-general-inner > div:nth-child(3), .preloader-21 .preloader-general-inner > div:nth-child(4), .preloader-21 .preloader-general-inner > div:nth-child(5), .preloader-21 .preloader-general-inner > div:nth-child(6) {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>