<?php
function areoi_render_block_collapse( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array(
			'collapse', 
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['open'] ) ? 'show' : '' )
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' ) 
	);

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">
			' . $content . ' 
		</div>
	';

	return $output;
}

function areoi_register_block_collapse() 
{
	register_block_type_from_metadata(
		__DIR__ . '/collapse',
		array(
			'render_callback' => 'areoi_render_block_collapse',
		)
	);
}

areoi_register_block_collapse();