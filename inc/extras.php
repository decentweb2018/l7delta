<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package _l7_theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _l7_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', '_l7_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function __l7_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', '_l7_theme' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', '_l7_wp_title', 10, 2 );

endif;

// Hide the annoying Yoast Promo messages - "click here to see new features" etc
function _l7_disable_yoast_promos() {
	echo '<style> .yoast-notice { display: none !important; } </style>';
}

add_action('admin_head', '_l7_disable_yoast_promos');



function _l7_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}


function _l7_custom_pagination(){
	add_filter( 'navigation_markup_template', function(){
		global $wp_query;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		// are we on page one?
		$first_page = '';
		if(2 < $paged) {
			$first_page = '<a href="/blog">First</a>';
		}
		// are we on last page?
		$last_page = '';
		if($wp_query->max_num_pages - 1 > $paged) {
			$last_page = '<a href="/blog/page/' .$wp_query->max_num_pages . '">Last</a>';
		}

		$template = '
				<nav class="navigation %1$s" role="navigation">
					<h2 class="screen-reader-text">%2$s</h2>
					<div class="nav-links"><span class="nav-links-title">JUMP TO A PAGE:</span> ' . $first_page . ' %3$s ' . $last_page . '</div>
				</nav>';
		return $template;
	}, 10, 2 );

	the_posts_pagination( array(
		'end_size' => 1,
		'mid_size' => 3,
		'prev_text' => __( '< Prev', 'textdomain' ),
		'next_text' => __( 'Next >', 'textdomain' ),
	) );
}