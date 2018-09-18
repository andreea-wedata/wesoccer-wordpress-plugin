<?php
function wesoccer_settings_init() {
    register_setting( 'wesoccer', 'wesoccer_competition_ids' );
    register_setting( 'wesoccer', 'wesoccer_token' );

    add_settings_section(
    'wesoccer_section_developers',
    __( 'Settings for the WeSoccer plugin.', 'wesoccer' ),
    'wesoccer_section_developers_cb',
    'wesoccer'
    );

    add_settings_field(
    'wesoccer_field_competitions', // as of WP 4.6 this value is used only internally
    // use $args' label_for to populate the id inside the callback
    __( 'Competition IDs', 'wesoccer' ),
    'wesoccer_field_competitions_cb',
    'wesoccer',
    'wesoccer_section_developers',
    [
    'label_for' => 'wesoccer_field_competitions',
    'class' => 'wesoccer_row',
    'wesoccer_custom_data' => 'custom',
    ]
    );

    add_settings_field(
    'wesoccer_field_wesoccer_token', // as of WP 4.6 this value is used only internally
    // use $args' label_for to populate the id inside the callback
    __( 'WeSoccer API Token', 'wesoccer' ),
    'wesoccer_field_wesoccer_token_cb',
    'wesoccer',
    'wesoccer_section_developers',
    [
    'label_for' => 'wesoccer_field_wesoccer_token',
    'class' => 'wesoccer_row',
    'wesoccer_custom_data' => 'custom',
    ]
    );
}
/**
 * register our wesoccer_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wesoccer_settings_init' );

function wesoccer_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Some instructions.', 'wesoccer' ); ?></p>
 <?php
}

function wesoccer_field_competitions_cb( $args ) {
 $options = get_option( 'wesoccer_competition_ids' );
 ?>
 <input type="text"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        data-custom="<?php echo esc_attr( $args['wesoccer_custom_data'] ); ?>"
        name="wesoccer_competition_ids[<?php echo esc_attr( $args['label_for'] ); ?>]"/>
 <p>
     
 </p>
 <p class="description">
 <?php esc_html_e( 'Competition IDs, separated by comma. Example: 12,34,567', 'wesoccer' ); ?>
 </p>
 <?php
}
function wesoccer_field_wesoccer_token_cb( $args ) {
 $options = get_option( 'wesoccer_token' );
 ?>
 <input type="text"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        data-custom="<?php echo esc_attr( $args['wesoccer_custom_data'] ); ?>"
        name="wesoccer_token[<?php echo esc_attr( $args['label_for'] ); ?>]"
        value="<?php echo get_option('wesoccer_token')[0] ?>"/>
 <p class="description">
 <?php esc_html_e( 'The token to allow you access to the WeSoccer endpoints.', 'wesoccer' ); ?>
 </p>
 <?php
}

function wesoccer_options_page() {
 // add top level menu page
 add_menu_page(
 'WeSoccer',
 'WeSoccer Options',
 'manage_options',
 'wesoccer',
 'wesoccer_options_page_html'
 );
}

add_action( 'admin_menu', 'wesoccer_options_page' );

function wesoccer_options_page_html() {
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 if ( isset( $_GET['settings-updated'] ) ) {
 add_settings_error( 'wesoccer_messages', 'wesoccer_message', __( 'Settings Saved', 'wesoccer' ), 'updated' );
 }
 settings_errors( 'wesoccer_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 settings_fields( 'wesoccer' );
 do_settings_sections( 'wesoccer' );
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}