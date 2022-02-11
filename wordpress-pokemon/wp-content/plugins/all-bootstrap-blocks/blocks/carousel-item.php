<?php
function areoi_render_block_carousel_item( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'carousel-item',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' ) 
	);

	$output = '
		<div 
			' . areoi_return_id( $attributes ) . '
			class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"
			' . ($attributes['interval'] ? 'data-bs-interval="' . $attributes['interval'] . '"' : '') . '
		>
			' . $content . ' 
		</div>
	';

	return $output;
}

function areoi_register_block_carousel_item() 
{
	register_block_type_from_metadata(
		__DIR__ . '/carousel-item',
		array(
			'render_callback' => 'areoi_render_block_carousel_item',
		)
	);
}

areoi_register_block_carousel_item();