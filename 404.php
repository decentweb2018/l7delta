<?php

$error_page = get_field( '404_page', 'option' );

if( !empty( $error_page ) ){
	header("Location: " . $error_page);
}


get_header();

$error_message = get_field( '404_message', 'option' );
$related_articles = get_field( '404_articles', 'option' );
?>
	<div class="max-width-container blog-container">
	<?php get_sidebar(); ?>
		<div id="primary" class="content-area">
			<?php
				if ( ! empty( $error_message ) ){
			?>
				<article class="post">
					<div class="max-width-container">
						<div class="entry-content">
							<?php
								echo wp_kses_post( apply_filters( 'the_content', $error_message ) );
							?>
						</div>
					</div>
				</article>
			<?php
				}
			?>
			<div class="related-articles-title">
				<div class="max-width-container">
					<h3>Here are some articles you might find interesting.</h3>
				</div>
			</div>
			<div class="related-articles">
				<?php

					foreach( $related_articles as $article ) { ?>

						<div class="related-article">
							<?php echo get_the_category_list('','',$article->ID); ?>
							<h1 class="entry-title"><a href="<?php echo esc_url( get_permalink($article->ID) ); ?>" rel="bookmark"><?php echo get_the_title( $article ); ?></a></h1>
							<a class="read-more-link" href="<?php echo get_permalink($article->ID); ?>">View Post</a>
						</div>

					<?php }

				?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>