<?php
function areoi_render_block_carousel( $attributes, $content ) 
{
	$dom 	= new DOMDocument;
	$dom->loadHTML($content);
	$xpath 	= new DOMXpath($dom);
	$items 	= $xpath->query('//div[contains(@class, "carousel-item")]');

	$class 			= 	trim( 
		areoi_get_class_name_str( array( 
			'carousel',
			'slide',
			( !empty( $attributes['className'] ) ? $attributes['className'] : '' ),
			( !empty( $attributes['style'] ) ? $attributes['style'] : '' ),
			( !empty( $attributes['transition'] ) ? $attributes['transition'] : '' ),
		) ) 
		. ' ' . 
		areoi_get_display_class_str( $attributes, 'block' ) 
	);

	$buttons = null;
	if ( !empty( $attributes['controls'] ) && $items->length > 1 ) {
		$buttons = '
			<button class="carousel-control-prev" type="button" data-bs-target=".block-' . $attributes['block_id'] . '" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target=".block-' . $attributes['block_id'] . '" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		';
	}

	$indicators = null;
	if ( !empty( $attributes['indicators'] ) && $items->length > 1 ) {
		$indicators = '<div class="carousel-indicators">';
			foreach ( $items as $item_key => $item ) {
				$indicators .= '
					<button 
						type="button" 
						data-bs-target=".block-' . $attributes['block_id'] . '" 
						data-bs-slide-to="' . $item_key . '" 
						class="' . ( $item_key == 0 ? 'active' : '' ) . '" 
						aria-current="true" 
						aria-label="Slide ' . $item_key . '"
					></button>
				';
			}
		$indicators .= '</div>';
	}

	$newdoc = new DOMDocument();
	if ( !empty( $items ) ) {
		foreach ( $items as $item_key => $item ) {
			$cloned = $item->cloneNode(TRUE);
			if ( $item_key == 0 ) {
				$cloned->setAttribute( 'class', 'carousel-item active' );
			}
		    $newdoc->appendChild($newdoc->importNode($cloned,TRUE));
		}
		$content = $newdoc->saveHTML();
	}

	$output = '
		<div 
			' . areoi_return_id( $attributes ) . '
			class="' . areoi_format_block_id( $attributes['block_id'] ) . ' ' . $class . '"
			data-bs-touch="' .( $attributes['touch'] ? 'true' : 'false') . '" 
			data-bs-interval="' . ($attributes['interval'] ? '4000' : 'false') . '"
		>
			' . $buttons . '
			' . $indicators . '
			' . $content . ' 
			<div class="clearfix"></div>
		</div>
	';

	return $output;
}

function areoi_register_block_carousel() 
{
	register_block_type_from_metadata(
		__DIR__ . '/carousel',
		array(
			'render_callback' => 'areoi_render_block_carousel',
		)
	);
}

areoi_register_block_carousel();