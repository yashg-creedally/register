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
require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-form.php';
require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-input-field.php';
require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-admin.php';

// Initialize the plugin.
function custom_form_plugin_init() {
    $plugin = new CFP_Register();
    $plugin->run();
}
custom_form_plugin_init();

// Enqueue frontend styles.
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'my-plugin-style', plugin_dir_url( __FILE__ ) . 'style.min.css' );
});

// Add additional form fields via filter hook.
add_filter( 'custom_form_plugin_fields', 'add_custom_form_plugin_fields' );
function add_custom_form_plugin_fields( $fields ) {
    $fields['email'] = 'Email ';
    $fields['address'] = 'Address ';
    return $fields;
}
