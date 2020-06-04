<?php
/**
 * View - Preloader 34
 *
 * @package preloader-34/view.php
 * @copyright Pluginbazar 2020
 */

$bg_color        = preloader()->get_args_option( 'bg_color' );
$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <div class="cssload-jar">
            <div class="cssload-neck"></div>
            <div class="cssload-base">
                <div class="cssload-liquid"> </div>
                <div class="cssload-wave"></div>
                <div class="cssload-wave"></div>
                <div class="cssload-bubble"></div>
                <div class="cssload-bubble"></div>
            </div>
            <div class="cssload-bubble"></div>
            <div class="cssload-bubble"></div>
        </div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x, .preloader-34 .cssload-jar .cssload-neck {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-34 .cssload-jar .cssload-neck, .preloader-34 .cssload-jar .cssload-base {
                border-color: <?php echo esc_attr( $secondary_color ); ?>;
            }
            .preloader-34 .cssload-jar .cssload-wave, .preloader-34 .cssload-jar .cssload-bubble,
            .preloader-34 .cssload-jar .cssload-liquid {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }
        </style>
	<?php endif; ?>
</div>