<?php
/*
 * Plugin Name:  Image Slider
 * Plugin URI: http://example.com/plugins/image-slider
 * Author: miladjef
 * Author URI: 
 * Version: 1.0.0
 * Description: A simple slider using in shortcode and widgets
 * Licence: GPLv2
 * Text Domain:  image-slider
 * Domain Path: /languages
 */
/*
This is plugin is for simple slider as widget and shortcode
Copyright (C) 2023  miladjef

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

defined('ABSPATH') || exit;

add_action( 'plugins_loaded', 'hmis_load_text_domain' );
function hmis_load_text_domain(){
    load_plugin_textdomain('image-slider', false, basename(plugin_dir_path(__FILE__)) . '/languages/');
}

define('HMIS_INC', plugin_dir_path(__FILE__) . 'inc/');
define('HMIS_JS', plugin_dir_url(__FILE__) . 'js/');
define('HMIS_CSS', plugin_dir_url(__FILE__) . 'css/');
define('HMIS_IMAGES', plugin_dir_url(__FILE__) . 'images/');

define('HMIS_NO_IMAGE', HMIS_IMAGES . 'no-image.jpg');

global $hmis_slider_default_settings;
$hmis_slider_default_settings = array(
        'speed'         => 600,
        'duration'      => 5000,
        'autoplay'      => true,
        'resize'        => true,
        'stretch'       => true,
        'loop'          => true,
        //'autosize'      => true,
        'transition'    => 'fade',
        'navtype'       => 'controls',
        'easing'        => 'easeInOutExpo'
    );

global $easingList;
$easingList = array(
                'easeInBack',
                'easeInBounce',
                'easeInCirc',
                'easeInCubic',
                'easeInElastic',
                'easeInExpo',
                'easeInOutBack',
                'easeInOutBounce',
                'easeInOutCirc',
                'easeInOutCubic',
                'easeInOutElastic',
                'easeInOutExpo',
                'easeInOutQuad',
                'easeInOutQuart',
                'easeInOutQuint',
                'easeInOutSine',
                'easeInQuad',
                'easeInQuart',
                'easeInQuint',
                'easeInSine',
                'easeOutBack',
                'easeOutBounce',
                'easeOutCirc',
                'easeOutCubic',
                'easeOutElastic',
                'easeOutExpo',
                'easeOutQuad',
                'easeOutQuart',
                'easeOutQuint',
                'easeOutSine',
                'linear',
                'swing',
                );

include(HMIS_INC . 'slider-post-type.php');
include(HMIS_INC . 'functions.php');
include(HMIS_INC . 'shortcodes.php');
include(HMIS_INC . 'hmslider-widget.php');