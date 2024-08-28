<?php

function hmis_no_slider(){
    ?>
    <div id="hmis-image-slider-<?php echo uniqid();?>">
        <ul>
            <li title="<?php esc_attr_e('No slider selected', 'image-slider'); ?>"><a href="#"><img src="<?php echo HMIS_NO_IMAGE;?>"></a></li>
        </ul>
   </div>
    <?php
}

function hmis_get_slider( $slider_id, $uid ){
    
    if ( $slider_id == 0 ) {
        hmis_no_slider();
        return;
    }
    
    $queryArgs = array(
        'post_type'     => 'image-slider',
        'post_per_page' => 1,
        'p'             => $slider_id,
    );
    
    $the_query = new WP_Query($queryArgs);
    
    if( $the_query->have_posts() ):?>
    <?php while( $the_query->have_posts() ):?>
    <?php
        $the_query->the_post();
        $hmis_slides = get_post_meta(get_the_ID(), 'hmis_post_slides', true);
    ?>
    <div class="hmis-billboard-slider" id="<?php echo $uid;?>">
        <ul>
            <?php if(is_array($hmis_slides)):?>
            <?php foreach( $hmis_slides as $slide ):?>
            <li title="<?php echo esc_attr($slide['caption']);?>"><a href="<?php echo esc_url($slide['url']);?>"><img src="<?php echo esc_url($slide['image']);?>"></a></li>
            <?php endforeach;?>
            <?php else:?>
            <?php hmis_no_slider();return;?>
            <?php endif;?>
        </ul>
    </div>
    <?php endwhile;?>
    <?php else:?>
    <?php hmis_no_slider();return;?>
    <?php endif;
    wp_reset_postdata();
}