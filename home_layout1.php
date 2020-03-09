<?php
get_header(); ?>
<div class="max-width-container blog-container">
	<?php //get_sidebar(); ?>
<?php if ( have_posts() ) : ?>
	<div id="primary" class="content-area">



	<div class="blog-list">

		<!-- Start of the main loop. -->
		<?php while ( have_posts() ) : the_post();  ?>

				<?php $bgimg = get_the_post_thumbnail_url(); ?>

				<div class="blog-single-post clearfix">
					<a class="blog-single-featured" <?php if ( !empty($bgimg) ) {?>style="background-image: url('<?php echo $bgimg; ?>');" <?php } ?>></a>
					<div class="blog-single-content">
						<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
						<div class="blog-excerpt">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>

		<?php endwhile; ?>
		<!-- End of the main loop -->

	</div>

		<?php

			_l7_custom_pagination();

		?>

<?php else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
