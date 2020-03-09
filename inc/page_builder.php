<?php

class l7_pb {

	public static function animate_data_attr( $options ) {
		$attr = array();
		$attr[] = 'data-wow-duration="' . $options['animate_duration'] . 's"';
		$attr[] = 'data-wow-delay="' . $options['animate_delay'] . 's"';
		$attr[] = 'data-wow-offset="' . $options['animate_offset'] . '"';
	}

	public static function animate_classes( $options ) {
		$classes = array('wow');
		$classes[] = $options['animate_type'];

		echo implode( ' ', $classes);
	}

	public static function component_class( $component ) {
		$classes = array();
		$classes[] = 'content_builder_block';
		$classes[] = $component['layout_type'];

		switch ($component['layout_type']){
//			case 'text_block':
//				$bg_type = strtolower( $component['bg_toggle'] );
//
//				$classes[] = 'bg_' . $bg_type;
//				break;
			case 'grid_block':
				$classes[] = 'col_count_' . $component['col_num'];

				if ( isset( $component['is_full_width'] ) && $component['is_full_width'] === 'true' ){
					$classes[] = 'full_width';
				}
				break;
		}

		echo implode( ' ', $classes);
	}

	public static function background_video( $bg_options ) {
		 if( $bg_options['bg_toggle'] === 'Video' ): ?>
			<div class="full-video-helper">
				<div class="embed-container">
					<?php l7_pb::autoplay_oembed($bg_options); ?>
				</div>
			</div>
		<?php endif;
	}

	public static function overlay_bg( $bg_options ) {
		if( $bg_options['bg_toggle'] !== 'None' && !empty( $bg_options['overlay_color'] ) ){
		    $opacity = $bg_options['overlay_opacity'] / 100;

			$hex = $bg_options['overlay_color'];
			list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
			$rgb = "$r,$g,$b";

		    $style = '';
		    if( $bg_options['overlay_type'] === 'gradient' ){
		        $style = "background: -moz-linear-gradient(top, rgba({$rgb},0) 30%, rgba({$rgb},.7) 70%, rgba({$rgb},.8) 100%);";
                $style .= " background: -webkit-linear-gradient(top, rgba({$rgb},0) 30%, rgba({$rgb},.7) 70%,rgba({$rgb},.8) 100%);";
                $style .= " background: linear-gradient(to bottom, rgba({$rgb},0) 30%, rgba({$rgb},.7) 70%,rgba({$rgb},.8) 100%);";
                $style .= " filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$bg_options['overlay_color']}0', endColorstr='{$bg_options['overlay_color']}',GradientType=0 );";
                $style .= " opacity: {$opacity};";
            }else{
		        $style = "background-color: {$bg_options['overlay_color']}; opacity: {$opacity}";
            }
		    ?>
		    <div class="bg-overlay" style="<?php echo $style; ?>">
            </div>
        <?php }
	}

	public static function parallax_bg( $bg_options ) {
		 if( $bg_options['bg_toggle'] === 'Parallax' ):
			 $image = $bg_options['bg_image']
			 ?>
			 <div class="parallax-container as-bg" style="padding-bottom: <?php echo ($image['sizes']['large-height'] / $image['sizes']['large-width'] * 80)  ?>%;">
				 <div class="parallax">
					 <div class="parallax_item" style="background-image: url( <?php echo $image['url']; ?> );">
					 </div>
				 </div>
			 </div>
		<?php endif;
	}

	public static function secondary_color( $text ) {
	    return str_replace( array('{{','}}'), array('<span class="secondary-color">','</span>'),$text );
	}

	public static function contrast_color( $bg_options ) {

		if ( !empty( $bg_options['bg_color'] ) ){
			return ( ( hexdec( $bg_options['bg_color'] ) > 0x999999 ) ? '#878787' : '#ffffff' );
		}

		return '#878787';
	}

	public static function background_style( $bg_options, $no_color = false ){
		$style_string = '';

		if ( !empty( $bg_options['bg_color'] ) ){
			$style_string .= 'background-color: ' . $bg_options['bg_color'] .';';

			if( $no_color ){

				$contrast_color = l7_pb::contrast_color( $bg_options );

				$style_string .= 'color: ' . $contrast_color . ';';
			}
		}

		if ( $bg_options['bg_toggle'] === 'Image' && !empty( $bg_options['bg_image'] ) ){
			$style_string .= 'background-image: url( ' . $bg_options['bg_image']['sizes']['large'] .' );';
		}

		echo $style_string;
	}

	public static function autoplay_oembed( $options ){

		//Get options for video
		$iframe = ($options['bg_video']) ? $options['bg_video'] : '';

			//Get video SRC
			preg_match('/src="(.+?)"/', $iframe, $matches);
			$src = $matches[1];

			//Check video provider
			$video_youtube = "/youtube/iU";
			$video_vimeo = "/vimeo/iU";

			if ( preg_match($video_youtube, $src) )
			{
				$volume = ($options['bg_video_sound']) ? $options['bg_video_sound'] : 0;
				$controls = ($options['bg_video_controls']) ? $options['bg_video_controls'] : 0;
				$autoplay = ($options['bg_video_autoplay']) ? $options['bg_video_autoplay'] : 0;

				if($volume == 1)
				{
					$result_volume = 'player.mute()';
				}
				else
				{
					$result_volume = 'player.unMute()';
				}

				$id_video = rand(1,12345678);

				//Get result
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

				echo $iframe;
			}
			elseif ( preg_match($video_vimeo, $src) )
			{
				$volume = ($options['bg_video_sound']) ? $options['bg_video_sound'] : 0;
					if($volume == 1)
					{
						$result_volume = 0;
					}
					else
					{
						$result_volume = 1;
					}
				$controls = ($options['bg_video_controls']) ? $options['bg_video_controls'] : 0;
					if($controls == 1)
					{
						$result_controls = 0;
					}
					else
					{
						$result_controls = 1;
					}
				$autoplay = ($options['bg_video_autoplay']) ? $options['bg_video_autoplay'] : 0;

				$id_video = rand(1,12345678);

				//Get result
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

				echo $iframe;
			}
			else {
				return;
			}

	}




	
}
