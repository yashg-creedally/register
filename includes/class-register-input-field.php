<?php
/**
 * Input fields for the custom form.
 */
class CFP_Input_Field {

    /**
     * Render a single input field with label.
     *
     * @param string $type  The type of input (e.g., text, email, checkbox, radio, etc.).
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
            
            <?php
            // Check the field type and render accordingly
            switch ( $type ) {
                case 'textarea':
                    ?>
                    <textarea class="form__input" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
                    <?php
                    break;

                    case 'checkbox':
                        ?>
                        <div class="form__checkbox">
                            <input type="checkbox" class="form__input" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="1" <?php checked( $value, '1' ); ?>>
                            <label for="<?php echo esc_attr( $name ); ?>">
                                <?php echo esc_html( $label ); ?>
                            </label>
                        </div>
                        <?php
                        break;
                    
                    case 'radio':
                        ?>
                        <div class="form__radio">
                            <label>
                                <input type="radio" class="form__input" name="<?php echo esc_attr( $name ); ?>" value="yes" <?php checked( $value, 'yes' ); ?>> Yes
                            </label>
                            <label>
                                <input type="radio" class="form__input" name="<?php echo esc_attr( $name ); ?>" value="no" <?php checked( $value, 'no' ); ?>> No
                            </label>
                        </div>
                        <?php
                        break;
                    

                default: // text, email, number, etc.
                    ?>
                    <input class="form__input" type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
                    <?php
                    break;
            }
            ?>

        </div>
        <?php
        return ob_get_clean();
    }
}
