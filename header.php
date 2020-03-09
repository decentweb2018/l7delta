<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _l7_theme
 */

?><!DOCTYPE html>
<!--[if lte IE 8]>
<html class="no-js lt-ie10 lt-ie9 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Typekit -->
    <script src="https://use.typekit.net/fdx3mlw.js"></script>
    <script>try {
            Typekit.load({async: true});
        } catch (e) {
        }</script>

    <link rel="stylesheet" href="https://use.typekit.net/hrw0cbk.css">
    <script src="https://use.fontawesome.com/d573432fa9.js"></script>

	<?php wp_head(); ?>
</head>
<?php
    $should_display_notification = get_field( 'should_display_notification', 'option' );

$body_class = '';
if ( !empty($should_display_notification) ){
	$body_class = 'show-page-alert';
}

    $notification = get_field( 'notification', 'option' );

?>

<body <?php body_class( $body_class ); ?>>
<div class="breakpoint-context"></div>
<div id="page" class="hfeed site" data-wow-duration="2s">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_l7_theme' ); ?></a>

    <header class="delta-head">
        <div class="delta-site-branding pull-left">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                <?php
                    $logo     = get_field( 'logo', 'options' );
                    $logo_alt = get_field( 'logo_alt', 'options' );

                    if ( empty( $logo ) ) {
                        $logo = get_template_directory_uri() . '/assets/img/l7alpha.png';
                    } else {
                        $logo = $logo['url'];
                    }

                    if ( empty( $logo_alt ) ) {
                        $logo_alt = get_template_directory_uri() . '/assets/img/l7alpha.png';
                    } else {
                        $logo_alt = $logo_alt['url'];
                    }

                    $width  = get_field( 'logo_width', 'options' );
                    $height = get_field( 'logo_height', 'options' );

                    if( ! empty($width) ){
                        $width = "width=\"{$width}\"";
                    }

                    if( ! empty($height) ){
                      $height = "height=\"{$height}\"";
                    }
                ?>
                <img class="show-initial" src="<?php echo $logo; ?>" <?php echo $width ?> <?php echo $height ?>
                     alt="<?php bloginfo( 'name' ); ?> logo">
                <img class="show-on-opaque" src="<?php echo $logo_alt; ?>" <?php echo $width ?> <?php echo $height ?>
                     alt="<?php bloginfo( 'name' ); ?> logo">
                <span id="txtlogo" class="text-logo">Home</span>
            </a>
        </div>

        <?php
        $delta_prime_btn_text = get_field('delta_primary_button_text', 'option');
        $delta_prime_btn_link = get_field('delta_primary_button_link', 'option');
        $delta_prime_btn_color = get_field('delta_primary_button_active_color', 'option');
        $delta_prime_btn_hover_color = get_field('delta_primary_button_hover_color', 'option');
        $delta_prime_btn_text_color = get_field('delta_primary_button_text_color', 'option');
        $delta_prime_btn_text_hovcolor = get_field('delta_primary_button_text__hover_color', 'option');
		$delta_prime_button_open_new_window = get_field('delta_primary_button_open_new_window', 'option');

        $delta_sec_btn_text = get_field('delta_secondary_button_text', 'option');
        $delta_sec_btn_link = get_field('delta_secondary_button_link', 'option');
        $delta_sec_btn_color = get_field('delta_secondary_button_active_color', 'option');
        $delta_sec_btn_hover_color = get_field('delta_secondary_button_hover_color', 'option');
        $delta_sec_btn_text_color = get_field('delta_secondary_button_text_color', 'option');
        $delta_sec_btn_text_hovcolor = get_field('delta_secondary_button_text__hover_color', 'option');
		$delta_sec_button_open_new_window = get_field('delta_secondary_button_open_new_window', 'option');
        ?>

        <div class="delta-header-buttons">

          <a class="delta-default-button hvr-sweep-to-right hvr-icon-drop pull-right" href="<?php echo $delta_prime_btn_link ?>" <?php if ($delta_prime_button_open_new_window) echo "target='_blanc'"; ?>><?php echo $delta_prime_btn_text; ?><i class="icn-arrow icon-arrow-right hvr-icon"></i></a>


          <? if ( get_field('delta_secondary_button_toggle', 'option') ) { ?>
              <a class="delta-default-button delta-second-header-btn hvr-sweep-to-right pull-right" href="<?php echo $delta_sec_btn_link ?>" <?php if ($delta_sec_button_open_new_window) echo "target='_blanc'"; ?>><?php echo $delta_sec_btn_text; ?><i class="icn-arrow icon-arrow-right hvr-icon"></i></a>
          <?php } ?>
        </div>

        <style>
          .delta-default-button {
            background-color: <?php echo $delta_prime_btn_color; ?>;
            color: <?php echo $delta_prime_btn_text_color; ?>;
          }

          .delta-default-button:hover {
            color: <?php echo $delta_prime_btn_text_hovcolor; ?>;
          }

          .delta-second-header-btn {
            background-color: <?php echo $delta_sec_btn_color; ?>;
            color: <?php echo $delta_sec_btn_text_color; ?>;
          }


          .delta-default-button.hvr-sweep-to-right:before {
            background: <?php echo $delta_prime_btn_hover_color; ?>;
          }



          .delta-default-button.hvr-sweep-to-right:hover, .delta-default-button.hvr-sweep-to-right:focus, .delta-default-button.hvr-sweep-to-right:active {
            color: <?php echo $delta_prime_btn_text_hovcolor; ?>;
          }


          .delta-second-header-btn:hover {
            color: <?php echo $delta_sec_btn_text_hovcolor; ?>;
          }

          .delta-second-header-btn.hvr-sweep-to-right:before {
            background: <?php echo $delta_sec_btn_hover_color; ?>;
          }

          .delta-second-header-btn.hvr-sweep-to-right:hover, .delta-second-header-btn.hvr-sweep-to-right:focus, .delta-second-header-btn.hvr-sweep-to-right:active {
            color: <?php echo $delta_sec_btn_text_hovcolor; ?>;
          }
        </style>


        <nav id="header-delta-main-navigation" class="delta-header-nav pull-right">
          <?php wp_nav_menu(
            array(
              'theme_location'  => 'primary',
              'menu_id'         => 'delta-menu',
              'container_class' => 'delta-menu-container'
            )
          ); ?>
        </nav>
    </header>

    <div class="delta-hamburger-menu-wrapper">
      <div class="delta-hamburger-menu"></div>
    </div>

    <style>
		.delta-hamburger-menu,
		.delta-hamburger-menu:before,
		.delta-hamburger-menu:after {
			background: <?php echo get_field('humburger_color', 'option'); ?>;
		}
    	.delta-hamburger-menu-wrapper:hover .delta-hamburger-menu, 
		.delta-hamburger-menu-wrapper:hover .delta-hamburger-menu:before, 
		.delta-hamburger-menu-wrapper:hover .delta-hamburger-menu:after {
      		background: <?php echo get_field('mobile_nav_hover_button_color', 'option'); ?>;
    	}
	</style>

    <style media="screen">
      .delta-site-branding img {
        height: <?php the_field('logo_height', 'option'); ?>px;
      }

      .delta-site-branding {
        margin-top: <?php  the_field('logo_margin_top', 'option')?>px;
        margin-bottom: <?php  the_field('logo_margin_bottom', 'option')?>px;
      }

      #txtlogo {
        color: <?php the_field('home_button_color', 'option'); ?>;
      }
    </style>

    <div id="content" class="site-content">
