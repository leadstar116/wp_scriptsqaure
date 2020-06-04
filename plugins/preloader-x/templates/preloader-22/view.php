<?php
/**
 * View - Preloader 22
 *
 * @package preloader-22/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div></div>
        <div></div>
        <div></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-22 .preloader-general-inner > div {
                background-color: <?php echo esc_attr( $primary_color ) ?>;
            }
        </style>
	<?php endif; ?>
</div>