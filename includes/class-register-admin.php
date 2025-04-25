<?php

/**
 * Admin functionality.
 * 
 * Handles custom post type registration and meta box display.
 */

class CFP_Admin {

    /**
     * Constructor: Hooks into WordPress actions.
     */

    public function __construct() {
        // Register custom post type for storing form submissions
        add_action( 'init', array( $this, 'register_custom_post_type' ) );

        // Add a meta box to display submitted form data
        add_action( 'add_meta_boxes', array( $this, 'add_custom_metabox' ) );
    }

    /**
     * Registers the custom post type to store form submissions.
     */
    public function register_custom_post_type() {
        $labels = array(
            'name'          => esc_html__( 'register form', 'register-form-plugin' ),
            'singular_name' => esc_html__( 'register form', 'register-form-plugin' ),
            'add_new'       => esc_html__( 'Add New', 'register-form-plugin' ),
            'add_new_item'  => esc_html__( 'Add New Submission', 'register-form-plugin' ),
            'edit_item'     => esc_html__( 'Edit Submission', 'register-form-plugin' ),
            'all_items'     => esc_html__( 'register form', 'register-form-plugin' ),
        );

        $args = array(
            'labels'      => $labels,
            'public'      => false,               // Not accessible from the frontend
            'show_ui'     => true,                // Show in WP admin
            'has_archive' => false,
            'supports'    => array( 'title' ),    // Only title is supported
            'menu_icon'   => 'dashicons-feedback' // Admin menu icon
        );

        register_post_type( 'custom_form_plugin', $args );
    }

    /**
     * Registers the custom meta box for form data display.
     */
    public function add_custom_metabox() {
        add_meta_box(
        'custom_form_submission_data',                                  // Metabox ID
            esc_html__( 'Submission Data', 'register-form-plugin' ),    // Title
            array( $this, 'render_metabox' ),                           // Callback function
            'custom_form_plugin',                                       // Post type
            'normal',                                                   // Context (position)
            'default'                                                   // Priority
        );
    }

    /**
     * Renders the content inside the meta box.
     *
     * @param WP_Post $post The post object.
     */
    public function render_metabox( $post ) {
      $meta = get_post_meta( $post->ID );

        if ( ! empty( $meta ) ) {
            echo '<ul class="admin__meta-list">';
            foreach ( $meta as $key => $value ) {
                echo '<li><strong>' . esc_html( ucfirst( $key ) ) . ':</strong> ' . esc_html( maybe_unserialize( $value[0] ) ) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . esc_html__( 'No form data found.', 'register-form-plugin' ) . '</p>';
        }
    }
}