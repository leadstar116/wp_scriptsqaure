<?php
/**
 * View - Preloader 1
 *
 * @package preloader-1/view.php
 * @copyright Pluginbazar 2020
 */


$primary_color = preloader()->get_args_option( 'primary_color' );
$bg_color      = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-1 .double-bounce1, .preloader-1 .double-bounce2 {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>