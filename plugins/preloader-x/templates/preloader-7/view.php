<?php
/**
 * View - Preloader 7
 *
 * @package preloader-7/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color = preloader()->get_args_option( 'primary_color' );
$bg_color      = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner"></div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-7 .preloader-general-inner {
                color: <?php echo esc_attr( $primary_color ); ?>;
            }
            .preloader-x, .preloader-7 .preloader-general-inner:before, .preloader-7 .preloader-general-inner:after {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>