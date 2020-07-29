<?php
$template_loader = new Listeo_Core_Template_Loader;

$drug = get_option('scriptsquare_drug');
$listing_type = '';
$is_featured = false;
?>
<!-- Listing Item -->

	<div class="col-lg-12 col-md-12">
		<div class="listing-item-container listing-geo-data list-layout">
			<?php
			//continue;
			?>
			<div class="listing-item">
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
					<!--<img src="<?php echo esc_attr($image_url); ?>" alt=""> -->
					<img src="/wp-content/uploads/2020/07/scriptsquare_placeholder.png" alt="">
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
							<a style="color: #777;" href="tel:+1-<?php echo $drug['Pharmacy']['Phone'] ?>"><?php echo $thephone  ?></a>
						</span>

						<?php
						setlocale(LC_MONETARY, 'en_US.UTF-8');
						
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
					
					
					<div>
						<ul class="flex-container">
							<li class="flex-item brand">
								<div class="" style="">
									<span id="drug-info"><?php echo $drug['Drug']['full_name'] ?></span><br>
									<span id="drug-info"><strong>Brand Price:</strong> <?php echo money_format('%.2n', $drug['b_price']); ?></span><br>
									<span id="drug-info"><strong>Quantity:</strong> 30</span>
									
								</div>
							</li>
							
							<li class="flex-item price">
								<div class="" style="">
									<span style="color: #274060;font-size: 40px;margin: 10px;"><?php echo money_format('%.2n', $drug['g_price']); ?></span><br>
									<span style="font-size: small;color: #274060;">save with coupon!</span>
								</div>
							</li>
							<li class="flex-item button">
								<div class="" style="">
									<a href="https://script.seacabo.com/wp-content/uploads/2020/05/ScriptSquare_Member_Discount_Card_V4.pdf">
										<button class="button tooltip left" title="<?php esc_html_e('Save Now!','listeo_core'); ?>">Get Coupon</button>
									</a>
								</div>
							</li>
						</ul>
					</div>
					
					
					
					
					<div class="listing-flex" style="display: flex;">
						<div class="row">
						
						</div>
						<div class="row">
						
						</div>
						<div class="row">
						
						</div>
						
					</div>
					<div class="button" style="">
					
					

					</div>


				</div>
			</div>
			<!--</a> -->
		</div>
	</div>
<!-- Listing Item / End -->