<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _l7_theme
 */

$delta_footer_bg = get_field('delta_footer_background_color', 'option');
$delta_footer_bg_image = get_field('footer_background_image', 'option');
$delta_footer_text_color = get_field('delta_footer_text_color', 'option');
$footer_image_link = get_field('footer_image_file', 'option');
$delta_footer_link_hover = get_field('delta_footer_link_hover_color', 'option');

$cta_btn_color = get_field('cta_button_color', 'option');
$cta_btn_hover = get_field('cta_button_hover_color', 'option');

$phone_number          = get_field( 'phone_number', 'option' );
$phone_number_stripped = preg_replace( "/[^0-9]/", "", $phone_number );
$footer_email = get_field('footer_email', 'option');

$testimonials = get_field( 'testimonials', 'option' );

$slick_options = '{"autoplay":true';

$testimonial_animation = get_field( 'testimonials_animation', 'option' );
if ( ! empty( $testimonial_animation ) && $testimonial_animation === 'slide' ) {
	$slick_options .= ',"fade": false';
} else if ( ! empty( $testimonial_animation ) && $testimonial_animation === 'fade' ) {
	$slick_options .= ',"fade": true';
}

$testimonial_speed = get_field( 'testimonials_speed', 'option' );
if ( ! empty( $testimonial_animation ) ) {
	$slick_options .= ',"speed": ' . $testimonial_speed;
}

$testimonial_autoplaySpeed = get_field( 'testimonials_autoplaySpeed', 'option' );
if ( ! empty( $testimonial_animation ) ) {
	$slick_options .= ',"autoplaySpeed": ' . $testimonial_autoplaySpeed;
}


