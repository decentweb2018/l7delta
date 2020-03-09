<?php
/**
 * Template part for displaying posts.
 *
 * @package _l7_theme
 */

$image_block = get_field('image');
$description = get_field('display_description');
$hover_color = get_field('hover_color');
$display_title = get_field('display_title');

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo join( ' ', get_post_class() ); ?> wow fadeIn" >

    <header class="entry-header">
        <div class="entry-header-container">
            <div class="max-width-container">

				<?php
				if ( empty( $display_title ) ){
					the_title( '<h1 class="entry-title">', '</h1>' );
				}else{
					echo "<h1 class=\"entry-title\">{$display_title}</h1>";
				}
				if ( !empty( $description ) ){
					?><p class="entry-excerpt"><?php echo $description; ?></p><?php
				}
				?>
                <a href="<?php echo esc_url( get_permalink() ) ?>" class="over-effect cta">View More</a>
            </div>
        </div>

    </header><!-- .entry-header -->

	<?php if (defined('WP_DEBUG') && true === WP_DEBUG){ ?><div style="display: none;"><?php print_r( $image_block ); ?></div><?php } ?>
    <div class="featured-image" style="<?php l7_pb::background_style( $image_block[0]['image'][0] ); ?>">
		<?php
		$component = $image_block[0];
		$component['layout_type'] = 'image_block';

		include( locate_template( 'template-parts/page-builder-sections/image_block.php' ) );
		?>
    </div>

</article><!-- #post-## -->
