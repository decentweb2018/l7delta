<!-- this layout have featured section on the top -->

<?php
get_header(); ?>
<div class="max-width-container blog-container">
	<?php //get_sidebar(); ?>
<?php if ( have_posts() ) : ?>
	<div id="primary" class="content-area">

				<div class="featured-posts-top">
					<?php

					// check if the repeater field has rows of data
					if( have_rows('featured_posts', 'option') ):

					 	// loop through the rows of data
					    while ( have_rows('featured_posts', 'option') ) : the_row(); ?>

							<?php $post_obj = get_sub_field('the_post');
							if( $post_obj ):

							// override $post
							$post = $post_obj;
							setup_postdata( $post );

							?>

							<a href="<?php the_permalink(); ?>" class="featured col-6" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
								<div class="overlay"></div>
								<div class="overlay-full"></div>
								<div class="content">
									<h2><?php the_title(); ?></h2>
								</div>
							</a>

						    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
						<?php endif; ?>

					    <? endwhile;

					else :

					    // no rows found

					endif;

					?>
				</div>

					<div class="featured-posts-row">

		<!-- Start of the main loop. -->
		<?php while ( have_posts() ) : the_post();  ?>

				<?php $bgimg = get_the_post_thumbnail_url(); ?>

				<a href="<?php the_permalink(); ?>" class="featured col-4" <?php if ( !empty($bgimg) ) { ?> style="background-image: url('<?php echo $bgimg; ?>');" <?php } ?>>
					<div class="overlay"></div>
					<div class="overlay-full"></div>
					<div class="content">
						<h2><?php the_title(); ?></h2>
					</div>
				</a>


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
