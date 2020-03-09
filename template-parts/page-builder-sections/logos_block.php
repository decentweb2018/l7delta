<section class="<?php l7_pb::component_class( $component ); ?>" >
	<?php if (defined('WP_DEBUG') && true === WP_DEBUG){ ?><div style="display: none;"><?php print_r( $component ); ?></div><?php } ?>
    <?php
    if( !empty( $component['block_title'] ) ) {
	    ?>
        <div class="max-width-container">
            <h2 class="block-title"><?php echo $component['block_title']; ?></h2>
        </div>
	    <?php
    }
    ?>
	<div class="max-width-container">
			<?php if( !empty($component['logos']) ): ?>
                <div class="logos-container">
				<?php foreach ( $component['logos'] as $logo ): ?>
					<img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
				<?php endforeach; ?>
                </div>
			<?php endif; ?>
	</div>
</section>
