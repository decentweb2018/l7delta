<?php

if(!post_password_required()) :

	$content = get_field( 'content' );

else :

	the_content();

endif;

if ( !empty( $content ) ):

	foreach ($content as $section):
		$layout_type = $section['acf_fc_layout'];

		if( 'hero_block' === $layout_type ){
			$component['component'] = $section['component'];
		}else{
			$component = $section['component'][0];
		}

		$component['layout_type'] = $layout_type;

		include( locate_template( 'template-parts/page-builder-sections/' . $layout_type . '.php' ) );

	endforeach;

endif;