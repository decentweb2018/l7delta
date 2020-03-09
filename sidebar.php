<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package _l7_theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<aside class="widget widget_categories_custom">
		<h1 class="widget-title">Jump To a Topic:</h1>
		<?php
			$categories = get_categories( array(
				'orderby' => 'name',
				'parent'  => 0
			) );

			foreach ( $categories as $category ) {
				printf( '<a href="%1$s">%2$s</a><br />',
					esc_url( get_category_link( $category->term_id ) ),
					esc_html( $category->name )
				);
			}
		?>
	</aside>

<!-- 
	<aside class="widget widget_search_contact_custom">
		<?php get_search_form(true); ?>
		<?php gravity_form( "Ask Us a Question", $display_title = true, $display_description = false, $display_inactive = false, $field_values = null, $ajax = true, 123, $echo = true ); ?>
	</aside>
 -->

	
	<aside class="widget widget_tags_custom">
		<h1 class="widget-title">Keywords:</h1>
	<?php
		$tags = get_tags( array(
			'orderby' => 'name',
			''
		) );
		$html = '<div class="post_tags">';
		$tags_length = count( $tags );
		$i = 1;
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );

			$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$html .= "{$tag->name}</a>";

			if ( $i !== $tags_length ){
				$html .= ", ";
			}
			$i++;
		}
		$html .= '</div>';
		echo $html;
	?>
	</aside>

	
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
