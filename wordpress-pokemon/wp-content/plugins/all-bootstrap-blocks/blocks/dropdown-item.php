<?php
function areoi_render_block_dropdown_item( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			( !empty( $attributes['type'] ) ? $attributes['type'] : '' ),
			( !empty( $attributes['active'] ) ? 'active' : '' ),
			( !empty( $attributes['disabled'] ) ? 'disabled' : '' ),
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' ) 
	);

	switch ( $attributes['type'] ) {
		case 'dropdown-item':
			$button_open = '
				<a 
					' . areoi_return_id( $attributes ) . '
					class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"
			';
			if ( !empty( $attributes['url'] ) ) {
				$button_open .= ' href="' . $attributes['url'] . '"';
			}
			if ( !empty( $attributes['rel'] ) ) {
				$button_open .= ' rel="' . $attributes['rel'] . '"';
			}
			if ( !empty( $attributes['target'] ) ) {
				$button_open .= ' target="' . $attributes['target'] . '"';
			}
			$button_open .= '>';

			$output = 
				$button_open . '		
					' . $attributes['text'] . ' 
				</a>
			';
			break;
		
		default:
			$output = '
				<div ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '">			
					' . $attributes['text'] . ' 
				</div>
			';
			break;
	}

	return $output;
}

function areoi_register_block_dropdown_item() 
{
	register_block_type_from_metadata(
		__DIR__ . '/dropdown-item',
		array(
			'render_callback' => 'areoi_render_block_dropdown_item',
		)
	);
}

areoi_register_block_dropdown_item();