<?php $hmis_slides = get_post_meta($post->ID, 'hmis_post_slides', true);?>
<div class="wrap" id="hmis-metabox">
    <div id="hmis-lightbox-data">
        <p class="image-container">
            <img src="<?php echo HMIS_IMAGES . 'select.png';?>" class="not-selected" width="200" height="200"/>
        </p>
        <p>
            <label for="hmis-select-caption"><?php _e('Caption', ' image-slider');?></label><br>
            <input type="text" id="hmis-select-caption" class="text-field" value=""/>
        </p>
        <p>
            <label for="hmis-select-url"><?php _e('Url', ' image-slider');?></label><br>
            <input type="text" id="hmis-select-url" class="text-field ltr left-align" value=""/>
        </p>
        <p>
            <input type="hidden" id="hmis-current-slide" value="0"/>
            <input type="button" value="<?php _e('Insert', ' image-slider'); ?>" class="hmis-action-insert button button-primary"/>
            <input type="button" value="<?php _e('Cancel', ' image-slider'); ?>" class="hmis-action-cancel button button-secondary"/>
        </p>
    </div>
    <ul>
        <?php if(is_array($hmis_slides)):?>
            <?php $i = 1; foreach( $hmis_slides as  $slide):?>
        <li class="slide" title="<?php echo esc_attr($slide['caption']);?>" data-slide="<?php echo $i;?>" data-content="<?php _e('Edit', ' image-slider');?>">
                <img src="<?php echo esc_url($slide['image']);?>"/>
                <input type="hidden" name="hmis_slide_images[]" value="<?php echo esc_url($slide['image']);?>"/>
                <input type="hidden" name="hmis_slide_captions[]" value="<?php echo esc_attr($slide['caption']);?>"/>
                <input type="hidden" name="hmis_slide_urls[]" value="<?php echo esc_url($slide['url']);?>"/>
            </li>
            <?php $i++;endforeach;?>
        <?php endif;?>
        <li style="font-size: 150px; border: none;" class="hmis-add-slide">
            +
        </li>
    </ul>
</div>
