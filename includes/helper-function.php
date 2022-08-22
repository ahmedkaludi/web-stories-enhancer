<?php

/**
 * Helper Functions
 *
 * @package     saswp
 * @subpackage  Helper/Templates
 * @copyright   Copyright (c) 2016, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.4.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) )
    exit;

/**
 * Helper method to check if user is in the plugins page.
 *
 * @author René Hermenau
 * @since  1.4.0
 *
 * @return bool
 */

/**
 * display deactivation logic on plugins page
 * 
 * @since 1.4.0
 */

add_filter('admin_footer', 'websten_add_deactivation_feedback_modal');
function websten_add_deactivation_feedback_modal() {

    if( !is_admin()) {
        return;
    }

    $current_user = wp_get_current_user();
    if( !($current_user instanceof WP_User) ) {
        $email = '';
    } else {
        $email = trim( $current_user->user_email );
    }
    require WEBSTEN_DIR_NAME ."/includes/deactivate-feedback.php";
}

/**
 * send feedback via email
 * 
 * @since 1.4.0
 */
function websten_send_feedback() {

    if( isset( $_POST['data'] ) ) {
        parse_str( $_POST['data'], $form );
    }

    $text = '';
    if( isset( $form['websten_disable_text'] ) ) {
        $text = implode( "\n\r", $form['websten_disable_text'] );
    }

    $headers = array();

    $from = isset( $form['websten_disable_from'] ) ? $form['websten_disable_from'] : '';
    if( $from ) {
        $headers[] = "From: $from";
        $headers[] = "Reply-To: $from";
    }

    $subject = isset( $form['websten_disable_reason'] ) ? $form['websten_disable_reason'] : '(no reason given)';

    if($subject == 'technical issue'){

          $text = trim($text);

          if(!empty($text)){

            $text = 'technical issue description: '.$text;

          }else{

            $text = 'no description: '.$text;
          }

    }

    $success = wp_mail( 'team@magazine3.in', $subject, $text, $headers );

    die();
}
add_action( 'wp_ajax_websten_send_feedback', 'websten_send_feedback' );


add_action('wp_print_scripts', 'websten_mb_js');
function websten_mb_js(){
   wp_enqueue_script('websten-make-better-js', WEBSTEN_PLUGIN_URI . 'assets/js/feedback.js', array( 'jquery' ));
}

add_action( 'admin_enqueue_scripts', 'websten_mb_css' );
function websten_mb_css() {
    wp_enqueue_style( 'websten-make-better-css', WEBSTEN_PLUGIN_URI . 'assets/css/feedback.css', false );   
}


add_action('wp_ajax_websten_subscribe_newsletter','websten_subscribe_for_newsletter');
add_action('wp_ajax_nopriv_websten_subscribe_newsletter','websten_subscribe_for_newsletter');
function websten_subscribe_for_newsletter(){
    $api_url = 'http://magazine3.company/wp-json/api/central/email/subscribe';
    $api_params = array(
        'name' => sanitize_text_field($_POST['name']),
        'email'=> sanitize_text_field($_POST['email']),
        'website'=> sanitize_text_field($_POST['website']),
        'type'=> 'websten'
    );
    $response = wp_remote_post( $api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
    $response = wp_remote_retrieve_body( $response );
    echo $response;
    die;
} 


