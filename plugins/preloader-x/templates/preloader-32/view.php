<?php
/**
 * View - Preloader 32
 *
 * @package preloader-32/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );
?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="loading-window">
            <div class="car">
                <div class="strike"></div>
                <div class="strike strike2"></div>
                <div class="strike strike3"></div>
                <div class="strike strike4"></div>
                <div class="strike strike5"></div>
                <div class="car-detail spoiler"></div>
                <div class="car-detail back"></div>
                <div class="car-detail center"></div>
                <div class="car-detail center1"></div>
                <div class="car-detail front"></div>
                <div class="car-detail wheel"></div>
                <div class="car-detail wheel wheel2"></div>
            </div>
        </div>
    </div>
	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-32 .car-detail.wheel {
                border-color: <?php echo esc_attr( $bg_color ); ?>;
            }

            .preloader-32 .car-detail:not(.center):not(.wheel):not(.spoiler) {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }

            .preloader-32 .car-detail.center {
                border-color: <?php echo esc_attr( $primary_color ); ?>;
            }

            .preloader-32 .car-detail.spoiler {
                border-left-color: <?php echo esc_attr( $primary_color ); ?>;
            }

            .preloader-32 .car-detail.wheel {
                background: linear-gradient(45deg, transparent 45%, <?php echo esc_attr( $primary_color ); ?> 46%, <?php echo esc_attr( $primary_color ); ?> 54%, transparent 55%), linear-gradient(-45deg, transparent 45%, <?php echo esc_attr( $primary_color ); ?> 46%, <?php echo esc_attr( $primary_color ); ?> 54%, transparent 55%), linear-gradient(90deg, transparent 45%, <?php echo esc_attr( $primary_color ); ?> 46%, <?php echo esc_attr( $primary_color ); ?> 54%, transparent 55%), linear-gradient(0deg, transparent 45%, <?php echo esc_attr( $primary_color ); ?> 46%, <?php echo esc_attr( $primary_color ); ?> 54%, transparent 55%), radial-gradient(<?php echo esc_attr( $primary_color ); ?> 29%, transparent 30%, transparent 50%, <?php echo esc_attr( $primary_color ); ?> 51%), #fff;
            }

            .preloader-32 .car .strike {
                background-color: <?php echo esc_attr( $secondary_color ); ?>;;
            }
        </style>
	<?php endif; ?>
</div>