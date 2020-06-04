<?php
/**
 * View - Preloader 33
 *
 * @package preloader-33/view.php
 * @copyright Pluginbazar 2020
 */

$bg_color        = preloader()->get_args_option( 'bg_color' );
$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="area">
            <div class="sides">
                <div class="pan"></div>
                <div class="handle"></div>
            </div>
            <div class="pancake">
                <div class="pastry"></div>
            </div>
        </div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-33 .preloader-general-inner .area .sides .handle {
                border-top-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-33 .preloader-general-inner .area .sides .pan {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-33 .preloader-general-inner .area .pancake .pastry {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                box-shadow: 0 0 3px 0 <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-33 .preloader-general-inner .bubble {
                background-color: <?php echo esc_attr( $secondary_color ); ?> !important;
                box-shadow: 0 0 0.25vh <?php echo esc_attr( $secondary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>