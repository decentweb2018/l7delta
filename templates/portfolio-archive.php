<?php
/**
 * Template Name: Our Work - Archive
 *
 * @package _l7_theme
 */


// set up our archive arguments
$archive_args = array(
	'post_type' => 'portfolio',    // get only posts
	'posts_per_page'=> -1   // this will display all posts on one page
);

// new instance of WP_Quert
$archive_query = new WP_Query( $archive_args );


get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

		<?php if ( $archive_query->have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>

				<?php

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'portfolio-archive' );
				?>

			<?php endwhile; ?>

			<?php
//				the_posts_navigation();
			wp_reset_postdata(); // always reset post data after a custom query
			?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
