<?php
	$contrast_color = l7_pb::contrast_color($component['background'][0]);
?>
<section class="<?php l7_pb::component_class( $component ); ?> <?php l7_pb::animate_classes( $component['animate_options'][0] ); ?>" style="<?php l7_pb::background_style( $component['background'][0] ); ?>">
	<?php if (defined('WP_DEBUG') && true === WP_DEBUG){ ?><div style="display: none;"><?php print_r( $component ); ?></div><?php } ?>

	<?php
		$link = $component['cta'][0];
	?>
	<a href="<?php echo $link['url']; ?>" class="cta" target="<?php echo $target; ?>">
		<span><?php echo $link['label'] ?> <span class="icon icon-fast-forward"></span></span>
	</a>

	<?php l7_pb::overlay_bg( $component['background'][0] ) ?>
	<?php l7_pb::parallax_bg( $component['background'][0] ) ?>
	<?php l7_pb::background_video( $component['background'][0] ) ?>
</section>
