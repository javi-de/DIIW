<?php
function areoi_render_block_button_group( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['style'] ) ? $attributes['style'] : 'btn-group' ),
			( !empty( $attributes['size'] ) ? $attributes['size'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'inline-flex' ) 
	);

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">
			' . $content . ' 
		</div>
	';

	return $output;
}

function areoi_register_block_button_group() 
{
	register_block_type_from_metadata(
		__DIR__ . '/button-group',
		array(
			'render_callback' => 'areoi_render_block_button_group',
		)
	);
}

areoi_register_block_button_group();