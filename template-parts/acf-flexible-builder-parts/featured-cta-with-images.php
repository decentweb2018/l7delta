<?php 

$bg_color       = (get_sub_field('fcwi__bg_color')) ? get_sub_field('fcwi__bg_color') : '#ffffff';
$font_color     = (get_sub_field('fcwi__font_color')) ? get_sub_field('fcwi__font_color') : '#000000';
$padding_top    = (get_sub_field('fcwi__padding_top')) ? get_sub_field('fcwi__padding_top') : '0';
$padding_bottom = (get_sub_field('fcwi__padding_bottom')) ? get_sub_field('fcwi__padding_bottom') : '0';
$padding_images = (get_sub_field('fcwi__padding_for_images')) ? get_sub_field('fcwi__padding_for_images') : '0';
$margin_images  = (get_sub_field('fcwi__margin_between')) ? '' : 'column-padding-0';
$images         = get_sub_field('fcwi__images');

if(count($images) == 1){
  $column = 'column-100';
}elseif(count($images) == 2){
  $column = 'column-50';
}elseif(count($images) == 3){
  $column = 'column-33';
}else{
  return;
}

?>
 

<section class="fcwi">
  <div class="max-width-container row-flex <?php if(!get_sub_field('fcwi__margin_between')) { echo 'row-flex--no-padding'; } ?>">
    <?php if($images) : ?>
      <?php foreach($images as $image) : ?>
        <?php
          if(count($images) == 1){
            $picture = $image['fcwi__images_picture']['url'];
          }elseif(count($images) == 2){
            $picture = $image['fcwi__images_picture']['sizes']['large'];
          }elseif(count($images) == 3){
            $picture = $image['fcwi__images_picture']['sizes']['medium_large'];
          }else{
            return;
          }
        ?>
        <?php
          $link    = $image['fcwi__images_link'];
          $link_target = $image['fcwi__images_link_target'];
          $picture = $picture;
          $text    = $image['fcwi__images_text'];
          $text_color    = $image['fcwi__images_text_color'];   
          $overlay_color = ($image['fcwi__overlay_text_color']) ? $image['fcwi__overlay_text_color'] : '#ffffff';
          $overlay_opacity = $image['fcwi__overlay_text_opacity'];
          if($overlay_opacity == 100) {
            $overlay_opacity = '1';
          }else{
            $overlay_opacity = '0.' . $overlay_opacity;
          }
		  $padding_left = ($image['fcwi__image_padding_left']) ? "padding-left: {$image['fcwi__image_padding_left']}px;" : '';
		  $padding_right = ($image['fcwi__image_padding_right']) ? "padding-right: {$image['fcwi__image_padding_right']}px;" : '';
        ?>
        <div class="<?php echo $column; ?> <?php echo $margin_images; ?>">
          <div class="fcwi-item" style="<?php echo $padding_left; ?><?php echo $padding_right; ?>">
            <img src="<?php echo $picture; ?>" alt="<?php echo $text; ?>" class="img-responsive">
            <a 
              <?php if($link) : ?>href="<?php echo $link; ?>" <?php endif; ?>
              style="<?php if($text_color) : ?>color: <?php echo $text_color; ?>;<?php endif; ?>"
              <?php if($link_target) : ?>target="_blank"<?php endif; ?>
              class="fcwi-item__caption">
              <?php echo $text; ?>
            </a>
            <div class="overlay-wrap" style="<?php echo $padding_left; ?><?php echo $padding_right; ?>">
              <span class="overlay" style="background-color: <?php echo $overlay_color; ?>; opacity: <?php echo $overlay_opacity; ?>;"></span>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<style>
  .fcwi {
    padding-top: <?php echo $padding_top; ?>px;
    padding-bottom: <?php echo $padding_bottom; ?>px;
    background-color: <?php echo $bg_color; ?>;
    color: <?php echo $font_color; ?>;
  }
  .fcwi a {
    color: <?php echo $font_color; ?>;
  }
  .fcwi-item,
  .fcwi-item__caption,
  .overlay-wrap {
    padding: <?php echo $padding_images; ?>px;
  }
  .column-padding-0 {
	  padding: 0 !important;
  }
  @media (max-width: 900px) {
	  .row-flex--no-padding {
		  padding: 0 !important;
	  }
	  .img-responsive {
		  width: 100%;
	  }
  }
</style>