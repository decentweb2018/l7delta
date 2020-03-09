<?php 
	$text = get_sub_field('text');
	$links = get_sub_field('links');
	$custom_color_1 = get_sub_field('custom_color_1');
	$custom_color_2 = get_sub_field('custom_color_2');

	$custom_color = "style='background: $custom_color_1; background:-moz-linear-gradient(left, $custom_color_1 30%, $custom_color_2 70%);background:-webkit-linear-gradient(left, $custom_color_1 30%, $custom_color_2 70%);background:linear-gradient(to right, $custom_color_1 30%,$custom_color_2 70%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='$custom_color_1', endColorstr='$custom_color_2',GradientType=1 );'";
?>
<section class="acf-flexible-builder-notification content_builder_block notification_block" id="acf-flexible-builder-notification-<?php echo get_row_index(); ?>" <?php echo $custom_color; ?>>
   
    <div class="max-width-container">
    
		<?php if ($text) : ?>
            <span>
				<?php echo $text; ?>
            </span>
		<?php endif; ?>
		
		<?php if ( $links ) { ?>
			<?php foreach ( $links as $link ) { ?>
				<?php
				$target = ( $link['new_window'] ? '_blank' : '_self' );
				$custom_class = $link['custom_class'];
				?>
                <a href="<?php echo $link['url']; ?>" class="cta over-effect <?php echo $custom_class; ?>" target="<?php echo $target; ?>">
					<span><?php echo $link['label'] ?></span>
                </a>
			<?php } ?>
		<?php } ?>
    </div>
</section>