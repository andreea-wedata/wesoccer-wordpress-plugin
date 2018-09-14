<?php 

require_once 'vendor/autoload.php';
include( dirname(__FILE__) . '/shortcode-fixture-display.php' );
/*
  Plugin Name: WeSoccer Virtual Pages
 */
    $client = new \GuzzleHttp\Client();
//    $competitions = $client->get("http://wesoccer.test/api/v1/competition/43/fixtures");
//    $fixtures_events = $client->get("http://wesoccer.test/api/v1/fixture/{$dummy_id}/events");
    
    function add_competition_pages() {
        $competitions = [
            'swfl1' => 'SWFL 1',
            'swfl2' => 'SWFL 2'
        ];
        
        //create the competition page
        $competition_page = [
            'post_title'    => wp_strip_all_tags('wesoccer competition'),
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        ];
        wp_insert_post( $competition_page );
        
        //create the fixture page
        $fixture_page = [
            'post_title'    => wp_strip_all_tags('wesoccer fixture'),
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        ];
        wp_insert_post( $fixture_page );
    }

    register_activation_hook(__FILE__, 'add_competition_pages');
    
    function wesoccer_page_template( $page_template )
    {
        if ( is_page( 'wesoccer-competition' ) ) {
            $page_template = dirname(__FILE__).'/wesoccer-competition-template.php';
            
        }
        return $page_template;
    }
    
    add_filter( 'page_template', 'wesoccer_page_template' );
    
    function wesoccer_enqueue_page_template_styles() {
        if ( is_page( 'wesoccer-competition' ) ) {
            wp_enqueue_style( 'page-template', plugins_url('/assets/wesoccer.css',__FILE__ ));
        }
    }
    add_action( 'wp_enqueue_scripts', 'wesoccer_enqueue_page_template_styles' );