$slick_options .= '}';

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php
	if ( ! empty( $testimonials ) ):
		?>
        <div class="client-testimonials wow fadeIn">
            <div class="max-width-container">
                <div class="reading-well">
                    <h2>Client Testimonials</h2>
                    <ul data-slick='<?php echo $slick_options; ?>'>
						<?php
						foreach ( $testimonials as $testimonial ):
							?>
                            <li>
								<?php echo $testimonial['content'] ?>
                            </li>
							<?php
						endforeach;
						?>
                    </ul>
                </div>
            </div>
        </div>
		<?php
	endif;
	?>
    <div class="footer-cta">
        <div class="cta-container max-width-container wow slideInRight">
			<?php
			$cta_copy = get_field( 'footer_cta_copy', 'options' );
			if ( empty( $cta_copy ) ) {
				$cta_copy = 'Ready to get started?';
			}

			$cta_link_label = get_field( 'footer_cta_link', 'options' );
			if ( ! empty( $cta_link_label[0]['label'] ) ) {
				$cta_link_label = $cta_link_label[0]['label'];
			} else {
				$cta_link_label = 'Let Us Help';
			}

			$cta_link_url = get_field( 'footer_cta_link', 'options' );
			if ( ! empty( $cta_link_url[0]['url'] ) ) {
				$cta_link_url = $cta_link_url[0]['url'];
			} else {
				$cta_link_url = 'mailto:team@l7lc.com?subject=L7 Strategic - I am ready to make a great first impression.';
			}

			$footer_cta_bg = get_field( 'footer_cta_bg_color', 'options' );
			$footer_cta_image = get_field( 'footer_cta_image', 'options' );
			$footer_cta_overlay = get_field('cta_bg_overlay', 'option');
			$footer_cta_overlay_color = get_field('cta_background_overlay', 'option');
			$footer_cta_overlay_opacity = get_field('bg_overlay_opacity', 'option');
			$footer_cta_otp = $footer_cta_overlay_opacity / 100;
			?>

			<!--
			if ( ! empty( $footer_cta_image['url'] ) ) {
				$footer_cta_image = $footer_cta_image['url'];
			} else {
				$footer_cta_image = '/wp-content/themes/l7alpha/assets/img/cta-bg.jpg';
			} -->

            <h3 class="cta-title"><?php echo $cta_copy; ?></h3>
            <p>
                <a href="<?php echo $cta_link_url ?>" class="btn over-effect" <?php if (get_field( 'footer_cta_link', 'options' )[0]['new_window']) echo 'target="_blank"'; ?>>
					<?php echo $cta_link_label ?>
                </a>
            </p>
        </div>

        <div class="parallax-container as-bg">
            <div class="parallax">

							<?php if ($footer_cta_overlay == true): ?>
								<div class="cta_overlay" style="background-color: <?php  echo $footer_cta_overlay_color; ?>; opacity: <?php  echo $footer_cta_otp; ?>;"></div>
							<?php endif; ?>

								<?php if ($footer_cta_image == true): ?>
									<div class="parallax_item" style="background-color: <?php  echo $footer_cta_bg; ?>;background-image: url( '<?php echo $footer_cta_image; ?>' );">
									</div>
								<?php endif; ?>

								<?php if ($footer_cta_image == false): ?>
									<div class="parallax_item" style="background-color: <?php  echo $footer_cta_bg; ?>;">
									</div>
								<?php endif; ?>

            </div>
        </div>
    </div>

		<div class="footer-menu" style="<?php

		echo 'background-color:' .  $delta_footer_bg . ';';
		if (get_field('footer_background_toggle', 'option') == 1) {
			echo "background-image: url('". $delta_footer_bg_image . "');";
			echo 'background-size: contain; background-position: center bottom; background-repeat: no-repeat';
		}

		?>">
        <div class="social-media-links">
            <div class="max-width-container">
                <ul>
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'social-media-menu',
						'depth'           => 1,
						'container_class' => 'social-media-menu-container',
					) );
					?>
                </ul>
            </div>
        </div>
        <div class="max-width-container">
            <ul>
                <li>&copy; <?php echo date( "Y" ); ?> <?php the_field( 'copyright_name', 'options' ) ?></li>
                <li><a href="/Terms-of-Use/">LEGAL STUFF</a></li>

								<?php if ( $phone_number == true or $footer_email == true ) {

									if ( $phone_number == true ) { ?>
										<li><a href="tel:<?php echo $phone_number_stripped; ?>"><?php echo $phone_number; ?></a></li>
									<?php } else {?>
										<li><a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a></li>
									<?php } ?>

								<?php } else {
									//show nothing
								} ?>

								<li><a target="_blank" href="https://www.l7-marketing.com/">by L7 Marketing</a></li>
            </ul>

            <div class="disclaimer">

								<?php $delta_footer_logo = get_field('footer_logo', 'option');
											$delta_footer_width = get_field('footer_logo_width', 'option');
								?>
								<div class="footer-image">
									<img src="<?php echo $delta_footer_logo; ?>" alt="<?php bloginfo( 'name' ); ?> logo" width="<?php echo $delta_footer_width; ?>">
								</div>


				<?php
				$disclaimer = get_field( 'disclaimer', 'options' );
				if ( ! empty( $disclaimer ) ) {
					echo $disclaimer;
				}
				?>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->
<div class="helper-buttons">
	<?php if ( ! is_front_page() ): ?>
        <a href="#" class="back-page" onclick="window.history.back(); return false;"><span
                    class="icon icon-rewind"></span><span>Back</span></a>
	<?php endif; ?>
    <a href="#" class="back-to-top"><span class="icon icon-ff-up"></span><span>Scroll Up</span></a>
