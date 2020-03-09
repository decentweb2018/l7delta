<?php 
	$full_width = (get_sub_field('is_full_width')) ? 'full_width' : '';
	$heading = get_sub_field('heading');
	$subheading = get_sub_field('subheading');
	$intro_content = get_sub_field('intro_content');
	$col_num = get_sub_field('col_num');
	$grid = get_sub_field('grid');
?>
<section class="acf-flexible-builder-grid content_builder_block grid_block col_count_<?php echo $col_num; ?> <?php echo $full_width; ?>" id="acf-flexible-builder-grid-<?php echo get_row_index(); ?>">

	<!-- Intro content -->
	<?php if( $intro_content ): ?>
		<div class="max-width-container">
			<div class="reading-well intro_content">
			
				<?php if ($heading) : ?>
					<h2 class="section_heading"><?php echo $heading; ?></h2>
				<?php endif; ?>
				
				<?php if ($subheading) : ?>
					<p class="section_subheading"><?php echo $subheading; ?></p>
				<?php endif; ?>
				
				<?php echo $intro_content; ?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php if ($full_width === 'max-width') : ?>
		<div class="max-width-container">
	<?php elseif( $full_width === 'reading-well' ) : ?>
        <div class="max-width-container reading-well">
	<?php endif; ?>
			
			<?php
				foreach ($grid as $block) :
					$span_count = $block['span'];
					$block_heading = $block['heading'];
					$block_subheading = $block['subheading'];
					$block_content = $block['grid_content'];
			
					$background_options = $block['background_options'];
					$overlay_options = $block['overlay_options'];

					#background options
					if ($background_options['onoff']) {
						$color = $background_options['color'];
						$type = $background_options['type'];

						if ($type == 'Image') {
							$image_for_desktop = $background_options['image_for_desktop'];
							$image_for_laptop = $background_options['image_for_laptop'];
							$image_for_mobile = $background_options['image_for_mobile'];
							$use_parallax = $background_options['use_parallax'];
						}

						if ($type == 'Video') {
							$video = $background_options['video'];
							$mute = $background_options['mute'] ?? 0;
							$controls = $background_options['controls'] ?? 0;
							$autoplay = $background_options['autoplay'] ?? 0;

							#Get options for video
							$iframe = $video ?? '';

							#Get video SRC
							preg_match('/src="(.+?)"/', $iframe, $matches);
							$src = $matches[1];

							#Check video provider
							$video_youtube = "/youtube/iU";
							$video_vimeo = "/vimeo/iU";

							if ( preg_match($video_youtube, $src) ) {

								if($mute == 1) {
									$result_volume = 'player.mute()';
								}
								else {
									$result_volume = 'player.unMute()';
								}

								$id_video = rand(1,12345678);

								#Get result
								$iframe = "<iframe 
											src='$src
											&autoplay=$autoplay
											&controls=$controls
											&iv_load_policy=3
											&loop=1
											&rel=0
											&showinfo=0
											&enablejsapi=1'
											width='640' 
											height='360' 
											frameborder='0' 
											title='L7 Website Branding Ad 1' 
											webkitallowfullscreen 
											mozallowfullscreen 
											allowfullscreen 
											id='video-$id_video'></iframe>

											<script>
											//Play BG video
											var tag = document.createElement('script');

											tag.src = 'https://www.youtube.com/iframe_api';
											var firstScriptTag = document.getElementsByTagName('script')[0];
											firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

											function onYouTubeIframeAPIReady() {

												$('.full-video-helper iframe').each(function(){
													var thisID = 'video-$id_video';
													var player = new YT.Player(thisID, {
														events: {
															'onReady': function(){
																player.playVideo();
																$result_volume;
															},
															'onStateChange':
																function(e){
																	if (e.data === YT.PlayerState.ENDED) {
																		player.playVideo();
																	}
																}
														}
													});
												});
											}
											</script>
										";		
							} 

							if ( preg_match($video_vimeo, $src) ) {
								if ($mute == 1) {
									$result_volume = 0;
								}
								else {
									$result_volume = 100;
								}

								if ($controls == 1) {
									$result_controls = 0;
								}
								else {
									$result_controls = 1;
								}

								$id_video = rand(1,12345678);

								#Get result
								$iframe = "<iframe 
											src='$src
											&autoplay=$autoplay
											&background=$result_controls'
											width='640' 
											height='360' 
											frameborder='0' 
											title='L7 Website Branding Ad 1' 
											webkitallowfullscreen 
											mozallowfullscreen 
											allowfullscreen 
											id='video-$id_video'></iframe>
											<script src='https://player.vimeo.com/api/player.js'></script> 
											<script>
												var player = new Vimeo.Player(document.getElementById('video-$id_video'));
												player.on('play', function() {
													player.setVolume($result_volume)
												});
											</script>
										";
							}
						}
					}

					#overlay options
					if ($overlay_options['onoff']) {
						$overlay_color = $overlay_options['overlay_color'];
						$overlay_opacity = $overlay_options['overlay_opacity'];

						if ($overlay_opacity == 100) {
							$opacity = 1;
						}
						else {
							$opacity = '0.' . $overlay_opacity;
						}
					}
				?>
				
				<div class="grid_item <?php //echo "span-{$span_count}"; ?>" id="grid_item_<?php echo $span_count; ?>">
					<div>
						<?php
							if( !empty( $block_heading ) ):
								echo "<h1 class='section_heading'>{$block_heading}</h1>";
							endif;
							if( !empty( $block_subheading ) ):
								echo "<h2 class='section_subheading'>{$block_subheading}</h2>";
							endif;
							if( !empty( $block_content ) ):
								?>
								<div class="grid-content-builder"><?php
								foreach ( $block_content as $content_item ):
									switch ($content_item['acf_fc_layout']){
										case 'image':
											?> <img src="<?php echo $content_item['image']['sizes']['large'] ?>" alt=""> <?php
											break;
										case 'wysiwyg':
											echo apply_filters( 'the_content', $content_item['text'] );
											break;
										case 'map':
											$location = $content_item['map'];

											if( !empty($location) ):
												?>
												<!--<div class="acf-map">
													 <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
												</div>-->
												<div class="acf-map-iframe">
													<iframe width="900" height="570" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $location['address']; ?>&hl=es;z=14&amp;output=embed"></iframe>
												</div>
											<?php endif;
											break;
										case 'link':
											$link = $content_item['link'][0];
											$target = ( $link['new_window'] ? '_blank' : '_self' );
											?>
											<a href="<?php echo $link['url']; ?>" class="cta over-effect <?php echo $link['css_class'] ?>" target="<?php echo $target; ?>" style="color: <?php echo $contrast_color; ?>; border-color: <?php echo $contrast_color; ?>">
												<span class="over-effect-label"><?php echo $link['label'] ?></span><span class="icon icon-fast-forward"></span>
											</a>
											<?php
											break;
									}
								endforeach;
								?></div><?php
							else:
								echo "<div class='empty-grid-spacer'></div>";
							endif;
						?>
						</div>
						
						<!-- Background Options -->
						<?php if ($background_options['onoff']) : ?>

						<style>
							#grid_item_<?php echo $span_count; ?> {
								background-color: <?php echo $color; ?>;
								background-repeat: no-repeat;
								background-size: cover;
							}

							<?php if ($type=='Image') : ?>
								#grid_item_<?php echo $span_count; ?> {
									background-image: url(<?php echo $image_for_desktop; ?>);
								}

								<?php if ($image_for_laptop) : ?>
									@media (max-width: 992px) {
										#grid_item_<?php echo $span_count; ?> {
											background-image: url(<?php echo $image_for_laptop; ?>);
										}
									}
								<?php endif; ?>

								<?php if ($image_for_mobile) : ?>
									@media (max-width: 768px) {
										#grid_item_<?php echo $span_count; ?> {
											background-image: url(<?php echo $image_for_mobile; ?>);
										}
									}
								<?php endif; ?>
							<?php endif; ?>
						</style>

						<?php endif; ?>

						<!-- Parallax -->
						<?php if ($use_parallax) : ?>
							<div class="parallax-container as-bg">
								<div class="parallax">
									<div class="parallax_item" style="background-image: url(<?php echo $image_for_desktop; ?>); display: block; background-position: center top 0.57px;">
									 </div>
								</div>
							</div>

							<style>
							#grid_item_<?php echo $span_count; ?> {
								background-color: transparent;
								background-image: none;
							}
							</style>
						<?php endif; ?>

						<!-- Overlay -->
						<?php if ($overlay_options['onoff']) : ?>
							<div class="bg-overlay" style="background-color: <?php echo $overlay_color; ?>; opacity: <?php echo $opacity; ?>"></div>
						<?php endif; ?>

						<!-- Video BG -->
						<?php if ($type == 'Video') : ?>
							<div class="full-video-helper">
								<div class="embed-container">
									<?php echo $iframe; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

			<?php
				endforeach;
			?>
			
	<?php if ($full_width === 'max-width') : ?>
		</div>
	<?php elseif( $full_width === 'reading-well' ) : ?>
        </div>
	<?php endif; ?>
	
</section>

<?php

    #fix the error when the variable affected the following blocks
    $use_parallax = false;