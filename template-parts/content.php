<?php
/**
 * Template part for displaying posts.
 *
 * @package _l7_theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="reading-well reading-well-archive">
		<?php if( is_single() ): ?>
			<a href="/blog" class="back-button">Go Back</a>
		<?php endif; ?>
		<header class="entry-header">
			<?php the_category(); ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</header><!-- .entry-header -->


		<?php if ( get_field('featured_image_type') == 'fullwidth' ) { ?>
			<div class="featured-image">
				<img src="<?php echo get_the_post_thumbnail_url(); ?>" width="100%">
			</div>
		<?php } else if ( get_field('featured_image_type') == 'small' ) { ?>
			<div class="featuredimg">
				<img src="<?php echo get_the_post_thumbnail_url(); ?>" width="100%">
			</div>
		<?php } else {  } ?>

		<div class="entry-content">
			<?php
				if( is_search() || is_category() || is_tag() || is_archive() || is_home() ){
					echo "<p>" . get_the_excerpt() . "</p>";
				} else{

					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_l7_theme' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				}
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_l7_theme' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
