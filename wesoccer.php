<?php 

require_once 'vendor/autoload.php';
include ('settings.php');
/*
  Plugin Name: WeSoccer Virtual Pages
 */
    $client = new \GuzzleHttp\Client();
    
    function add_competition_pages() {
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
    
    function wesoccer_fixture_page_template( $page_template )
    {
        if ( is_page( 'wesoccer-fixture' ) ) {
            $page_template = dirname(__FILE__).'/wesoccer-fixture-template.php';
            
        }
        return $page_template;
    }
    
    add_filter( 'page_template', 'wesoccer_fixture_page_template' );
    
    function wesoccer_enqueue_page_template_styles() {
        if ( is_page( 'wesoccer-competition' ) ) {
            wp_enqueue_style( 'page-template', plugins_url('/assets/wesoccer.css',__FILE__ ));
            wp_enqueue_script( 'page-template', plugins_url('/assets/wesoccer.min.js',__FILE__ ));
        }

        if ( is_page( 'wesoccer-fixture' ) ) {
            wp_enqueue_style( 'page-template', plugins_url('/assets/wesoccer.css',__FILE__ ));
            wp_enqueue_script( 'page-template', plugins_url('/assets/wesoccer.min.js',__FILE__ ));
        }

    }
    add_action( 'wp_enqueue_scripts', 'wesoccer_enqueue_page_template_styles' );