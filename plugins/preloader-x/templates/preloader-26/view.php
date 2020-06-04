<?php
/**
 * View - Preloader 26
 *
 * @package preloader-26/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="square first"></div>
        <div class="square second"></div>
        <div class="square third"></div>
        <div class="square fourth"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-26 .preloader-general-inner .square {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>