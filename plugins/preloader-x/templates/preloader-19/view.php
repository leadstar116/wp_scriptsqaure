<?php
/**
 * View - Preloader 19
 *
 * @package preloader-19/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="shape-heart heart1"></div>
        <div class="shape-heart heart2"></div>
        <div class="shape-heart heart3"></div>
        <div class="shape-heart heart4"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $secondary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-19 .shape-heart:before, .preloader-19 .shape-heart:after {
                background-color: <?php echo esc_attr( $primary_color ) ?>;
                background-image: radial-gradient(circle farthest-corner at 10% 20%, <?php echo esc_attr( $primary_color ) ?> 0%, <?php echo esc_attr( $secondary_color ) ?> 90%);
            }
        </style>
	<?php endif; ?>
</div>