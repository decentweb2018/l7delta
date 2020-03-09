<?php
get_header(); ?>
<div class="max-width-container blog-container">

<?php if ( have_posts() ) : ?>
	<div id="primary" class="content-area blog-single-content">

		<!-- Start of the main loop. -->
		<?php while ( have_posts() ) : the_post();  ?>

			<?php
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				//get_template_part( 'template-parts/content', get_post_format() );

			?>

			<?php
			$post_thumbnail = get_the_post_thumbnail_url();


			?>

			<article class="blog-single">
				<h1><?php the_title(); ?></h1>
				<!--div class="heading-category">
					<?php the_category(); ?>
				</div-->

				<?php

				$ipi = get_field('inner_post_image');
				$img_status = get_field('featured_image_type');

				if ( $img_status !== 'off' ) {

				if ($ipi == 'image') { ?>

					<?php if ( !empty($post_thumbnail) ) { ?>

						<?php if ( $img_status == 'fullwidth' ) { echo '</article></div></div>'; }?>

					<div class="single-featured-image <?php if ( $img_status == 'fullwidth' ) { echo 'fw-image'; }?>" style="background-image: url('<?php echo $post_thumbnail; ?>');" ></div>

					<?php } ?>


				<?php } else if ($ipi == 'solid-color') { ?>
					<div class="solid-color" style="background:<?php the_field('inner_post_solid_color'); ?>"></div>
				<?php } else { ?>
					<div class="video-container">

						<?php
						//Get options for video
						$iframe = get_field('inner_post_video');

							//Get video SRC
							preg_match('/src="(.+?)"/', $iframe, $matches);
							$src = $matches[1];

							//Check video provider
							$video_youtube = "/youtube/iU";
							$video_vimeo = "/vimeo/iU";

							if ( preg_match($video_youtube, $src) )
							{
								$volume = get_field('inner_post_video_mute');
								if($volume == 1)
								{
									$result_volume = 'player.mute()';
								}
								else
								{
									$result_volume = 'player.unMute()';
								}
								$autoplay = get_field('inner_post_video_autoplay');
								$controls = get_field('inner_post_video_controls');
								if(empty($controls))
								{
									$controls = 0;
								}


								$id_video = rand(1,12345678);

								//Get result
								$iframe = "<iframe src='".$src."&autoplay=".$autoplay."&controls=".$controls."&mute=".$volume."&iv_load_policy=3&loop=1&rel=0&showinfo=0&enablejsapi=1' frameborder='0' 		webkitallowfullscreen
											mozallowfullscreen
											allowfullscreen allow='autoplay'
											id='video-".$id_video."' ></iframe>";

								echo $iframe;
								// echo "volume: ".$volume;
								// echo "controls: ".$controls;
								// echo "autoplay: ".$autoplay;
							}
							elseif ( preg_match($video_vimeo, $src) )
							{
								// vimeo
								$volume = get_field('inner_post_video_mute');
								$controls = get_field('inner_post_video_controls');
								$autoplay = get_field('inner_post_video_autoplay');

									if($volume == 1)
									{
										$result_volume = 0;
									}
									else
									{
										$result_volume = 1;
									}

									if($controls == 1)
									{
										$result_controls = 0;
									}
									else
									{
										$result_controls = 1;
									}

									if($autoplay == 1)
									{
										$result_autoplay = 0;
									}
									else
									{
										$result_autoplay = 1;
									}


								$id_video = rand(1,12345678);

								//Get result
								$iframe = "<iframe
											src='$src
											&autoplay=$autoplay
											&background=$result_controls'
											width='640'
											height='360'
											frameborder='0'
											title='L7 Website Branding Ad 1'
											webkitallowfullscreen
											mozallowfullscreen
											allowfullscreen
											allow='autoplay'
											id='video-$id_video' ></iframe>
										";

								echo $iframe;
							}
							else {
								return;
							}
							?>

					</div>

				<? } } ?>

				<?php if ( $img_status == 'fullwidth' ) {?>
					<div class="site-content">
					 <div class="max-width-container blog-container blog-after-fw">
						 <article class="blog-single">
				<?php } ?>


				<div class="single-content">
					<?php the_content(); ?>
				</div>
			</article>


		<?php endwhile; ?>
		<!-- End of the main loop -->

		<div class="share-section">
			<?php get_template_part('template-parts/share-links'); ?>
		</div>

		<?php
		$orig_post = $post;
		global $post;
		$cats = wp_get_post_categories($post->ID);

		if ($cats[0] != 1) {
			$cat_ids = array();
			foreach($cats as $individual_cat) {
				$cat_ids[] = $individual_cat;
			}
			$args=array(
				'category__in' => $cat_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=>4, // Number of related posts to display.
			);

			$my_query = new wp_query( $args );

			if( $my_query->have_posts() ):
				?>

				<!-- Featured Posts -->


				<div class="blog-featured-posts">
					<h3 class="blog-fp">More articles you might find interesting.</h3>

					<div class="related-posts-items clearfix">
						<?php

								while( $my_query->have_posts() ) {
									$my_query->the_post();

									$cur_thumbnail = get_the_post_thumbnail_url();
									?>

									<a href="<?php the_permalink(); ?>" class="related-article-nl">
										<div class="related-article-image" <?php if (!empty($cur_thumbnail)) {?>style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');" <?php } ?>>
										</div>
										<div class="related-post-title"><?php the_title(); ?></div>
									</a>

								<?php } ?>
							</div>
						<?php
					endif;
				}
				$post = $orig_post;
				wp_reset_query();
				?>
		<?php else : ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</div> <!-- end featured posts -->



				</div>

</div>


<?php get_footer(); ?>
