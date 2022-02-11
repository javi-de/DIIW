<?php
function areoi_render_block_card_body( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'card-body',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['background'] ) ? $attributes['background'] : '' ),
			( !empty( $attributes['text_color'] ) ? $attributes['text_color'] : '' ),
			( !empty( $attributes['border_color'] ) ? $attributes['border_color'] : '' ),
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

function areoi_register_block_card_body() 
{
	register_block_type_from_metadata(
		__DIR__ . '/card-body',
		array(
			'render_callback' => 'areoi_render_block_card_body',
		)
	);
}

areoi_register_block_card_body();