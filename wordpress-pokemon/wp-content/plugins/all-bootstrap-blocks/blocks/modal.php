<?php
function areoi_render_block_modal( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'modal',
			'fade',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
		) ) 
	);

	$dialog_class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'modal-dialog',
			( !empty( $attributes['scrollable'] ) ? $attributes['scrollable'] : '' ),
			( !empty( $attributes['centered'] ) ? $attributes['centered'] : '' ),
		) ) 
	);

	$output = '
		<div 
			' . areoi_return_id( $attributes ) . '  
			class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"
			tabindex="-1"  
			aria-hidden="true"
			' . ( !empty( $attributes['backdrop'] ) && $attributes['backdrop'] != 'Default' ? 'data-bs-backdrop="' . $attributes['backdrop'] . '"' : '' ) . '
		>
			<div class="' . $dialog_class . '">
    			<div class="modal-content">
					' . $content . '
				</div>
			</div> 
		</div>
	';

	return $output;
}

function areoi_register_block_modal() 
{
	register_block_type_from_metadata(
		__DIR__ . '/modal',
		array(
			'render_callback' => 'areoi_render_block_modal',
		)
	);
}

areoi_register_block_modal();