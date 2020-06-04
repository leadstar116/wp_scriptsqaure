<?php
/**
 * View - Preloader 3
 *
 * @package preloader-3/view.php
 * @copyright Pluginbazar 2020
 */

global $this_preloader;

$primary_color = preloader()->get_args_option( 'primary_color' );
$bg_color      = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="rotating-plane"></div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-3 .rotating-plane {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>