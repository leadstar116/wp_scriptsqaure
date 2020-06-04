<?php
/**
 * View - Preloader 10
 *
 * @package preloader-10/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color = preloader()->get_args_option( 'primary_color' );
$bg_color      = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner"></div>
	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-10 .preloader-general-inner {
                box-shadow: inset -2px -2px 0 10px<?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>