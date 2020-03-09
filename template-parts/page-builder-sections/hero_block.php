<section class="<?php
l7_pb::component_class( $component );
if( !empty($section['full_height']) ){
    echo ' full-height';
}
?>">
	<?php
	foreach ( $component['component'] as $slide ) { ?>
        <div class="hero-slide" style="<?php l7_pb::background_style( $slide['background'][0] ); ?>">

			<?php if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) { ?>
                <div style="display: none;"><?php print_r( $slide ); ?></div>
			<?php } ?>
            <div class="max-width-container">
                <div class="content-container">
                    <h1>
						<?php
						echo l7_pb::secondary_color( $slide['heading'] );
						?>
                    </h1>
                    <div class="content">
						<?php
						echo apply_filters( 'the_content', $slide['content'] );
						?>
                    </div>
                </div>
            </div>
			<?php l7_pb::overlay_bg( $slide['background'][0] ) ?>
			<?php l7_pb::parallax_bg( $slide['background'][0] ) ?>
			<?php l7_pb::background_video( $slide['background'][0] ) ?>
        </div>
		<?php
	}
	?>
</section>