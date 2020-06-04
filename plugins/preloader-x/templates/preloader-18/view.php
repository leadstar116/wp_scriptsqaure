<?php
/**
 * View - Preloader 18
 *
 * @package preloader-18/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="circle-shape circle-shape-1"></div>
        <div class="circle-shape circle-shape-2"></div>
        <div class="circle-shape circle-shape-3"></div>
        <div class="circle-shape circle-shape-4"></div>
        <div class="circle-shape circle-shape-5"></div>
        <div class="circle-shape circle-shape-6"></div>
        <div class="circle-shape circle-shape-7"></div>
        <div class="circle-shape circle-shape-8"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-18 .preloader-general-inner .circle-shape {
                background-color: <?php echo esc_attr( $primary_color ) ?>;
            }
        </style>
	<?php endif; ?>
</div>