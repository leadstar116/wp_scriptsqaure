<?php
/**
 * View - Preloader 14
 *
 * @package preloader-14/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="line line1"></div>
        <div class="line line2"></div>
        <div class="line line3"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-14 .preloader-general-inner .line {
                background: linear-gradient(to bottom, <?php echo esc_attr( $primary_color ); ?>, <?php echo esc_attr( $secondary_color ); ?>);
            }
        </style>
	<?php endif; ?>
</div>