
<section class="<?php l7_pb::component_class( $component ); ?>" >
	<?php if (defined('WP_DEBUG') && true === WP_DEBUG){ ?><div style="display: none;"><?php print_r( $component ); ?></div><?php } ?>
	<?php if( !empty($component['intro_content']) ): ?>
		<div class="max-width-container">
			<div class="reading-well intro_content">
				<?php
					echo apply_filters( 'the_content', $component['intro_content'] );
				?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( $component['is_full_width'] === 'false'): ?>
		<div class="max-width-container">
	<?php elseif( $component['is_full_width'] === 'reading-well' ): ?>
            <div class="max-width-container reading-well">
	<?php endif; ?>
			<?php
				foreach ($component['grid'] as $block):
					$block_content = $block['grid_content'];
					$anim_opt = $block['animate_options'][0];
					$span_count = $block['span'];
			?>
					<div class="grid_item <?php echo "span-{$span_count}" ?> <?php l7_pb::animate_classes( $anim_opt ); ?>" <?php l7_pb::animate_data_attr( $anim_opt ); ?> style="<?php
                        l7_pb::background_style( $block['background'][0] );
                        if( !empty($block_content[0]) && $block_content[0]['acf_fc_layout'] === 'map' && ! empty($block_content[0]['height'] ) ){
                            echo " min-height: {$block_content[0]['height']}px";
                        }
                    ?>">
						<div>
						<?php
							if( !empty( $block['heading'] ) ):
								echo "<h1 class='section_heading'>{$block['heading']}</h1>";
							endif;
							if( !empty( $block['subheading'] ) ):
								echo "<h2 class='section_subheading'>{$block['subheading']}</h2>";
							endif;
							if( !empty( $block_content ) ):
								?><div class="grid-content-builder"><?php
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
						<?php l7_pb::overlay_bg( $block['background'][0] ) ?>
						<?php l7_pb::parallax_bg( $block['background'][0] ) ?>
						<?php l7_pb::background_video( $block['background'][0] ) ?>
					</div>

			<?php
				endforeach;
			?>
	<?php if ( $component['is_full_width'] !== 'true'): ?>
		</div>
	<?php endif; ?>
</section>