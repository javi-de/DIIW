<?php  

function areoi_get_class_name_str( $classes )
{
	$class_string = '';
	if ( is_array( $classes) ) {
		foreach ( $classes as $class_key => $class ) {
			if ( !$class || $class == 'Default' ) {
				continue;
			}
			$class_string .= $class . ' ';
		}
	}
	return trim( $class_string );
}

function areoi_get_display_class_str( $attributes, $display )
{
	$devices 		= array( 'xs', 'sm', 'md', 'lg', 'xl', 'xxl' );
	$class_string 	= '';

	$prev_display 	= false;
	foreach ( $devices as $device ) {
		if ( empty( $attributes['hide_' . $device] ) ) {
			// continue;
		}
		$attr 		= !empty( $attributes['hide_' . $device] ) ? $attributes['hide_' . $device] : null;

		if ( !empty( $attr ) ) {
			$class_string 	.= ' d-' . ( $device == 'xs' ? '' : $device . '-' ) . 'none';
			$prev_display 	= true;
		} elseif ( $prev_display ) {

			$class_string 	.= ' d-' . ( $device == 'xs' ? '' : $device . '-' ) . $display;
			$prev_display 	= false;
		}
	}
	
	return trim( $class_string );
}

function areoi_return_id( $attributes )
{
	return ( ( !empty( $attributes['anchor'] ) ) ? 'id="' . $attributes['anchor'] . '"' : '' );
}

function areoi_get_display_block_class_str( $attributes, $display )
{
	$devices 		= array( 'xs', 'sm', 'md', 'lg', 'xl', 'xxl' );
	$class_string 	= '';

	$prev_display 	= false;
	foreach ( $devices as $device ) {
		$attr 		= $attributes['block_' . $device];

		if ( !empty( $attr ) ) {
			$class_string 	.= ' d-' . ( $device == 'xs' ? '' : $device . '-' ) . 'block';
			$prev_display 	= true;
		} elseif ( $prev_display ) {
			$class_string 	.= ' d-' . ( $device == 'xs' ? '' : $device . '-' ) . $display;
			$prev_display 	= false;
		}
	}
	
	return trim( $class_string );
}

function areoi_format_block_id( $block_id )
{
	return 'block-' . $block_id;
}

function areoi_get_rgba_str( $rgba )
{
	return trim( 'rgba(' . $rgba['r'] . ', ' . $rgba['g'] . ', ' . $rgba['b'] . ',' . $rgba['a'] . ')' );
}

function areoi_generate_breadcrumbs() 
{
	global $post,$wp_query;

	$breadcrumbs = array();
	if ( $post->post_parent ) {
		$breadcrumbs = areoi_generate_breadcrumbs_parent( $breadcrumbs, $post->post_parent );

		$breadcrumbs[] = array(
			'permalink' => home_url(),
			'label'		=> 'Home',
			'active'	=> false
		);
	}
	$breadcrumbs = array_reverse( $breadcrumbs );

	if ( get_permalink( $post->ID ) != home_url() ) {
		$breadcrumbs[] = array(
			'permalink' => get_the_permalink( $post->ID ),
			'label'		=> get_the_title( $post->ID ),
			'active'	=> true
		);
	} else {
		$breadcrumbs[0]['active'] = true;
	}
	return $breadcrumbs;
}

function areoi_generate_breadcrumbs_parent( $breadcrumbs, $parent_id ) 
{
	$parent = get_post( $parent_id );
	
	if ( get_permalink( $parent->ID ) != home_url() ) {
		$breadcrumbs[] = array(
			'permalink' => get_the_permalink( $parent->ID ),
			'label'		=> get_the_title( $parent->ID ),
			'active'	=> false
		);
	}

	if ( $parent->post_parent ) {
		return areoi_generate_breadcrumbs_parent( $breadcrumbs, $parent->post_parent );
	}
	return $breadcrumbs;
}

function areoi_enqueue_css( $enqueues )
{
	foreach ( $enqueues as $enqueue_key => $enqueue ) {
		wp_enqueue_style( $enqueue_key, AREOI__PLUGIN_URI . $enqueue, array(), filemtime( AREOI__PLUGIN_DIR . $enqueue ) );
	}
}

function areoi_enqueue_js( $enqueues )
{
	foreach ( $enqueues as $enqueue_key => $enqueue ) {
		wp_enqueue_script( $enqueue_key, AREOI__PLUGIN_URI . $enqueue['path'], $enqueue['includes'], filemtime( AREOI__PLUGIN_DIR . $enqueue['path'] ), true );
	}
}