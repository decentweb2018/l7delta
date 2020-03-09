<section class="<?php l7_pb::component_class( $component ); ?> <?php l7_pb::animate_classes( $component['animate_options'][0] ); ?>" style="<?php l7_pb::background_style( $component['background'][0] ); ?>">
	<div class="max-width-container">
		<div class="qa_block">
      <?php

      // check if the repeater field has rows of data
      if( have_rows('qa_element') ):

       	// loop through the rows of data
          while ( have_rows('qa_element') ) : the_row();

              // display a sub field value
              the_sub_field('qa_question');
              the_sub_field('qa_answer');

          endwhile;

      else :

          // no rows found

      endif;

      ?>

		</div>
	</div>
</section>
