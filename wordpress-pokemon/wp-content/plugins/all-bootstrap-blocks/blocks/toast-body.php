<?php
function areoi_render_block_toast_body( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'toast-body',
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

function areoi_register_block_toast_body() 
{
	register_block_type_from_metadata(
		__DIR__ . '/toast-body',
		array(
			'render_callback' => 'areoi_render_block_toast_body',
		)
	);
}

areoi_register_block_toast_body();