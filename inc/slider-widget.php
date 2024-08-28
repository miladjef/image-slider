<?php

class HMIS_Widget extends WP_Widget{
    
    public function __construct() {
        parent::__construct(
                'hmis_widget',
                __('Slider', ' image-slider'),
                array(
                    'classname'     => 'hmis_image_slider_widget',
                    'description'   => __('Show slider from sliders', ' image-slider')
                )
            );
    }
    
    public function form($instance) {
        
        $title      = ( !isset($instance['title']) || $instance['title'] == '' ) ? __('Slider', ' image-slider') : $instance['title'];
        $slider_id  = ( !isset($instance['slider_id']) || $instance['slider_id'] == '' ) ? 0 : $instance['slider_id'];
        
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', ' image-slider');?></label><br>
    <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr( $title );?>"/>
</p>
<p>
    <label for="<?php echo $this->get_field_id('slider_id');?>"><?php _e('Select slider', ' image-slider');?></label>
    <select name="<?php echo $this->get_field_name('slider_id');?>" id="<?php echo $this->get_field_id('slider_id');?>">
        <option value="0" <?php selected($slider_id, 0);?>><?php _e('Select slider', ' image-slider');?></option>
        <?php
            $queryArgs = array(
                'post_type'     => ' image-slider',
                'post_per_page' => -1,
            );
            
            $theQuery = new WP_Query($queryArgs);
            if( $theQuery->have_posts() ):?>
            <?php while( $theQuery->have_posts() ): ?>
                <?php $theQuery->the_post();?>
                <option value="<?php the_ID();?>" <?php selected($slider_id, get_the_ID());?>><?php the_title();?></option>
            <?php endwhile;?>
            <?php endif;
            wp_reset_query();
            
        ?>
    </select>
</p>
        <?php
        
    }
    
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = wp_strip_all_tags($new_instance['title']);
        $instance['slider_id'] = absint($new_instance['slider_id']);
        return $instance;
    }
    
    public function widget($args, $instance) {
        
        extract($args);
        
        $title      = ( !isset($instance['title']) || $instance['title'] == '' ) ? __('Slider', ' image-slider') : $instance['title'];
        $slider_id  = ( !isset($instance['slider_id']) || $instance['slider_id'] == '' ) ? 0 : $instance['slider_id'];
        
        $uid = 'hmslider-widget-' . uniqid();

        global $hmis_slider_default_settings;
        $hmis_slide_setting = get_post_meta($slider_id, 'hmis_post_slides_settings', true);
        $hmis_slide_setting = is_array($hmis_slide_setting) ? $hmis_slide_setting : $hmis_slider_default_settings;

        $hmis_slide_setting['uid'] = $uid;
    
        $suffix = build_query($hmis_slide_setting);

        wp_enqueue_script('hmsliderimage-script-' . $uid, HMIS_JS . 'hmsliderimage-script.php?' . $suffix, array('jquery', 'billboard', 'swipe', 'easing'));
        
        echo $before_widget . $before_title . esc_html($title) . $after_title;
        
        hmis_get_slider($slider_id, $uid);
        
        echo $after_widget;
    }
    
}

add_action('widgets_init', function(){
    register_widget('HMIS_Widget');
});
