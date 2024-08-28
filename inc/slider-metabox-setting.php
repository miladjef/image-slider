<?php
    global $hmis_slider_default_settings;
    $hmis_slide_setting = get_post_meta($post->ID, 'hmis_post_slides_settings', true);
    $hmis_slide_setting = is_array($hmis_slide_setting) ? $hmis_slide_setting : $hmis_slider_default_settings;
?>
<div class="wrap" id="hmis_slider_settings">
    <p>
        <label for="hmis_setting_speed"><?php _e('Speed', 'image-slider');?></label>
        <input type="number" step="100" max="2000" id="hmis_setting_speed" name="hmis_setting_speed" value="<?php echo absint($hmis_slide_setting['speed']); ?>"/>
        <span class="description"><?php _e('Mili Second', 'image-slider'); ?></span>
    </p>
    <p>
        <label for="hmis_setting_duration"><?php _e('Duration', 'image-slider');?></label>
        <input type="number" step="100" max="60000" id="hmis_setting_duration" name="hmis_setting_duration" value="<?php echo absint($hmis_slide_setting['duration']); ?>"/>
        <span class="description"><?php _e('Mili Second - time wait between two slides ', 'image-slider'); ?></span>
    </p>
    <p>
        <label for="hmis_setting_autoplay"><?php _e('AutoPlay', 'image-slider');?></label>
        <input type="checkbox" value="1" name="hmis_setting_autoplay" id="hmis_setting_autoplay" <?php checked($hmis_slide_setting['autoplay'], true);?>/>
    </p>
    <p>
        <label for="hmis_setting_loop"><?php _e('Loop', 'image-slider');?></label>
        <input type="checkbox" value="1" name="hmis_setting_loop" id="hmis_setting_loop" <?php checked($hmis_slide_setting['loop'], true);?>/>
    </p>
<!--    <p>
        <label for="hmis_setting_autosize"><?php _e('AutoSize', 'image-slider');?></label>
        <input type="checkbox" value="1" name="hmis_setting_autosize" id="hmis_setting_autosize" <?php checked($hmis_slide_setting['autosize'], true);?>/>
    </p>-->
    <p>
        <label for="hmis_setting_resize"><?php _e('Resize', 'image-slider');?></label>
        <input type="checkbox" value="1" name="hmis_setting_resize" id="hmis_setting_resize" <?php checked($hmis_slide_setting['resize'], true);?>/>
    </p>
    <p>
        <label for="hmis_setting_stretch"><?php _e('Stretch', ' image-slider');?></label>
        <input type="checkbox" value="1" name="hmis_setting_stretch" id="hmis_setting_stretch" <?php checked($hmis_slide_setting['stretch'], true);?>/>
    </p>
    <p>
        <label for="hmis_setting_transition"><?php _e('Transition', ' image-slider');?></label>
        <select name="hmis_setting_transition">
            <option value="fade" <?php selected($hmis_slide_setting['transition'], 'fade') ?>><?php _e('Fade', ' image-slider');?></option>
            <option value="up" <?php selected($hmis_slide_setting['transition'], 'up') ?>><?php _e('Up', ' image-slider');?></option>
            <option value="right" <?php selected($hmis_slide_setting['transition'], 'right') ?>><?php _e('Right', ' image-slider');?></option>
            <option value="down" <?php selected($hmis_slide_setting['transition'], 'down') ?>><?php _e('Down', ' image-slider');?></option>
            <option value="left" <?php selected($hmis_slide_setting['transition'], 'left') ?>><?php _e('Left', ' image-slider');?></option>
        </select>
    </p>
    <p>
        <label for="hmis_setting_navtype"><?php _e('Navigation Type', 'image-slider');?></label>
        <select name="hmis_setting_navtype">
            <option value="list" <?php selected($hmis_slide_setting['navtype'], 'list') ?>><?php _e('List', ' image-slider');?></option>
            <option value="controls" <?php selected($hmis_slide_setting['navtype'], 'controls') ?>><?php _e('Controls', ' image-slider');?></option>
            <option value="both" <?php selected($hmis_slide_setting['navtype'], 'both') ?>><?php _e('Both', ' image-slider');?></option>
            <option value="none" <?php selected($hmis_slide_setting['navtype'], 'none') ?>><?php _e('None', ' image-slider');?></option>
        </select>
    </p>
    <p>
    <ul style="display: inline-block">
        <?php
            global $easingList ;
        ?>
        <?php foreach ($easingList as $ease):?>
        <li style="display: inline-block">
            <input type="radio" name="hmis_setting_easing" id="hmis_easing-<?php echo esc_attr($ease);?>" <?php checked($ease, $hmis_slide_setting['easing']);?> value="<?php echo esc_attr($ease);?>"/>
            <label for="hmis_easing-<?php echo esc_attr($ease);?>">
                <img title="<?php echo esc_attr($ease);?>" src="<?php echo HMIS_IMAGES . $ease . '.png';?>"/>
            </label>
        </li>
        <?php endforeach;?>
    </ul>
    </p>
</div>