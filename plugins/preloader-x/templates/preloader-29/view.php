<?php
/**
 * View - Preloader 29
 *
 * @package preloader-29/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner"></div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-29 .preloader-general-inner, .preloader-29 .preloader-general-inner:after {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>