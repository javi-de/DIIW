<?php
function areoi_render_block_card( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'card',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['background'] ) ? $attributes['background'] : '' ),
			( !empty( $attributes['text_color'] ) ? $attributes['text_color'] : '' ),
			( !empty( $attributes['border_color'] ) ? $attributes['border_color'] : '' )
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'flex' ) 
	);

	$output = '
		<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">
			' . $content . ' 
		</div>
	';

	return $output;
}

function areoi_register_block_card() 
{
	register_block_type_from_metadata(
		__DIR__ . '/card',
		array(
			'render_callback' => 'areoi_render_block_card',
		)
	);
}

areoi_register_block_card();