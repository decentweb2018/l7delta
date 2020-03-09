<?php
/**
 * Template Name: FAQ Page
 *
 * @package _l7_theme
 */

get_header(); ?>

<?php
/**
 * Template Name: Layer Builder
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _l7_theme
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

    <div class="max-width-container">
      <div class="qa-container">


		<?php while ( have_posts() ) : the_post(); ?>




      <?php

      // check if the repeater field has rows of data
      if( have_rows('faq_block') ):

       	// loop through the rows of data
          while ( have_rows('faq_block') ) : the_row(); ?>


              <div class="qa_element">
                <div class="qa_question">
                  <?php the_sub_field('question');?>
                  <div class="qa_answer">
                    <?php the_sub_field('answer'); ?>
                  </div>
                </div>
              </div>

          <?php endwhile;

      else :

          // no rows found

      endif;

      ?>
      </div>
    </div>



		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $('.qa_question').click(function() {
      $(this).find('.qa_answer').slideToggle();
    }); //click
  }); //end ready
</script>
<?php get_footer(); ?>
