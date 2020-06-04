<?php
/**
 * View - Preloader 5
 *
 * @package preloader-5/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color = preloader()->get_args_option( 'primary_color' );
$bg_color      = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-5 .preloader-general-inner div {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>