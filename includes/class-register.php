<?php
/**
 * Main class 
 * 
 * initialize the plugin and enqueue assets.
 */
class CFP_Register {

    /**
     * Run the plugin logic: load classes and hook assets.
     */
    public function run() {
        new CFP_Form();   // form rendering and submission.
        new CFP_Admin();  // admin custom post type and metabox.
        
        // Enqueue frontend CSS.
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Load the plugin's frontend styles.
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'register-form-plugin-style', // Handle name.
            plugin_dir_url( __FILE__ ) . '../assets/css/style.css', // CSS path.
            array(), // Dependencies.
            '1.0.0'  // Version.
        );
    }
}
