<?php
function areoi_render_block_card_group( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'card-group',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
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

function areoi_register_block_card_group() 
{
	register_block_type_from_metadata(
		__DIR__ . '/card-group',
		array(
			'render_callback' => 'areoi_render_block_card_group',
		)
	);
}

areoi_register_block_card_group();