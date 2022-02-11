<input 
	name="<?php echo esc_attr( $option['name'] ) ?>" 
	type="text" 
	id="<?php echo esc_attr( $option['name'] ) ?>" 
	value="<?php echo esc_attr( $value ) ?>" 
	class="areoi-input-text" 
	data-form-type="other"
	data-default="<?php echo esc_attr( $option['default'] ) ?>"
	placeholder="<?php echo esc_attr( $option['default'] ) ?>"
>

<select class="areoi-select-variable areoi-select-variable" name="areoi-select-variable">
	<option value="">Populate with variable</option>
</select>