</div>
<nav class="slide-out-container">
    <div class="bg-overlay"></div>
    <div class="slide-out">
        <div class="btn-close">
            Close
        </div>


        <div class="show-on-mobile">

			<?php wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu_id'         => 'primary-menu-slide',
				'container_class' => 'menu-slide-out-nav-container',
				'depth'           => 3
			) ); ?>

        </div>

		<?php
		wp_nav_menu( array(
			'theme_location'  => 'slide-out-nav',
			'container_class' => 'menu-slide-out-nav-container',
			'link_after'      => "<span class='menu-arrow'></span>",
			'depth'           => 3
		) );
		?>

		<?php
		$phone = get_field( 'contact_phone', 'option' );
		$email = get_field( 'contact_email', 'option' );

		if ( ! empty( $phone ) || ! empty( $email ) ) {
			echo "<h3>Contact</h3>";
			echo "<div class='menu-contact-info'>";
			echo "<p><a href='tel:" . $phone . "'>" . $phone . "</a></p>";
			echo "<p><a href='mailto:" . $email . "'>" . $email . "</a></p>";
			echo "</div>";
		}
		?>

		<?php
		if ( has_nav_menu( 'social-media-menu' ) ) {
			echo "<h3>Social</h3>";

			wp_nav_menu( array(
				'theme_location'  => 'social-media-menu',
				'container_class' => 'menu-social-menu-container',
			) );
		}

		?>
    </div>
</nav>




<style media="screen">
	.site-footer .footer-menu .disclaimer {
		color: <?php echo $delta_footer_text_color; ?>;
	}

	.site-footer .footer-menu {
		color: <?php echo $delta_footer_text_color; ?>;
	}

	.site-footer .footer-menu a {
		color: <?php echo $delta_footer_text_color; ?>;
	}

	.site-footer .footer-menu a:hover {
		color: <?php echo $delta_footer_link_hover; ?>;
	}
</style>

<!-- Mobile Menu -->

<div class="mobile-nav">
	<div class="delta-site-branding delta-site-branding-mob pull-left">
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
			</a>
	</div>

	<nav id="header-delta-mobile-navigation" class="delta-header-nav pull-right">
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_id'         => 'delta-menu',
				'container_class' => 'delta-menu-container'
			)
		); ?>
	</nav>

	<div class="mobile-nav-bottom-btn">
		<div class="mobile-delta-header-buttons">

			<?php
			$delta_prime_btn_text = get_field('delta_primary_button_text', 'option');
			$delta_prime_btn_link = get_field('delta_primary_button_link', 'option');
			$delta_prime_btn_color = get_field('delta_primary_button_active_color', 'option');
			$delta_prime_btn_hover_color = get_field('delta_primary_button_hover_color', 'option');
			$delta_prime_btn_text_color = get_field('delta_primary_button_text_color', 'option');
			$delta_prime_btn_text_hovcolor = get_field('delta_primary_button_text__hover_color', 'option');

			$delta_sec_btn_text = get_field('delta_secondary_button_text', 'option');
			$delta_sec_btn_link = get_field('delta_secondary_button_link', 'option');
			$delta_sec_btn_color = get_field('delta_secondary_button_active_color', 'option');
			$delta_sec_btn_hover_color = get_field('delta_secondary_button_hover_color', 'option');
			$delta_sec_btn_text_color = get_field('delta_secondary_button_text_color', 'option');
			$delta_sec_btn_text_hovcolor = get_field('delta_secondary_button_text__hover_color', 'option');
			?>

			<a class="delta-default-button hvr-sweep-to-right pull-right" href="<?php echo $delta_prime_btn_link ?>"><?php echo $delta_prime_btn_text; ?></a>
			<? if ( get_field('delta_secondary_button_toggle', 'option') ) { ?>
					<a class="delta-default-button delta-second-header-btn hvr-sweep-to-right pull-right" href="<?php echo $delta_sec_btn_link ?>"><?php echo $delta_sec_btn_text; ?></a>
			<?php } ?>

		</div>
	</div>
</div>


</div><!-- #page -->





<?php if ( get_field('disable_footer_cta') == true ) { ?>

	<style>
		.footer-cta {
			display: none !important;
		}
	</style>

<?php } ?>

