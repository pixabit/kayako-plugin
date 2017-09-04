<?php

if (!defined( 'ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Initializes Kayako
 */
function start_kayako() {

    add_action('wp_footer', 'kayako_embed_code', 100);
    add_action('wp_footer', 'kayako_user_init', 101);

}

/**
 * Embeds the Kayako Javascript Snippet
 */
function kayako_embed_code() {
    
    $code = get_option('_kayako_embed_code');
    
    if ( !empty($code) ) {
        echo json_decode($code);
    }
 
}

/**
 * Initializes a user with Kayako
 */
function kayako_user_init() {
    
    if ( is_user_logged_in() ) {
        
        $code = get_option('_kayako_embed_code');
        $user_init = get_option('_kayako_user_init');
        $token = get_option('_kayako_token');
    
        if ( $user_init == 1 && !empty($token) && !empty($code) ) {
            
            global $current_user;
            
            $timestamp = time();
            $email = $current_user->user_email;
            
            if ( $current_user->user_firstname && $current_user->user_lastname ) {
                $name = $current_user->user_firstname . " " . $current_user->user_lastname;
            } elseif ( $current_user->user_firstname ) {
                $name = $current_user->user_firstname;
            } else {
                $name = $current_user->user_login;
            }
            
            $signature = kayako_create_signature( $name, $email, $token, $timestamp );
            
            if ( !empty($signature) ) {

                echo "<script>kayako.ready(function () {
                        kayako.identify('{$name}', '{$email}', '{$signature}', '{$timestamp}')
                      })</script>";
                
            }
        }
        
    }
 
}

/**
 * Generates signature to sign data to Kayako
 *
 * @param string name
 * @param string email
 * @param string token
 * @param int timestamp
 *
 * @return string signature
 */
function kayako_create_signature( $name, $email, $token, $timestamp ) {

    if( empty($name) ) return false;
    if( empty($email) ) return false;
    if( empty($token) ) return false;
    if( empty($timestamp) ) return false;
        
    $signature = hash_hmac('sha256', ($name . $email . $token . $timestamp), $token);
        
    return $signature;
    
}