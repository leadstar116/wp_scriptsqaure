<?php
/**
 * View - Preloader 11
 *
 * @package preloader-11/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="face">
            <div class="circle"></div>
        </div>
        <div class="face">
            <div class="circle"></div>
        </div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-11 .preloader-general-inner .face:nth-child(2) {
                color: <?php echo esc_attr( $secondary_color ); ?>;
            }
            .preloader-11 .preloader-general-inner .face:nth-child(1) {
                color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>