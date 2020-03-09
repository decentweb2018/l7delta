<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _l7_theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page-builder' ); ?>

				<div class="next-prev-links">
					<div class="prev-link">
						<?php next_post_link( '%link', '<span class="icon icon-arrow-left"></span> <span class="label">Previous Project</span><span class="title">: %title</span>' ); ?>
					</div><div class="next-link">
						<?php previous_post_link( '%link', '<span class="label">Next Project</span><span class="title">: %title</span> <span class="icon icon-arrow-right"></span>' ); ?>
					</div>
				</div>
				<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
