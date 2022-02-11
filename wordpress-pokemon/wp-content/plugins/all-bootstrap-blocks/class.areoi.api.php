<?php

class AREOI_Api
{
	private static $initiated = false;

	public static function init() 
	{

		if ( !self::$initiated ) {
			if( is_user_logged_in() ) {
				register_rest_route( 'areoi', '/variables', array(
					'methods' => 'GET',
					'callback' => array( 'AREOI_Api', 'variables' ),
					'permission_callback' => function() {
						return true;
					}
				) );
			}
		}
	}

	public static function variables() 
	{
		$query = sanitize_text_field( !empty( $_GET['q'] ) ) ? sanitize_text_field( $_GET['q'] ) : false;
		$_settings 	= new AREOI_Settings();
		$page 		= $_settings->get_settings();
		$variables  = array();
		foreach ( $page['children'] as $child_key => $child ) {
			if ( empty( $child['sections'] ) ) {
				continue;	
			}
			foreach ( $child['sections'] as $section_key => $section ) {
				
				if ( empty( $section['options'] ) ) {
					continue;	
				}
				foreach ( $section['options'] as $option_key => $option ) {

					if ( empty( $option['variable'] ) ) {
						continue;
					}
					if ( $query && strpos( $option['label'], $query ) === false ) {
						continue;
					}
					$variables[] = array( 
						'id' => $option['label'],
						'text' => $option['label']
					);
				}
			}
		}
		sort( $variables );

		$response = $variables;
		
		return array( 'results' => $response );
	}
}
