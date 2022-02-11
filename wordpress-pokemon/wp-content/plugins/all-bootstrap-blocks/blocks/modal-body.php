<?php
function areoi_render_block_modal_body( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'modal-body',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
		) ) 
	);

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">
			' . $content . ' 
		</div>
	';

	return $output;
}

function areoi_register_block_modal_body() 
{
	register_block_type_from_metadata(
		__DIR__ . '/modal-body',
		array(
			'render_callback' => 'areoi_render_block_modal_body',
		)
	);
}

areoi_register_block_modal_body();