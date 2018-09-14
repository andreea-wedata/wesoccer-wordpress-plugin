<?php

require_once 'vendor/autoload.php';

function wesoccer_fixture_display_shortcode() {
   $a = shortcode_atts(
           [
               'id' => null
           ],
           $atts);
   return 'Hello ' . $a['id'] . '!';
}

add_shortcode( 'helloworld', 'wesoccer_fixture_display_shortcode' );