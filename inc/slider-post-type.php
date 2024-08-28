<?php

add_action('init', 'hmis_add_slider_post_type');

function hmis_add_slider_post_type() {

    $labels = array(
        'name' => _x('Sliders', 'post type general name', ' image-slider'),
        'singular_name' => _x('Slider', 'post type singular name', ' image-slider'),
        'menu_name' => _x('Sliders', 'admin menu', ' image-slider'),
        'name_admin_bar' => _x('Slider', 'add new on admin bar', ' image-slider'),
        'add_new' => _x('Add New', 'slider', ' image-slider'),
        'add_new_item' => __('Add New Slider', ' image-slider'),
        'new_item' => __('New Slider', ' image-slider'),
        'edit_item' => __('Edit Slider', ' image-slider'),
        'view_item' => __('View Slider', ' image-slider'),
        'all_items' => __('All Sliders', ' image-slider'),
        'search_items' => __('Search Sliders', ' image-slider'),
        'not_found' => __('No sliders found.', ' image-slider'),
        'not_found_in_trash' => __('No sliders found in Trash.', ' image-slider')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', ' image-slider'),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'excerpt'),
        'register_meta_box_cb' => 'hmis_slider_metabox'
    );

    register_post_type(' image-slider', $args);

    //Register Taxonomy
    $labels = array(
        'name' => _x('Subjects', 'taxonomy general name', ' image-slider'),
        'singular_name' => _x('Subject', 'taxonomy singular name', ' image-slider'),
        'search_items' => __('Search Subjects', ' image-slider'),
        'popular_items' => __('Popular Subjects', ' image-slider'),
        'all_items' => __('All Subjects', ' image-slider'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Subject', ' image-slider'),
        'update_item' => __('Update Subject', ' image-slider'),
        'add_new_item' => __('Add New Subject', ' image-slider'),
        'new_item_name' => __('New Subject Name', ' image-slider'),
        'separate_items_with_commas' => __('Separate subjects with commas', ' image-slider'),
        'add_or_remove_items' => __('Add or remove subjects', ' image-slider'),
        'choose_from_most_used' => __('Choose from the most used subjects', ' image-slider'),
        'not_found' => __('No subjects found.', ' image-slider'),
        'menu_name' => __('Subjects', ' image-slider'),
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'subject'),
    );

    register_taxonomy('slider-subject', ' image-slider', $args);
    
}

function hmis_slider_metabox(){
    
    wp_register_script('lightboxme', HMIS_JS . 'jquery.lightbox_me.js', array('jquery'));
    wp_enqueue_script('hmis-metabox-script', HMIS_JS . 'metabox-script.js', array('jquery', 'lightboxme', 'media-upload', 'thickbox'));
    wp_localize_script('hmis-metabox-script', 'hmis_data', array(
        'tb_title'          => __('Select Image', ' image-slider'),
        'edit'              => __('Edit', ' image-slider'),
        'insert'              => __('Insert', ' image-slider'),
        'default_image_url' => HMIS_IMAGES . 'select.png',
        'no_image_select'   => __('No image selected', ' image-slider'),
    ));
    //wp_enqueue_style('thickbox');
    wp_enqueue_style('hmis-metabox-style', HMIS_CSS . 'metabox-style.css', array('thickbox'));
    
    add_meta_box('hmis-metabox', __('Slides', ' image-slider'), function( $post ){ include(HMIS_INC . 'slider-metabox.php');}, null, 'advanced');
    
    
    add_meta_box('hmis-metabox_slider_setting', __('Slider Setting', ' image-slider'), function($post){ include(HMIS_INC . 'slider-metabox-setting.php');}, null, 'advanced');
    
    add_meta_box('metabox_slider_how_use', __('Slider how use', ' image-slider'), function($post){ include(HMIS_INC . 'slider-metabox-how-use.php');}, null, 'side');
    
}

add_action('save_post', 'hmis_save_slides');
add_action('edit_post', 'hmis_save_slides');
function hmis_save_slides( $post_id ){
    
    if( !isset($_POST['hmis_slide_images']) )
        return;
    
    if( !current_user_can('edit_posts') )
        return;
    
    $hmis_slides = array();
    
    //wp_die( '<pre class="ltr left-align">' . print_r($_POST, true) . '</pre>' );
    
    for($i = 0; $i < count( $_POST['hmis_slide_images'] ); $i++){
        $hmis_slides[$i]['image'] = esc_url_raw($_POST['hmis_slide_images'][$i]);
        $hmis_slides[$i]['caption'] = sanitize_text_field($_POST['hmis_slide_captions'][$i]);
        $hmis_slides[$i]['url'] = esc_url_raw($_POST['hmis_slide_urls'][$i]);
    }
    
    global $hmis_slider_default_settings, $easingList;
    $hmis_slider_settings = array(
        'speed'         => absint($_POST['hmis_setting_speed']) > 0 ? absint($_POST['hmis_setting_speed']) : $hmis_slider_default_settings['speed'],
        'duration'      => absint($_POST['hmis_setting_duration']) > 0 ? absint($_POST['hmis_setting_duration']) : $hmis_slider_default_settings['duration'],
        'autoplay'      => isset($_POST['hmis_setting_autoplay']) ? true : false,
        'resize'        => isset($_POST['hmis_setting_resize']) ? true : false,
        'stretch'       => isset($_POST['hmis_setting_stretch']) ? true : false,
        'loop'          => isset($_POST['hmis_setting_loop']) ? true : false,
        //'autosize'      => isset($_POST['hmis_setting_autosize']) ? true : false,
        'transition'    => in_array($_POST['hmis_setting_transition'], array('up', 'down','left', 'right','fade')) ? sanitize_text_field($_POST['hmis_setting_transition']) : $hmis_slider_default_settings['transition'] ,
        'navtype'       => in_array($_POST['hmis_setting_navtype'], array('list', 'controls','both', 'none')) ? sanitize_text_field($_POST['hmis_setting_navtype']) : $hmis_slider_default_settings['navtype'],
        'easing'        => in_array($_POST['hmis_setting_easing'], $easingList) ? sanitize_text_field($_POST['hmis_setting_easing']) : $hmis_slider_default_settings['easing']
    );
    
    update_post_meta($post_id, 'hmis_post_slides', $hmis_slides);
    update_post_meta($post_id, 'hmis_post_slides_settings', $hmis_slider_settings);;
    
}

add_filter('manage_ image-slider_posts_columns', function($columns){
    $columns['slider_excerpt'] = __('Excerpt', ' image-slider');
    return $columns;
});

add_action('manage_ image-slider_posts_custom_column', function( $column, $post_id){
    if( $column == 'slider_excerpt' ){
        $post = get_post($post_id);
        echo $post->post_excerpt;
    }
}, 10, 2);