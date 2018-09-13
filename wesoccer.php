<?php namespace WeSoccer\VirtualPages;

/*
  Plugin Name: WeSoccer Virtual Pages
 */

require_once 'PageInterface.php';
require_once 'ControllerInterface.php';
require_once 'TemplateLoaderInterface.php';
require_once 'Page.php';
require_once 'Controller.php';
require_once 'TemplateLoader.php';
require_once 'vendor/autoload.php';

$controller = new Controller ( new TemplateLoader );

add_action( 'init', array( $controller, 'init' ) );

add_filter( 'do_parse_request', array( $controller, 'dispatch' ), PHP_INT_MAX, 2 );

add_action( 'loop_end', function( \WP_Query $query ) {
    if ( isset( $query->virtual_page ) && ! empty( $query->virtual_page ) ) {
        $query->virtual_page = NULL;
    }
} );

add_filter( 'the_permalink', function( $plink ) {
    global $post, $wp_query;
    if (
        $wp_query->is_page && isset( $wp_query->virtual_page )
        && $wp_query->virtual_page instanceof Page
        && isset( $post->is_virtual ) && $post->is_virtual
    ) {
        $plink = home_url( $wp_query->virtual_page->getUrl() );
    }
    return $plink;
} );

add_action( 'wesoccer_virtual_pages', function( $controller ) {
    // first page
    $client = new \GuzzleHttp\Client();
    $competitions = $client->get("http://wesoccer.test/api/v1/competition/43/fixtures");
    $competitions = json_decode($competitions->getBody(), TRUE);
    $html = "<div><ul>";
//    die(var_dump($competitions));
//    foreach ($competitions AS $fixtures) {
        foreach ($competitions AS $fixture) {
            $html .= "<li><a href='/wesoccer/fixture/{$fixture['id']}/events'>{$fixture['home_team_name']}-{$fixture['match_datetime']}-{$fixture['away_team_name']}</a></li>";
        }
//    }
    $html .= "</ul></div>";
    $controller->addPage( new \WeSoccer\VirtualPages\Page( '/wesoccer/competition/fixtures' ) )
        ->setTitle( 'Fixtures' )
            ->setContent($html)
        ->setTemplate( 'custom-page-form.php' );//this can be anything, it seems

    $fixture_ids = [];
    foreach ($competitions AS $fixture) {
        $fixture_ids[] = $fixture['id'];
    }
    $fixture_ids = implode(",", $fixture_ids);
    $html = "<div><ul>";
    $fixtures_events = $client->get("http://wesoccer.test/api/v1/fixture/{$fixture['id']}/events");
    foreach ($fixtures_events AS $fixture_id => $events) {
        $events = json_decode($events->getBody(), TRUE);
        foreach ($events AS $event) {
            $html .= "<li>{$event['event_type']}||{$event['time']['time']['minutes']}:{$event['time']['time']['seconds']}</li>";
        }
        $html .= "</ul></div>";
        $controller->addPage( new \WeSoccer\VirtualPages\Page( "/wesoccer/fixture/{$fixture_id}/events" ) )
        ->setTitle( 'My Second Custom Page' )
                ->setContent($html)
        ->setTemplate( 'custom-page-deep.php' );
    }
    // second pagec
    $controller->addPage( new \WeSoccer\VirtualPages\Page( '/custom/page/deep' ) )
        ->setTitle( 'My Second Custom Page' )
        ->setTemplate( 'custom-page-deep.php' );

} );
