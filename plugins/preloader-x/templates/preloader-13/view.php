<?php
/**
 * View - Preloader 13
 *
 * @package preloader-13/view.php
 * @copyright Pluginbazar 2020
 */

$primary_color   = preloader()->get_args_option( 'primary_color' );
$bg_color        = preloader()->get_args_option( 'bg_color' );

?>

<div <?php preloader_wrapper_classes(); ?>>
    <div class="preloader-general-inner">
        <svg class="loader-star" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
            <polygon points="29.8 0.3 22.8 21.8 0 21.8 18.5 35.2 11.5 56.7 29.8 43.4 48.2 56.7 41.2 35.1 59.6 21.8 36.8 21.8 " fill="<?php echo esc_attr( !empty( $primary_color ) ? $primary_color : '#FF9800' ); ?>" />
        </svg>
        <div class="loader-circles"></div>
    </div>

	<?php if ( ! empty( $primary_color ) || ! empty( $bg_color ) ): ?>
        <style>
            .preloader-x {
                background-color: <?php echo esc_attr( $bg_color ); ?>;
            }
            .preloader-13 .preloader-general-inner .loader-circles {
                background-color: <?php echo esc_attr( $primary_color ); ?>;
            }

            @-webkit-keyframes loader-2-circles {
                0% {
                    box-shadow: 0 0 0 <?php echo esc_attr( $primary_color ); ?>;
                    opacity: 1;
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                50% {
                    box-shadow: 24px -22px <?php echo esc_attr( $primary_color ); ?>, 30px -15px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 31px 0 <?php echo esc_attr( $primary_color ); ?>, 29px 9px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 24px 23px <?php echo esc_attr( $primary_color ); ?>, 17px 30px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 0 33px <?php echo esc_attr( $primary_color ); ?>, -10px 28px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -24px 22px <?php echo esc_attr( $primary_color ); ?>, -29px 14px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -31px -3px <?php echo esc_attr( $primary_color ); ?>, -30px -11px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -20px -25px <?php echo esc_attr( $primary_color ); ?>, -12px -30px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 5px -29px <?php echo esc_attr( $primary_color ); ?>, 13px -25px 0 -3px <?php echo esc_attr( $primary_color ); ?>;
                    -webkit-transform: rotate(180deg);
                    transform: rotate(180deg);
                }
                100% {
                    opacity: 0;
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                    box-shadow: 25px -22px <?php echo esc_attr( $primary_color ); ?>, 15px -22px 0 -3px black, 31px 2px <?php echo esc_attr( $primary_color ); ?>, 21px 2px 0 -3px black, 23px 25px <?php echo esc_attr( $primary_color ); ?>, 13px 25px 0 -3px black, 0 33px <?php echo esc_attr( $primary_color ); ?>, -10px 33px 0 -3px black, -26px 24px <?php echo esc_attr( $primary_color ); ?>, -19px 17px 0 -3px black, -32px 0 <?php echo esc_attr( $primary_color ); ?>, -23px 0 0 -3px black, -25px -23px <?php echo esc_attr( $primary_color ); ?>, -16px -23px 0 -3px black, 0 -31px <?php echo esc_attr( $primary_color ); ?>, -2px -23px 0 -3px black;
                }
            }

            @keyframes loader-2-circles {
                0% {
                    box-shadow: 0 0 0 <?php echo esc_attr( $primary_color ); ?>;
                    opacity: 1;
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                50% {
                    box-shadow: 24px -22px <?php echo esc_attr( $primary_color ); ?>, 30px -15px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 31px 0 <?php echo esc_attr( $primary_color ); ?>, 29px 9px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 24px 23px <?php echo esc_attr( $primary_color ); ?>, 17px 30px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 0 33px <?php echo esc_attr( $primary_color ); ?>, -10px 28px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -24px 22px <?php echo esc_attr( $primary_color ); ?>, -29px 14px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -31px -3px <?php echo esc_attr( $primary_color ); ?>, -30px -11px 0 -3px <?php echo esc_attr( $primary_color ); ?>, -20px -25px <?php echo esc_attr( $primary_color ); ?>, -12px -30px 0 -3px <?php echo esc_attr( $primary_color ); ?>, 5px -29px <?php echo esc_attr( $primary_color ); ?>, 13px -25px 0 -3px <?php echo esc_attr( $primary_color ); ?>;
                    -webkit-transform: rotate(180deg);
                    transform: rotate(180deg);
                }
                100% {
                    opacity: 0;
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                    box-shadow: 25px -22px <?php echo esc_attr( $primary_color ); ?>, 15px -22px 0 -3px black, 31px 2px <?php echo esc_attr( $primary_color ); ?>, 21px 2px 0 -3px black, 23px 25px <?php echo esc_attr( $primary_color ); ?>, 13px 25px 0 -3px black, 0 33px <?php echo esc_attr( $primary_color ); ?>, -10px 33px 0 -3px black, -26px 24px <?php echo esc_attr( $primary_color ); ?>, -19px 17px 0 -3px black, -32px 0 <?php echo esc_attr( $primary_color ); ?>, -23px 0 0 -3px black, -25px -23px <?php echo esc_attr( $primary_color ); ?>, -16px -23px 0 -3px black, 0 -31px <?php echo esc_attr( $primary_color ); ?>, -2px -23px 0 -3px black;
                }
            }
        </style>
	<?php endif; ?>
</div>