<?php

/**
 * Plugin Name: Kayako Messenger
 * Plugin URI: 
 * Description: Add Kayako Messenger to your website from www.Kayako.com
 * Version: 1.0.0
 * Author: Kayako
 * Author URI:  https://www.kayako.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
 
if (!defined( 'ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('_KAYAKO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/* Core Functionality */
require_once( _KAYAKO_PLUGIN_PATH . "inc/admin.php" ); // Admin
require_once( _KAYAKO_PLUGIN_PATH . "inc/frontend.php" ); // Front-end

start_kayako();