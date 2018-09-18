<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function wesoccer_settings_init() {
 // register a new setting for "wesoccer" page
 register_setting( 'wesoccer', 'wesoccer_options' );
 
 // register a new section in the "wesoccer" page
 add_settings_section(
 'wesoccer_section_developers',
 __( 'Settings for the WeSoccer plugin.', 'wesoccer' ),
 'wesoccer_section_developers_cb',
 'wesoccer'
 );
 
 // register a new field in the "wesoccer_section_developers" section, inside the "wesoccer" page
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
}
 
/**
 * register our wesoccer_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wesoccer_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function wesoccer_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wesoccer' ); ?></p>
 <?php
}
 
// pill field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function wesoccer_field_competitions_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'wesoccer_options' );
 // output the field
 ?>
 <input type="text"
        id="<?php echo esc_attr( $args['label_for'] ); ?>"
        data-custom="<?php echo esc_attr( $args['wesoccer_custom_data'] ); ?>"
        name="wesoccer_options[<?php echo esc_attr( $args['label_for'] ); ?>]"/>
<!-- <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['wesoccer_custom_data'] ); ?>"
 name="wesoccer_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'wesoccer' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'wesoccer' ); ?>
 </option>
 </select>-->
 <p class="description">
 <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wesoccer' ); ?>
 </p>
 <p class="description">
 <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wesoccer' ); ?>
 </p>
 <?php
}
 
/**
 * top level menu
 */
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
 
/**
 * register our wesoccer_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wesoccer_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function wesoccer_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'wesoccer_messages', 'wesoccer_message', __( 'Settings Saved', 'wesoccer' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'wesoccer_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wesoccer"
 settings_fields( 'wesoccer' );
 // output setting sections and their fields
 // (sections are registered for "wesoccer", each field is registered to a specific section)
 do_settings_sections( 'wesoccer' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}