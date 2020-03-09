<?php 
	$background_options = get_sub_field('background_options');
	$overlay_options = get_sub_field('overlay_options');

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
<section class="acf-flexible-builder-fullwidth-image content_builder_block image_block" id="acf-flexible-builder-fullwidth-image-<?php echo get_row_index(); ?>">

	<?php if (!get_sub_field('full_width')) : ?>
		<div class="max-width-container">
	<?php endif; ?>
		
		<?php if ($type == 'Image') : ?>
			<img src='<?php echo $image_for_desktop; ?>'>
		<?php endif; ?>
		
		<?php if ($type == 'Video') : ?>
			<div class="oembed-container">
				<?php echo $iframe; ?>
			</div>
		<?php endif; ?>
		
		<?php if ($use_parallax) : ?>
			<div class="parallax-container" >
				<div class="parallax">
					<div class="parallax_item" style="background-image: url( <?php echo $image_for_desktop; ?> );">
						</div>
				</div>
			</div>
			
			<style>
				#acf-flexible-builder-fullwidth-image-<?php echo get_row_index(); ?> {
					background-color: transparent;
					background-image: none;
				}
				#acf-flexible-builder-fullwidth-image-<?php echo get_row_index(); ?> img {
					display: none;
				}
			</style>
		<?php endif; ?>

	<?php if (!get_sub_field('full_width')) : ?>
		</div>
	<?php endif; ?>

</section>

<?php

    #fix the error when the variable affected the following blocks
    $use_parallax = false;