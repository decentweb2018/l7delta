<section class="acf-flexible-builder-logos content_builder_block logos_block" id="acf-flexible-builder-logos-<?php echo get_row_index(); ?>">
	<?php if (get_sub_field('block_title')) : ?>
		<div class="max-width-container">
            <h2 class="block-title"><?php the_sub_field('block_title'); ?></h2>
        </div>
    <?php endif; ?>
    
	<div class="max-width-container">
			<?php if(get_sub_field('logos')): ?>
                <div class="logos-container">
				<?php foreach ( get_sub_field('logos') as $logo ): ?>
					<img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['alt'] ?>">
				<?php endforeach; ?>
                </div>
			<?php endif; ?>
	</div>
</section>
