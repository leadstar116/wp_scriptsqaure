<?php
/**
 * View - Preloader 12
 *
 * @package preloader-12/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-12 .preloader-general-inner .loader-inner {
                border-color: <?php echo esc_attr( $secondary_color ); ?>;
                border-top-color: transparent;
            }
            .preloader-12 .preloader-general-inner .loader-outter {
                border-color: <?php echo esc_attr( $primary_color ); ?>;
                border-left-color: transparent;
            }
        </style>
	<?php endif; ?>
</div>