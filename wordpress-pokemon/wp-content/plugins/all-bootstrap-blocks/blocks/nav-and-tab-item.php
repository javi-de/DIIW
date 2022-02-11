<?php
function areoi_render_block_nav_and_tab_item( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'nav-link',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['active'] ) ? 'active' : '' ),
			( !empty( $attributes['disabled'] ) ? 'disabled' : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'flex' )
	);

	$nav_and_tab_item_open = '<a ' . areoi_return_id( $attributes ) . ' class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"';
	
	if ( !empty( $attributes['url'] ) ) {
		$nav_and_tab_item_open .= ' href="' . $attributes['url'] . '"';
	}
	if ( !empty( $attributes['rel'] ) ) {
		$nav_and_tab_item_open .= ' rel="' . $attributes['rel'] . '"';
	}
	if ( !empty( $attributes['target'] ) ) {
		$nav_and_tab_item_open .= ' target="' . $attributes['target'] . '"';
	}
	$nav_and_tab_item_open .= '>';

	$output = '
		' . $nav_and_tab_item_open . '
			' . ( !empty( $attributes['text'] ) ? $attributes['text'] : '' ) . '
		</a>
	';

	return $output;
}

function areoi_register_block_nav_and_tab_item() 
{
	register_block_type_from_metadata(
		__DIR__ . '/nav-and-tab-item',
		array(
			'render_callback' => 'areoi_render_block_nav_and_tab_item',
		)
	);
}

areoi_register_block_nav_and_tab_item();