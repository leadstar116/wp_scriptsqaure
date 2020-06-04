<?php
/**
 * View - Preloader 35
 *
 * @package preloader-35/view.php
 * @copyright Pluginbazar 2020
 */

$bg_color        = preloader()->get_args_option( 'bg_color' );
$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class='superman-body'>
            <span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </span>
            <div class='base'>
                <span></span>
                <div class='face'></div>
            </div>
        </div>
        <div class='longfazers'>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-35 .base span:before, .preloader-35 .superman-body > span, .preloader-35 .superman-body > span > span:nth-child(1), .preloader-35 .superman-body > span > span:nth-child(2), .preloader-35 .superman-body > span > span:nth-child(3), .preloader-35 .superman-body > span > span:nth-child(4) {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
            .preloader-35 .base span:after {
                border-right-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
            .preloader-35 .longfazers span {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                opacity: 0.2;
            }
            .preloader-35 .face, .preloader-35 .face:after {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-35 .base span {
                border-right-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>