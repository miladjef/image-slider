<?php

add_action('wp_enqueue_scripts', function(){
    
    wp_register_script('swipe', HMIS_JS . 'jquery.event.swipe.js', array('jquery'));
    wp_register_script('billboard', HMIS_JS . 'jquery.billboard.js', array('jquery', 'swipe'));
    wp_register_script('easing', HMIS_JS . 'jquery.easing.min.js', array('jquery'));
    
    wp_register_style('billboard', HMIS_CSS . 'jquery.billboard.css');
    wp_enqueue_style('billboard');
    
});

add_action('init', 'hmis_slider_shortcode');
function hmis_slider_shortcode(){
    add_shortcode('hmslider', 'hmis_slider_shortocde_callback');
}

function hmis_slider_shortocde_callback($atts, $content = null){
    extract(shortcode_atts(array(
        'id' => 0,
    ), $atts));
    
    $uid = 'hmslider-shortcode-' . uniqid();
    
    global $hmis_slider_default_settings;
    $hmis_slide_setting = get_post_meta($id , 'hmis_post_slides_settings', true);
    $hmis_slide_setting = is_array($hmis_slide_setting) ? $hmis_slide_setting : $hmis_slider_default_settings;
    
    $hmis_slide_setting['uid'] = $uid;
    
    $suffix = build_query($hmis_slide_setting);
    
    wp_enqueue_script('hmsliderimage-script-' . $uid, HMIS_JS . 'hmsliderimage-script.php?' . $suffix, array('jquery', 'billboard', 'swipe', 'easing'));
    
    ob_start();
    hmis_get_slider( $id , $uid);
    return ob_get_clean();
}