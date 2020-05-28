<?php
$template_loader = new Listeo_Core_Template_Loader;

$drug = get_option('scriptsquare_drug');
$listing_type = '';
$is_featured = false;
?>
<!-- Listing Item -->

	<div class="col-lg-12 col-md-12">
		<div class="listing-item-container listing-geo-data list-layout">
			<a href="" class="listing-item">
				<div class="listing-small-badges-container">
		            <?php if($is_featured){ ?>
		                <div class="listing-small-badge featured-badge"><i class="fa fa-star"></i> <?php esc_html_e('Featured','listeo_core'); ?></div><br>
		            <?php } ?>
		        </div>

				<!-- Image -->
				<div class="listing-item-image">
					<?php
					$image_url = get_listeo_core_placeholder_image()
					?>
					<img src="<?php echo esc_attr($image_url); ?>" alt="">
				</div>

				<!-- Content -->
				<div class="listing-item-content">
					<div class="listing-item-inner">
						<h3>
							<?php echo $drug['Pharmacy']['Pharmacy']; ?>
							<?php //the_title(); ?>
							<?php //if( get_post_meta($post->ID,'_verified',true ) == 'on') : ?>
								<!--<i class="verified-icon"></i>-->
							<?//php endif; ?>
						</h3>
						<span style="display: block;line-height: 2em;">
							<?php //the_listing_location_link($post->ID, false); ?>
							<?php echo round($drug['Pharmacy']['Distance'], 2) . " mi. away"//the_listing_location_link($post->ID, false); ?>
						</span>
						<span style="display: block;font-size: small;line-height: 1.5em;text-transform: capitalize;"><?php echo $drug['Pharmacy']['Address1'] . "<br>" . $drug['Pharmacy']['City'] . ", " . $drug['Pharmacy']['State'] . " " . $drug['Pharmacy']['Zip'] ?></span>

						<span style="display: block;line-height: 2em;">
							<?php //the_listing_location_link($post->ID, false); ?>
							<?php $thephone =  format_phone('us',$drug['Pharmacy']['Phone'], 2)?>
							<?php echo $thephone  ?>
						</span>

						<?php
						/*
						if(!get_option('listeo_disable_reviews')){
							$rating = get_post_meta($post->ID, 'listeo-avg-rating', true);
							if(isset($rating) && $rating > 0 ) :
								$rating_type = get_option('listeo_rating_type','star');
								if($rating_type == 'numerical') { ?>
									<div class="numerical-rating" data-rating="<?php $rating_value = esc_attr(round($rating,1)); printf("%0.1f",$rating_value); ?>">
								<?php } else { ?>
									<div class="star-rating" data-rating="<?php echo $rating; ?>">
								<?php } ?>
									<?php $number = listeo_get_reviews_number($post->ID);  ?>
									<div class="rating-counter">(<?php printf( _n( '%s review', '%s reviews', $number,'listeo_core' ), number_format_i18n( $number ) );  ?>)</div>
								</div>
						<?php
						endif;
						}
						*/?>
					</div>
						<div class="button" style="display: inline-block;position: absolute;float: right;bottom: 50%;right: 35px;transform: translateY(50%);">

							<button class="button tooltip left" title="<?php esc_html_e('Login To Bookmark Items','listeo_core'); ?>">Get Coupon</button>

						</div>


				</div>
			</a>
			<!--</a> -->
		</div>
	</div>
<!-- Listing Item / End -->