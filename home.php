<?php
get_header(); ?>
<div class="max-width-container blog-container">
	<?php //get_sidebar(); ?>
<?php if ( have_posts() ) : ?>
	<div id="primary" class="content-area">

		<?php $blog_layout = get_field('blog_layout', 'option'); ?>


		<?php if ( $blog_layout == 'list' ) { ?>
			<div class="blog-list">

				<!-- Start of the main loop. -->
				<?php while ( have_posts() ) : the_post();  ?>

						<?php 
							$bgimg = get_the_post_thumbnail_url();
											 
							if (empty($bgimg)) {
								$bgimg = '/wp-content/uploads/no-image.jpg';
							}
						?>

						<div class="blog-single-post clearfix">
							<a href="<?php the_permalink(); ?>" class="blog-single-featured" <?php if ( !empty($bgimg) ) {?>style="background-image: url('<?php echo $bgimg; ?>');" <?php } ?>></a>
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
		<?php } else if ( $blog_layout == 'cards' ) { ?>

			<div class="featured-posts-top">
				<?php

				$featured_id = array();

				// check if the repeater field has rows of data
				if( have_rows('featured_posts', 'option') ):

					// loop through the rows of data
						while ( have_rows('featured_posts', 'option') ) : the_row(); ?>

						<?php $post_obj = get_sub_field('the_post');
						if( $post_obj ):

						// override $post
						$post = $post_obj;
						setup_postdata( $post );

						$curID = get_the_ID();

						array_push($featured_id, $curID);
	
						$bgimg = get_the_post_thumbnail_url();

						if (empty($bgimg)) {
							$bgimg = '/wp-content/uploads/no-image.jpg';
						}


						?>

						<a href="<?php the_permalink(); ?>" class="featured col-6" style="background-image: url('<?php echo $bgimg; ?>');">
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

		<?php 
			$bgimg = get_the_post_thumbnail_url();
	
			if (empty($bgimg)) {
				$bgimg = '/wp-content/uploads/no-image.jpg';
			}
			
			$postid = get_the_ID();
		?>

		<?php if ( $postid == $featured_id[0] || $postid == $featured_id[1] ) { ?>

			

	<?php } else { ?>

		<a href="<?php the_permalink(); ?>" class="featured col-4" <?php if ( !empty($bgimg) ) { ?> style="background-image: url('<?php echo $bgimg; ?>');" <?php } ?>>
			<div class="overlay"></div>
			<div class="overlay-full"></div>
			<div class="content">
				<h2><?php the_title(); ?></h2>
			</div>
		</a>

	<?php } ?>


<?php endwhile; ?>
<!-- End of the main loop -->

			</div>

		<?php } else { ?>

			<div class="block-featured-list">


			<?php while ( have_posts() ) : the_post();  ?>

					<?php 
						$bgimg = get_the_post_thumbnail_url(); 
					  
						if (empty($bgimg)) {
							$bgimg = '/wp-content/uploads/no-image.jpg';
						}
					?>

					<a href="<?php the_permalink(); ?>" class="featured col-6 flist" style="background-image: url('<?php echo $bgimg; ?>');">
						<div class="overlay"></div>
						<div class="overlay-full"></div>
						<div class="content">
							<h2><?php the_title(); ?></h2>
						</div>
					</a>


			<?php endwhile; ?>

						</div>


		<?php } ?>



		<?php

			_l7_custom_pagination();

		?>

<?php else : ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
