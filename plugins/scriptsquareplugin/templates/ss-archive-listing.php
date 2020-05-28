<?php
/**
 * The template for displaying listings
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package listeo
 */
$top_layout = get_option('pp_listings_top_layout','map');
($top_layout == 'half') ? get_header('split') : get_header();

$template_loader = new Listeo_Core_Template_Loader;
$ss_template_loader = new ScriptSquare_Template_Loader;

//function for phone number
function format_phone($country, $phone) {
	$function = 'format_phone_' . $country;
	if(function_exists($function)) {
		return $function($phone);
	}
	return $phone;
}

function format_phone_us($phone) {
	// note: making sure we have something
	if(!isset($phone{3})) { return ''; }
	// note: strip out everything but numbers
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	switch($length) {
		case 7:
			return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			break;
		case 10:
			return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
			break;
		case 11:
			return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
			break;
		default:
			return $phone;
			break;
	}
}
// end of function

$content_layout = get_option('pp_listings_layout','list');

if($top_layout == 'half') {
	$ss_template_loader->get_template_part( 'ss-archive-listing-half' );
} else {
	$sidebar_side = get_option('pp_listings_sidebar_layout');
	$drugs = get_option('scriptsquare_drugs_data');
?>

<!-- Content
================================================== -->
<div class="container <?php echo esc_attr($sidebar_side); if( $top_layout == 'map') { echo esc_attr(' margin-top-40'); } ?> ?>" >
	<div class="row sticky-wrapper">


			<?php switch ($sidebar_side) {
				case 'full-width':
					?><div class="col-md-12"><?php
					break;
				case 'left-sidebar':
					?><div class="col-lg-9 col-md-8 listings-column-content mobile-content-container"><?php
					break;
				case 'right-sidebar':
					?><div class="col-lg-9 col-md-8 padding-right-30 listings-column-content mobile-content-container"><?php
					break;

				default:
					?><div class="col-lg-9 col-md-8 padding-right-30 listings-column-content"><?php
					break;
			} ?>
			<!-- Search -->

			<?php
			if( $top_layout == 'search') {
				 echo do_shortcode('[listeo_search_form action='.get_post_type_archive_link( 'listing' ).' source="home" custom_class="gray-style margin-top-40 margin-bottom-40"]');
				} ?>

			<!-- Search Section / End -->

			<?php $top_buttons = get_option('listeo_listings_top_buttons');

			if($top_buttons=='enable'){
				$top_buttons_conf = get_option('listeo_listings_top_buttons_conf');
				if(is_array($top_buttons_conf) && !empty($top_buttons_conf)){
					$list_top_buttons = implode("|", $top_buttons_conf);
				}  else {
					$list_top_buttons = '';
				}
				?>
					<div class="row margin-bottom-15">
					<?php do_action( 'listeo_before_archive', $content_layout, $list_top_buttons ); ?>
				</div>
				<?php
			} ?>
				<?php
					$container_class = 'content-layout';
				 ?>

				<!-- Listings -->
				<div class="listings-container <?php echo esc_attr($container_class) ?>">
					<?php if($content_layout == 'list'): ?>
						<div class="row">
					<?php endif;
					if ( $drugs['success'] ) :
						$count = 0;
						foreach($drugs['content'] as $drug) {
							$count++;
							if($count>20) break;
							update_option('scriptsquare_drug', $drug);
							$template_loader->get_template_part( 'content-listing' );
						}
					else :
						$ss_template_loader->get_template_part( 'archive/ss-no-found' );
					endif; ?>
					<?php if($content_layout == 'list'): ?>
						</div>
					<?php endif; ?>
				</div>
		</div>
		<?php if($sidebar_side != 'full-width') : ?>
			<!-- Sidebar
			================================================== -->
			<div class="col-lg-3 col-md-4 listings-sidebar-content mobile-sidebar-container">
				<?php $template_loader->get_template_part( 'sidebar-listeo' );?>
			</div>
			<!-- Sidebar / End -->
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
<?php } //eof split ?>
