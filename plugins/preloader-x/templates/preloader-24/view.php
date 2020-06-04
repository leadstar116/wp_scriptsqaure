<?php
/**
 * View - Preloader 24
 *
 * @package preloader-22/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner"></div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-24 {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
                background-image: linear-gradient(68.6deg, <?php echo esc_attr( $primary_color ); ?> 38.1%, <?php echo esc_attr( $secondary_color ); ?> 93.1%);
            }
        </style>
	<?php endif; ?>
</div>