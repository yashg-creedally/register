<?php
/**
 * render the form on the front-end.
 */
?>

<form action="#" method="post" class="form">
    <?php
    // Output a security nonce field for validation.
    wp_nonce_field( 'custom_form_plugin_action', 'custom_form_plugin_nonce' );

    // Loop through each field and include the input template.
    foreach ( $form_fields as $field_name => $field_label ) {
        include plugin_dir_path( __FILE__ ) . 'form-field.php';
    }
    ?>

    <!-- Submit button -->
    <button type="submit" class="form__submit">
        <?php esc_html_e( 'Submit', 'register-form-plugin' ); ?>
    </button>
</form>
