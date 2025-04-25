<?php
// Prevent direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure that field_name and field_label are being passed correctly.
$field_name  = isset( $field_name ) ? $field_name : 'default_name';
$field_label = isset( $field_label ) ? ( is_array( $field_label ) ? $field_label['label'] : $field_label ) : 'Default Label';
$field_type  = isset( $field_type ) ? $field_type : 'text'; 

// Render the correct input field
echo CFP_Input_Field::render( $field_type, $field_name, $field_label );
