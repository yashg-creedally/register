<?php

// Prevent direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Set default values if not defined.
if ( ! isset( $field_name, $field_label ) ) {
    $field_name  = 'default_name';
    $field_label = 'Default Label';
}

// Render the input field with dynamic type (email or text).
echo CFP_Input_Field::render(
    ( 'email' === $field_name ? 'email' : 'text' ),
    $field_name,
    $field_label
);
