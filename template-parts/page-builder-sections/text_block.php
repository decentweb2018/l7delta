<?php
	$contrast_color = l7_pb::contrast_color($component['background'][0]);
?>

<?php

$custom_color_toggle = $component['custom_text_colors'][0]['custom_color_toggle'];
$blockID = $component['custom_text_colors'][0]['block_id'];
$paragraph_color = $component['custom_text_colors'][0]['paragraph_color'];
$h1_color = $component['custom_text_colors'][0]['h1_color'];
$h2_color = $component['custom_text_colors'][0]['h2_color'];
$h3_color = $component['custom_text_colors'][0]['h3_color'];
$h4_color = $component['custom_text_colors'][0]['h4_color'];
$h5_color = $component['custom_text_colors'][0]['h5_color'];
$h6_color = $component['custom_text_colors'][0]['h6_color'];

?>


<section class="<?php l7_pb::component_class( $component ); ?> <?php l7_pb::animate_classes( $component['animate_options'][0] ); ?>" style="<?php l7_pb::background_style( $component['background'][0] ); ?>">
	<?php if (defined('WP_DEBUG') && true === WP_DEBUG){ ?><div style="display: none;"><?php print_r( $component ); ?></div><?php } ?>
	<div class="max-width-container">
		<div class="reading-well" <?php if ($custom_color_toggle == 1) {
			echo "id='block-$blockID'";
		}?>>
			<?php
				echo apply_filters( 'the_content', $component['content'] );
			?>
			<?php if( !empty($component['links']) ): ?>
				<?php foreach ( $component['links'] as $link ): ?>
					<?php
						$target = ( $link['new_window'] ? '_blank' : '_self' );
					?>
					<a href="<?php echo $link['url']; ?>" class="cta over-effect" target="<?php echo $target; ?>" >
						<span class="over-effect-label"><?php echo $link['label'] ?></span><span class="icon icon-fast-forward"></span>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php l7_pb::overlay_bg( $component['background'][0] ) ?>
	<?php l7_pb::parallax_bg( $component['background'][0] ) ?>
	<?php l7_pb::background_video( $component['background'][0] ) ?>
</section>

<?php
if ($custom_color_toggle == 1) { ?>
	<style>
		#<?php echo $blockID; ?> p {
			color: <?php echo $paragraph_color; ?>;
		}

		#<?php echo $blockID; ?> h1 {
			color: <?php echo $h1_color; ?>;
		}

		#<?php echo $blockID; ?> h2 {
			color: <?php echo $h2_color; ?>;
		}

		#<?php echo $blockID; ?> h3 {
			color: <?php echo $h3_color; ?>;
		}

		#<?php echo $blockID; ?> h4 {
			color: <?php echo $h4_color; ?>;
		}

		#<?php echo $blockID; ?> h5 {
			color: <?php echo $h5_color; ?>;
		}

		#<?php echo $blockID; ?> h6 {
			color: <?php echo $h6_color; ?>;
		}
	</style>
<?php } ?>
