<?php
/**
 * View - Preloader 20
 *
 * @package preloader-20/view.php
 * @copyright Pluginbazar 2020
 */

$unique_id       = uniqid( 'gradient-' );
$primary_color   = preloader()->get_args_option( 'primary_color' );
$secondary_color = preloader()->get_args_option( 'secondary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g>
                <path d="M 50,100 A 1,1 0 0 1 50,0"/>
            </g>
            <g>
                <path d="M 50,75 A 1,1 0 0 0 50,-25"/>
            </g>
            <defs>
                <linearGradient id="<?php echo esc_attr( $unique_id ); ?>" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:<?php echo esc_attr( !empty( $primary_color ) ? $primary_color : '#0023ff' ); ?>;stop-opacity:1"/>
                    <stop offset="100%" style="stop-color:<?php echo esc_attr( !empty( $secondary_color ) ? $secondary_color : '#00a90c' ); ?>;stop-opacity:1"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</div>

<style>
    .preloader-20 svg path {
        stroke: url(#<?php echo esc_attr( $unique_id ); ?>);
    }

    <?php if ( ! empty( $bg_color ) ): ?>
    .preloader-x {
        background-color: <?php echo esc_attr( $bg_color ); ?>;
    }

    <?php endif; ?>
</style>