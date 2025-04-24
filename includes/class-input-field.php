<?php
/**
 * input fields for the custom form.
 */
class CFP_Input_Field {

    /**
     * Render a single input field with label.
     *
     * @param string $type  The type of input (e.g., text, email).
     * @param string $name  The name and ID attribute of the field.
     * @param string $label The field label.
     * @param string $value (Optional) Default value for the field.
     *
     * @return string       HTML markup for the input field.
     */
    public static function render( $type, $name, $label, $value = '' ) {
        ob_start();
        ?>
        <div class="form__field form__field--<?php echo esc_attr( $name ); ?>">
            <label class="form__label" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
            <input class="form__input"
                type="<?php echo esc_attr( $type ); ?>"
                name="<?php echo esc_attr( $name ); ?>"
                id="<?php echo esc_attr( $name ); ?>"
                value="<?php echo esc_attr( $value ); ?>">
        </div>
        <?php
        return ob_get_clean();
    }
}
