<?php

$blocks         = get_sub_field('fcs_blocks');

?>

<section class="featured-cta-s">
  <div class="fcs-row">
    <?php if($blocks) : $i = 1; ?>
      <?php foreach($blocks as $block) : ?>
        <?php
          $overlay_opacity = $block['fcs__overlay_opacity'];
            if($overlay_opacity == 100) {
              $overlay_opacity = '1';
            }else{
              $overlay_opacity = '0.' . $overlay_opacity;
          }
          $fcs__open_link_new_tab = $block['fcs__open_link_new_tab'];
        ?>
        <div class="fcs-item"
          style="
            <?php if($block['fcs__bg_color']) { 
              echo "background-color: {$block['fcs__bg_color']};"; 
            } ?>
            <?php if($block['fcs__bg_image']) { 
              echo "background-image: url({$block['fcs__bg_image']});"; 
            } ?>
          ">
         
          <h3 class="fcs-item__title" 
            style="
              <?php if($block['fcs__title_color']) { 
                echo "color: {$block['fcs__title_color']}"; 
              } ?>
            ">
            <?php echo $block['fcs__title']; ?>
          </h3>
          
          <p class="fcs-item__description"
            style="
              <?php if($block['fcs__description_color']) { 
                echo "color: {$block['fcs__description_color']}"; 
              } ?>
            ">
            <?php echo $block['fcs__description']; ?>
          </p>
          
            <a class="fcs-item__overlay" href="<?php if($block['fcs__link_url']) { echo $block['fcs__link_url']; } ?>"
              style="
                <?php if($block['fcs__link_color']) { 
                  echo "color: {$block['fcs__link_color']}"; 
                } ?>
              "
              <?php if($fcs__open_link_new_tab) : ?>
                target="_blank"
              <?php endif; ?>
              >
              <span><?php if($block['fcs__link_text']) { echo $block['fcs__link_text']; } ?></span>
            </a>
            <div class="fcs-item__overlay-block fcs-item__overlay-block--<?php echo $i; ?>"
              style="
                <?php if($block['fcs__overlay_color']) { 
                  echo "background-color: {$block['fcs__overlay_color']};"; 
                } ?>
              ">
            </div>
          
        </div>
        <style>
          .fcs-item:hover .fcs-item__overlay-block--<?php echo $i; ?> {
            opacity: <?php echo $overlay_opacity; ?>;
          }
        </style>
      <?php $i++; endforeach; ?>
    <?php endif; ?>
  </div>
</section>
<style>
  .fcs-item__title {
    padding: 0;
    margin-bottom: 15px;
    font-size: 1.4em;
    line-height: 1.2em;
    font-weight: 600;
  }
  .fcs-item__description {
    padding: 0;
    margin-bottom: 18px;
  }
  
  .fcs-row {
    display: flex;
    flex-wrap: wrap;
  }
  .fcs-item {
    position: relative;
    padding: 50px;
    width: 33.333333%;
    flex: 0 0 33.33333%;
    background-repeat: no-repeat;
    background-position: right bottom;
  }
  @media (max-width: 900px) {
    .fcs-item {
      width: 100%;
      flex: 0 0 100%;
    }
  }
  .fcs-item__overlay {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    opacity: 0;
    text-align: center;
    position: absolute;
    top: 0;
    left: 0;
    transition: 0.4s;
    z-index: 100;
    font-size: 1.6em;
    line-height: 1.2em;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
  }
  .fcs-item:hover .fcs-item__overlay {
    opacity: 1;
  }
  .fcs-item__overlay-block {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    top: 0;
    left: 0;
    transition: 0.4s;
    z-index: 50;
  }
  
</style>