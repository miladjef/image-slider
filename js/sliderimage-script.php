<?php
header('Content-Type: application/javascript');
$uid = $_GET['uid'];
$transition = isset($_GET['transition']) ? $_GET['transition'] : 'fade';
$navType    = isset($_GET['navtype']) ? $_GET['navtype'] : 'controls';
$easing     = isset($_GET['easing']) ? $_GET['easing'] : 'easeInOutExpo';
$speed      = isset($_GET['speed']) ? intval($_GET['speed']) : 300;
$duration   = isset($_GET['duration']) ? intval($_GET['duration']) : 3000;
$stretch    = ( isset($_GET['stretch']) && $_GET['stretch'] == true ) ? 'true' : 'false';
$autoplay   = ( isset($_GET['autoplay']) && $_GET['autoplay'] == true ) ? 'true' : 'false';
$loop       = ( isset($_GET['loop']) && $_GET['loop'] == true ) ? 'true' : 'false';
$resize     = ( isset($_GET['resize']) && $_GET['resize'] == true ) ? 'true' : 'false';
$autosize   = ( isset($_GET['autosize']) && $_GET['autosize'] == true ) ? 'true' : 'false';
echo <<<JS
jQuery(document).ready(function($){
    $("#$uid").billboard({
        ease: "$easing", // animation ease of transitions
        speed: $speed, // duration of transitions in milliseconds
        duration: $duration, // time between slide changes
        autoplay: $autoplay, // whether slideshow should play automatically
        loop: $loop, // whether slideshow should loop (only applies if autoplay is true)
        transition: "$transition", // "fade", "up", "down", "left", "right"
        navType: "$navType", // "controls", "list", "both" or "none"
        styleNav: true, // applies default styles to nav
        includeFooter: true, // show/hide footer (contains caption and nav)
        //autosize: $autosize, // attempts to detect slideshow size automatically
        resize: $resize, // attempts to detect each slide's size automatically
        stretch: $stretch// stretch images to fill container
    });
});
JS;