<style>
	.site-footer .footer-cta .cta-container .btn {
		color: <?php echo $cta_btn_color; ?>;
		border-color: <?php echo $cta_btn_color; ?>;
	}

	.site-footer .footer-cta .cta-container .btn:hover {
		border-color: <?php echo $cta_btn_hover; ?> !important;
		background-color: <?php echo $cta_btn_hover; ?> !important;
	}

	.gform_wrapper input[type=submit].gform_button:before, .primary-menu-container>li>a:before, .primary-menu-container>ul>li>a:before {
		background-color: <?php echo $cta_btn_hover; ?> !important;
	}
</style>

<?php wp_footer(); ?>

<?php

$custom_header = get_field('custom_header', 'option');
$c_header_bg = get_field('header_background_color', 'option');
$c_header_color = get_field('header_nav_color', 'option');
$c_header_hcolor = get_field('header_nav_hover_color', 'option');
$c_header_mobbg = get_field('mobile_background', 'option');
$c_header_level = get_field('nav_levels', 'option');

if ( !empty($custom_header) ) { ?>
	<style media="screen">
		header.delta-head {
			background: <?php echo $c_header_bg; ?>;
		}

		header.delta-head .delta-menu-container ul li a {
			color: <?php echo $c_header_color; ?>;
		}

		header.delta-head .delta-menu-container ul li:after {
			color: <?php echo $c_header_color; ?>;
		}

		header.delta-head .delta-menu-container ul li a:hover {
			color: <?php echo $c_header_hcolor; ?>;
		}

		#header-delta-main-navigation li a:before {
			background: <?php echo $c_header_hcolor; ?>;
		}

		/* Submenu's styles */
		@media (min-width: 900px) {
			<?php if (get_field('header_menu_2_level_background_color', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu {
					background-color: <?php the_field('header_menu_2_level_background_color', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_2_level_text_color', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > li > a {
					color: <?php the_field('header_menu_2_level_text_color', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_2_level_text_color_hover', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > li > a:hover {
					color: <?php the_field('header_menu_2_level_text_color_hover', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_2_level_bg_color_hover', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > li > a:hover {
					background-color: <?php the_field('header_menu_2_level_bg_color_hover', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_3_level_background_color', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > .menu-item-has-children > .sub-menu {
					background-color: <?php the_field('header_menu_3_level_background_color', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_3_level_text_color', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > .menu-item-has-children > .sub-menu > li > a {
					color: <?php the_field('header_menu_3_level_text_color', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_3_level_text_color_hover', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > .menu-item-has-children > .sub-menu > li > a:hover {
					color: <?php the_field('header_menu_3_level_text_color_hover', 'option'); ?>
				}
			<?php endif; ?>

			<?php if (get_field('header_menu_3_level_bg_color_hover', 'option')) : ?>
				#delta-menu > .menu-item-has-children > .sub-menu > .menu-item-has-children > .sub-menu > li > a:hover {
					background-color: <?php the_field('header_menu_3_level_bg_color_hover', 'option'); ?>
				}
			<?php endif; ?>
		}
		/* Submenu's styles END*/

/*
		header.delta-head .delta-menu-container ul .menu-item-has-children ul {
			background: <?php //echo $c_header_level; ?>;
		}

		header.delta-head .delta-menu-container ul .menu-item-has-children ul li a:hover {
			background: <?php //echo $c_header_hcolor; ?>;
		}
*/

		.mobile-nav {
			background: <?php echo $c_header_mobbg; ?>
		}

		#header-delta-mobile-navigation ul li a {
			color: <?php echo $c_header_color; ?>;
		}

		#header-delta-mobile-navigation ul li a:hover {
			color: <?php echo $c_header_hcolor; ?>;
		}

		#header-delta-mobile-navigation ul li .sub-menu li a:hover {
			color: <?php echo $c_header_hcolor; ?>;
		}

	</style>
<?php } ?>



<?php the_field('tracking_codes', 'option'); ?>
</body>
</html>
