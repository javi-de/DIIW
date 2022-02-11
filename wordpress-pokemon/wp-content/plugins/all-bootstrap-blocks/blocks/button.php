<?php
function areoi_render_block_button( $attributes, $content ) 
{
	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'btn',
			'position-relative',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['style'] ) ? $attributes['style'] : '' ),
			( !empty( $attributes['size'] ) ? $attributes['size'] : '' ),
			( !empty( $attributes['dropdown'] ) ? 'dropdown-toggle' : '' ),
			( !empty( $attributes['text_wrap'] ) ? $attributes['text_wrap'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'inline-block' )
		. ' ' . 
		areoi_get_display_block_class_str( $attributes, 'inline-block' )
	);

	$badge_class = areoi_get_class_name_str( array( 
		'badge',
		( !empty( $attributes['badge_style'] ) ? $attributes['badge_style'] : '' ),
		( !empty( $attributes['badge_background'] ) ? $attributes['badge_background'] : '' ),
		( !empty( $attributes['badge_text_color'] ) ? $attributes['badge_text_color'] : '' ),
		( !empty( $attributes['badge_classes'] ) ? $attributes['badge_classes'] : '' ),
	) );

	$dropdown_class = areoi_get_class_name_str( array( 
		'dropdown-menu',
		( !empty( $attributes['dropdown_style'] ) ? $attributes['dropdown_style'] : '' ),
		( !empty( $attributes['dropdown_menu_alignment'] ) ? $attributes['dropdown_menu_alignment'] : '' )
	) );

	$tooltip = null;
	if ( !empty( $attributes['tooltip'] ) ) {
		$tooltip = '
			data-bs-placement="' . $attributes['tooltip_direction'] . '"
			data-bs-toggle="tooltip"
			data-bs-html="true"	
			title="' . $attributes['tooltip_content'] . '"
		';
	}

	$badge = null;
	if ( !empty( $attributes['badge'] ) ) {
		$badge = '
			<span 
				class="' . $badge_class . '"
			>
				' . $attributes['badge_content'] . '
			</span>
		';
	}

	$button_open = '
		<' . $attributes['type'] . ' 
			' . areoi_return_id( $attributes ) . '
			class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"
	';
	if ( !empty( $attributes['url'] ) ) {
		$button_open .= ' href="' . $attributes['url'] . '"';
	}
	if ( !empty( $attributes['rel'] ) ) {
		$button_open .= ' rel="' . $attributes['rel'] . '"';
	}
	if ( !empty( $attributes['linkTarget'] ) ) {
		$button_open .= ' target="' . $attributes['linkTarget'] . '"';
	}
	if ( !empty( $attributes['dropdown'] ) ) {
		$button_open .= ' data-bs-toggle="dropdown"';
		$button_open .= ' data-bs-auto-close="' . $attributes['dropdown_auto_close'] . '"';
	}
	$button_open .= ' ' . $tooltip . '>';

	$output = '';

	if ( !empty( $attributes['dropdown'] ) ) {
		$output .= '
			<div class="d-inline-block ' . $attributes['dropdown_direction'] . '">
		';
	}
		if ( !empty( $attributes['popover'] ) ) {
			$output .= '
				<span
					class="popover-container" 
					data-bs-container="body"
	                title="' . $attributes['popover_title'] . '"
	                data-bs-content="' . $attributes['popover_content'] . '"
	                data-bs-placement="' . $attributes['popover_direction'] . '"
	                data-bs-trigger="focus ' . $attributes['popover_trigger'] . '"
	                data-bs-toggle="popover"
	                tabindex="0"
	            >
			';
		}

			$output .= '
				' . $button_open . '
					' . $attributes['text'] . ' 
					' . $badge . ' 
				</' . $attributes['type'] . '>
			';

		if ( !empty( $attributes['popover'] ) ) {
			$output .= '</span>';
		}

	if ( !empty( $attributes['dropdown'] ) ) {

			$output .= '
				<div 
					class="' . $dropdown_class . '" 
					aria-labelledby="' . ( !empty( $attributes['anchor'] ) ? $attributes['anchor'] : '' ) . '"
				>
					' . $content . '
				</div>';

		$output .= '</div>';
	}

	return $output;
}

function areoi_register_block_button() 
{
	register_block_type_from_metadata(
		__DIR__ . '/button',
		array(
			'render_callback' => 'areoi_render_block_button',
		)
	);
}

areoi_register_block_button();