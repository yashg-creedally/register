<?php
/**
 * Main plugin class
 */

 class CFP_Register {

    /**
     * Load and initialize all plugin classes
     */
    public function load_class_files() {
        // Load required class files
        require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-register-form.php';
        require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-register-input-field.php';
        require_once CUSTOM_FORM_PLUGIN_DIR . 'includes/class-register-admin.php';

        // Initialize form and admin handling
        new CFP_Form();
        new CFP_Admin();

        // Enqueue frontend styles
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

        // Add custom form fields via filter hook
        add_filter( 'custom_form_plugin_fields', array( $this, 'add_custom_form_fields' ) );
    }

    /**
     * Enqueue plugin styles
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'register-form-plugin-style',
            plugin_dir_url( __FILE__ ) . '../assets/css/style.css',
            array(),
            '1.0.0'
        );
    }

    /**
     * Add custom form fields via filter
     */
    public function add_custom_form_fields( $fields ) {
        // Add default fields with label and type
        $fields['first_name'] = [ 'label' => 'First Name', 'type' => 'text' ];
        $fields['last_name']  = [ 'label' => 'Last Name', 'type' => 'text' ];
        $fields['email']      = [ 'label' => 'Email', 'type' => 'email' ];  
        $fields['address']    = [ 'label' => 'Address', 'type' => 'text' ]; 
    
        // Additional fields (optional, just for example)
         $fields['age']        = [ 'label' => 'Age', 'type' => 'number' ];  // Age field
        
        return $fields;
    }
}
