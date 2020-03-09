<?php
/**
 * _l7_theme functions and definitions
 *
 * @package _l7_theme
 */

define( 'ASSETS_VERSION', '1.0.6' );

if ( ! function_exists( '_l7_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _l7_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on this, use a find and replace
	 * to change '_l7_theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_l7_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'           => esc_html__( 'Primary Menu', '_l7_theme' ),
		'social-media-menu' => esc_html__( 'Social Media Menu', '_l7_theme' ),
		'slide-out-nav'     => esc_html__( 'Slide Out Menu', '_l7_theme' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_l7_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _l7_setup
add_action( 'after_setup_theme', '_l7_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _l7_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_l7_content_width', 640 );
}
add_action( 'after_setup_theme', '_l7_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _l7_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_l7_theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', '_l7_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _l7_scripts() {
	wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), ASSETS_VERSION, false );
	wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/assets/vendor/animate.css/animate.min.css', array(), ASSETS_VERSION );
	wp_enqueue_script( 'wowjs', get_template_directory_uri() . '/assets/vendor/wow/dist/wow.js', array('jquery'), ASSETS_VERSION, true );
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/vendor/slick-carousel/slick/slick.css', array(), ASSETS_VERSION );
	wp_enqueue_style( 'slick-css-theme', get_template_directory_uri() . '/assets/vendor/slick-carousel/slick/slick-theme.css', array(), ASSETS_VERSION );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/vendor/slick-carousel/slick/slick.min.js', array('jquery'), ASSETS_VERSION, true );
	wp_enqueue_script( 'autogrow', get_template_directory_uri() . '/assets/vendor/jquery.autogrow-textarea/jquery.autogrow-textarea.js', array('jquery'), ASSETS_VERSION, true );
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/assets/vendor/jquery.cookie/jquery.cookie.js', array( 'jquery' ), ASSETS_VERSION, true );


	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		wp_enqueue_style( 'l7_icomoon', 'https://i.icomoon.io/public/3eb0997007/L7/style.css', array(), ASSETS_VERSION );
		wp_enqueue_style( '_l7_theme-style', get_template_directory_uri() . '/assets/build/styles.css', array('l7_icomoon'), ASSETS_VERSION );
		wp_enqueue_script( '_l7_theme-scripts', get_template_directory_uri() . '/assets/build/scripts.js', array('jquery', 'jquery-cookie'), ASSETS_VERSION, true );
	} else {
		wp_enqueue_style( 'l7_icomoon', 'https://s3.amazonaws.com/icomoon.io/69148/L7/style.css?lq5dpn', array(), ASSETS_VERSION );
		wp_enqueue_style( '_l7_theme-style', get_template_directory_uri() . '/assets/dist/styles.min.css', array('l7_icomoon'), ASSETS_VERSION );
		wp_enqueue_script( '_l7_theme-scripts', get_template_directory_uri() . '/assets/dist/scripts.min.js', array('jquery', 'jquery-cookie'), ASSETS_VERSION, true );
	}

	$child_css_path = get_template_directory() . '/child-styles.css';
	$child_css_url  = get_template_directory_uri() . '/child-styles.css';

	if( file_exists( $child_css_path ) ){
		wp_enqueue_style( 'kingsmen_child-style', $child_css_url, array( '_l7_theme-style' ), filemtime( $child_css_path ) );
	}

	wp_enqueue_style( 'l7_plain_css', get_template_directory_uri() . '/style.css', array('l7_icomoon'), ASSETS_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_l7_scripts' );



//Second solution : two or more files.
add_action( 'admin_enqueue_scripts', '_l7_load_admin_styles' );
function _l7_load_admin_styles() {
	wp_enqueue_style( 'montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700', array(), ASSETS_VERSION );
	wp_enqueue_style( 'lato', 'https://fonts.googleapis.com/css?family=Lato:400,300,400italic,700,700italic', array(), ASSETS_VERSION );
	wp_enqueue_style( '_l7_theme-style-admin', get_stylesheet_directory_uri() . '/assets/build/admin.css', array(), ASSETS_VERSION );
	wp_enqueue_script( '_l7_theme-scripts-admin', get_template_directory_uri() . '/assets/build/admin.js', array('jquery'), ASSETS_VERSION, true );

//	wp_enqueue_style( 'admin_css_foo', get_template_directory_uri() . '/admin-style-foo.css', false, '1.0.0' );
//	wp_enqueue_style( 'admin_css_bar', get_template_directory_uri() . '/admin-style-bar.css', false, '1.0.0' );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom data - Custom POst types, taxonomies, etc
 */
require get_template_directory() . '/inc/custom-data.php';

require get_template_directory() . '/inc/page_builder.php';


function l7_portfolio_pagesize( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( is_post_type_archive( 'portfolio' ) ) {
		// Display 100 posts for a custom post type called 'portfolio'
		$query->set( 'posts_per_page', 100 );
		return;
	}
}
add_action( 'pre_get_posts', 'l7_portfolio_pagesize', 1 );



add_action( 'wp', 'l7_edit_excerpt_length', 9999);

function l7_edit_excerpt_length(){
	$truncate_by = get_field( 'excerpt_truncate_by', 'option' );

	if ( $truncate_by === 'char' ){

		function elpie_excerpt($text)
		{
			$count = get_field( 'truncate_amount', 'option' );

			global $post;
			$excerpt = get_the_content();
			$excerpt = wp_kses($excerpt, array());
			$excerpt = preg_replace('/\s+/S', " ", $excerpt);
			$excerpt = substr($excerpt, 0, $count);
			$excerpt = substr($excerpt, 0, strripos($excerpt, " "));

			return $excerpt . ' &hellip; <a class="read-more-link" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';
		}
		add_filter('get_the_excerpt', 'elpie_excerpt', 999);

	}else if( $truncate_by === 'word' ){

		function custom_excerpt_length( $length ) {
			$count = get_field( 'truncate_amount', 'option' );
			return $count;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

		function elpie_excerpt($text)
		{
			global $post;

			$text = str_replace('[&hellip;]', '&hellip;', $text);
			return $text . ' <a class="read-more-link" href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';
		}
		add_filter('get_the_excerpt', 'elpie_excerpt');

	}

}

function l7_tax_title($title)
{
	if ( is_category() ) {
		$title = sprintf( __( 'Articles under "%s"' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Articles tagged "%s"' ), single_tag_title( '', false ) );
	} elseif ( is_search() ){
		$title = sprintf( __( 'Search results for "%s"' ), get_search_query( '', false ) );
	}

	return $title;
}
add_filter('get_the_archive_title', 'l7_tax_title');



add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );

function form_submit_button( $button, $form ) {
	if( $form['button']['type'] !== 'text' ){
		return $button;
	}
	return "<button class='button over-effect' id='gform_submit_button_{$form['id']}'><span class=\"over-effect-label\">" . $form['button']['text'] . "</span><span class=\"icon icon-fast-forward\"></span></button>";
}

add_filter( 'gform_confirmation_anchor', '__return_false' );


function remove_gravityforms_style() {
	wp_dequeue_style('gforms_css');
}
add_action('wp_print_styles', 'remove_gravityforms_style');


function gfs_acf_init() {
	//acf_update_setting( 'show_admin', false );
	acf_update_setting( 'google_api_key', 'AIzaSyADJGLjZARlx4qsocgCgpXL84J21ZNUUbM' );
}
add_action( 'acf/init', 'gfs_acf_init' );


include_once('inc/acf_code_area-field/acf_code_area-v5.php');


//Post QA Function
function post_qa_body($atts) {
	extract(shortcode_atts(array(
		'question' => '#',
		'answer' => '#',
	), $atts));

	$the_qa_output = '<div class="qa_element">';
	$the_qa_output .= '<div class="qa_question">';
	$the_qa_output .= $question;
	$the_qa_output .= '<div class="qa_answer">';
	$the_qa_output .= $answer;
	$the_qa_output .= '</div></div></div>';

    return $the_qa_output;
}

add_shortcode('post_qa', 'post_qa_body');

//footer cta
function post_cta_body($atts, $content = null) {
	extract(shortcode_atts(array(
		'link' => '#',
		'link_text' => '#',
		'type' => '#'
	), $atts));

		$themecolor = get_field('primary_theme_color', 'option');
		if ($type == 'p') {
			$the_cta_otput = '<div class="shortcode_cta_block" style="color:' .$themecolor. '">';
			$the_cta_otput .= $content;
			$the_cta_otput .= '<div class="shortcode_cta-link"><a href="'.$link.'">'.$link_text.'</a>';
			$the_cta_otput .= '</div></div>';
		} else if ($type == 'h1') {
			$the_cta_otput = '<div class="shortcode_cta_block" style="color:' .$themecolor. '">';
			$the_cta_otput .= '<h1>'.$content.'</h1>';
			$the_cta_otput .= '<div class="shortcode_cta-link"><a href="'.$link.'">'.$link_text.'</a>';
			$the_cta_otput .= '</div></div>';
		} else if ($type == 'h2') {
			$the_cta_otput = '<div class="shortcode_cta_block"  style="color:' .$themecolor. '">';
			$the_cta_otput .= '<h2>'.$content.'</h2>';
			$the_cta_otput .= '<div class="shortcode_cta-link"><a href="'.$link.'">'.$link_text.'</a>';
			$the_cta_otput .= '</div></div>';
		} else if ($type == 'h3') {
			$the_cta_otput = '<div class="shortcode_cta_block"  style="color:' .$themecolor. '">';
			$the_cta_otput .= '<h3>'.$content.'</h3>';
			$the_cta_otput .= '<div class="shortcode_cta-link"><a href="'.$link.'">'.$link_text.'</a>';
			$the_cta_otput .= '</div></div>';
		}

    return $the_cta_otput;
}

add_shortcode('post_cta', 'post_cta_body');


/*
 * Custom buttom Shortcode
 */
add_shortcode( 'l7button', 'l7button_function' );

function l7button_function( $atts, $content ){

  $atts = shortcode_atts( array(
    'link'       => '#',
    'text_color' => '#000000',
    'bg_hover' => '#cccccc',
    'target' => '_self'
  ), $atts );

  $btn = "
    <a href='{$atts['link']}' target='{$atts['target']}' class='l7button'>$content</a>
    <style>
      .l7button {
        display: inline-block;
        padding: 11px 15px;
        color: {$atts['text_color']} !important;
        border: 3px solid {$atts['text_color']};
        border-radius: 4px;
        font-family: Montserrat,sans-serif;
        font-size: 1.3rem;
        line-height: 1;
        text-decoration: none;
        text-transform: uppercase;
        background-color: transparent;
        overflow: hidden;
        position: relative;
        transition: all .4s ease-in-out;
        font-weight: 700;
        z-index: 100;
      }
      .l7button::before {
        content: '';
        position: absolute;
        width: 170%;
        height: 300%;
        background-color: {$atts['bg_hover']};
        transform: rotate(-30deg);
        top: -380%;
        left: -90%;
        transition: all .7s ease-in-out;
        z-index: -1;
      }
      .l7button:hover {
        color: #ffffff !important;
        border-color: {$atts['bg_hover']} !important;
        text-decoration: none;
        background-color: {$atts['bg_hover']} !important;
      }
      .l7button:hover::before {
        height: 360%;
        top: -150%;
        left: -5%
      }
    </style>
  ";

  return $btn;
}

/*
 * Custom post password form
 */
add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
global $post;
$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
	<p><span class="input-wrap"><input name="post_password" id="' . $label . '" type="password" size="20" /><label for="' . $label . '">' . __( 'Password' ) . '</label></span> <button type="submit" class="button over-effect" name="Submit"><span class="over-effect-label">Enter</span><span class="icon icon-fast-forward"></span></button></p></form>
	';
return $o;
}

/**
 * Hide ACF fields in admin, post
 */

add_action('admin_head', 'hide_acf_fields');
	function hide_acf_fields() {
		echo '<style>
		.post-type-post #acf-group_5772d16d408df,
		.post-type-post #acf-group_576c7ecd95834 {
			display: none !important;
		}
		</style>';
}
