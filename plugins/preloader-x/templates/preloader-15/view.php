<?php
/**
 * View - Preloader 15
 *
 * @package preloader-15/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="square-shape square1"></div>
        <div class="square-shape square2"></div>
        <div class="square-shape square3"></div>
        <div class="square-shape square4"></div>
        <div class="square-shape square5"></div>
        <div class="square-shape square6"></div>
        <div class="square-shape square7"></div>
        <div class="square-shape square8"></div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-15 .preloader-general-inner {
                border-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-15 .preloader-general-inner:before, .preloader-15 .preloader-general-inner:after {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>