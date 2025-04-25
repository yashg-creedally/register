<?php
/**
 * Frontend form handler for the Custom Form Plugin.
 * 
 * Handles rendering the form and saving submitted data.
 */

class CFP_Form {

    /**
     * Constructor: Hooks into WordPress for shortcode and form submission.
     */
    public function __construct() {

        // Register shortcode to render the form
        add_shortcode( 'custom_form_plugin', array( $this, 'render_form' ) );

        // Handle form submission on init
        add_action( 'init', array( $this, 'handle_form_submission' ) );
    }

    /**
     * Get default form fields.
     * Allows other developers to modify fields via the custom filter hook.
     *
     * @return array List of field keys and labels.
     */
    private function get_form_fields() {
        $default_fields = array(
            'first_name'  => 'First Name',
            'last_name' => 'Last Name',
        );

        // Allow other devs to add or modify fields
        return apply_filters( 'custom_form_plugin_fields', $default_fields );
    }

    /**
     * Render the frontend form using a template.
     * Uses output buffering to return the form HTML.
     *
     * @return string HTML form content.
     */

    public function render_form() {
        ob_start();
        $form_fields = $this->get_form_fields();

        if ( isset( $_GET['submitted'] ) && $_GET['submitted'] === 'true' ) {
            echo '<div class="success-message">Data saved successfully ✅</div>';
        }

        include plugin_dir_path( __FILE__ ) . '../templates/form.php';
        return ob_get_clean();
    }

    /**
     * Handle the form submission, validate and save data.
     */
    public function handle_form_submission() {
        // Check if form was submitted
        if ( isset( $_POST['custom_form_plugin_nonce'] ) ) {

            // Verify nonce for security
            if ( ! wp_verify_nonce( $_POST['custom_form_plugin_nonce'], 'custom_form_plugin_action' ) ) {
                wp_die( esc_html__( 'Security check failed.', 'register-form-plugin' ) );
            }

            $data   = array();
            $fields = $this->get_form_fields();

            // Loop through each field and sanitize input
            foreach ( $fields as $key => $label ) {
                if ( 'email' === $key ) {
                    $data[ $key ] = isset( $_POST[ $key ] ) ? sanitize_email( $_POST[ $key ] ) : '';
                } else {
                    $data[ $key ] = isset( $_POST[ $key ] ) ? sanitize_text_field( $_POST[ $key ] ) : '';
                }
            }

            // Determine page title based on the form's location
            $page_title = 'Form Submission';
            if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
                $referer_url = esc_url_raw( $_SERVER['HTTP_REFERER'] );
                $page_id     = url_to_postid( $referer_url );
                if ( $page_id ) {
                    $title = get_the_title( $page_id );
                    if ( $title && $title !== '' ) {
                        $page_title = $title;
                    }
                }
            }

            // Insert a new post to store submission
            $post_id = wp_insert_post( array(
                'post_title'  => sanitize_text_field( $page_title ),
                'post_type'   => 'custom_form_plugin',
                'post_status' => 'publish',
            ) );

            // Save each form field as post meta
            if ( $post_id && ! is_wp_error( $post_id ) ) {
                foreach ( $data as $key => $value ) {
                    update_post_meta( $post_id, $key, $value );
                }
            }

            // Redirect to the same page with a success flag
            wp_redirect( add_query_arg( 'submitted', 'true', wp_get_referer() ) );
            exit;
        }
    }
}
