<?php
/**
 * View - Preloader 25
 *
 * @package preloader-25/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__ball"></div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-25 .preloader-general-inner .loader__bar {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-25 .preloader-general-inner .loader__ball {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>