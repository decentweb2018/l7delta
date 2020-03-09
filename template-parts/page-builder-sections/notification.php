<section class="<?php l7_pb::component_class( $component ); ?>" <?php
    if( !empty( $component['custom_color_1'] ) ){
        $color1 = $component['custom_color_1'];
        $color2 = $component['custom_color_2'];
        ?> style="background:<?php echo $color1; ?>;background:-moz-linear-gradient(left, <?php echo $color1; ?> 30%, <?php echo $color2; ?> 70%);background:-webkit-linear-gradient(left, <?php echo $color1; ?> 30%,<?php echo $color2; ?> 70%);background:linear-gradient(to right, <?php echo $color1; ?> 30%,<?php echo $color2; ?> 70%);filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $color1; ?>', endColorstr='<?php echo $color2; ?>',GradientType=1 );" <?php
    }
?>>
	<?php if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) { ?>
        <div style="display: none;"><?php print_r( $component ); ?></div><?php } ?>
    <div class="max-width-container">
		<?php
		if ( ! empty( $component['text'] ) ) {
			?>
            <span>
				<?php echo $component['text']; ?>
            </span>
			<?php
		}
		?>
		<?php if ( ! empty( $component['cta'] ) ) { ?>
			<?php foreach ( $component['cta'] as $link ) { ?>
				<?php
				$target = ( $link['new_window'] ? '_blank' : '_self' );
				?>
                <a href="<?php echo $link['url']; ?>" class="cta over-effect" target="<?php echo $target; ?>">
					<span><?php echo $link['label'] ?></span>
                </a>
			<?php } ?>
		<?php } ?>
    </div>
</section>
