<?php
/**
 * Template Name: ACF Flexible Builder
 * Template Post Type: portfolio
 */
get_header();
?>

<?php 
global $post;

$id = $post->ID;

//echo '<pre>';
//print_r($plugin_dir . 'template-parts/acf-flexible-builder-parts/text.php');
//echo '</pre>';

?>

<!-- ACF Flexible Builder -->
<?php

if (have_rows('acf_flexible_builder', $id)) :

    #Container
    echo '<div class="acf-flexible-builder">';

    #Loop
    while (have_rows('acf_flexible_builder', $id)) : the_row();

        #hero
        if (get_row_layout() == 'hero') :

			get_template_part('template-parts/acf-flexible-builder-parts/hero');

        elseif( get_row_layout() == 'text' ): 

			get_template_part('template-parts/acf-flexible-builder-parts/text');

        elseif( get_row_layout() == 'fullwidth_cta' ):

			get_template_part('template-parts/acf-flexible-builder-parts/fullwidth-cta');

		elseif( get_row_layout() == 'fullwidth_image' ):

			get_template_part('template-parts/acf-flexible-builder-parts/fullwidth-image');

		elseif( get_row_layout() == 'grid' ):

			get_template_part('template-parts/acf-flexible-builder-parts/grid');

		elseif( get_row_layout() == 'form' ):

			get_template_part('template-parts/acf-flexible-builder-parts/form');

		elseif( get_row_layout() == 'notification' ):

			get_template_part('template-parts/acf-flexible-builder-parts/notification');

		elseif( get_row_layout() == 'logos' ):

			get_template_part('template-parts/acf-flexible-builder-parts/logos');

		elseif( get_row_layout() == 'featured_cta_with_images' ):

			get_template_part('template-parts/acf-flexible-builder-parts/featured-cta-with-image');

		elseif( get_row_layout() == 'featured_cta_s' ):

			get_template_part('template-parts/acf-flexible-builder-parts/featured-cta-s');

        endif;

    endwhile;

    #Container
    echo '</div>';

endif;

?>

<?php 
get_footer();