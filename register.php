<?php
/*
Plugin Name: Register
Description: Register
Version: 1.0
Author: Yash Gondaliya
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin directory constant.
define( 'CUSTOM_FORM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Include required class files.
require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-register.php';

// Initialize the plugin.
function custom_form_plugin_init() {
    $plugin = new CFP_Register();
    $plugin->load_class_files();
}
custom_form_plugin_init();

// Enqueue frontend styles.
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'my-plugin-style', plugin_dir_url( __FILE__ ) . 'style.min.css' );
});
