<?php

// If uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Delete Previously Setup Options
if ( get_option('_kayako_embed_code') !== false ) {
    delete_option('_kayako_embed_code');
}
if ( get_option('_kayako_token') !== false ) {
    delete_option('_kayako_token');
}
if ( get_option('_kayako_user_init') !== false ) {
    delete_option('_kayako_user_init');
}