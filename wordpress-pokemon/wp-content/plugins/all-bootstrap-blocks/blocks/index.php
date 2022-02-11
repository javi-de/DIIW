<?php
$block_folders = array(
	
	// Layout
	'strip',
	'container',
	'row',
	'column',
	'column-break',

	// Components
	'accordion',
	'accordion-item',
	'alert',
	'breadcrumb',
	'button',
	'button-group',
	'card',
	'card-body',
	'card-header',
	'card-footer',
	'card-group',
	'carousel',
	'carousel-item',
	'collapse',
	'div',
	'dropdown-item',
	'list-group',
	'list-group-item',
	'modal',
	'modal-header',
	'modal-body',
	'modal-footer',
	'nav-and-tab',
	'nav-and-tab-item',
	'offcanvas',
	'offcanvas-header',
	'offcanvas-body',
	'progress',
	'spinner',
	'toast',
	'toast-header',
	'toast-body',
);

foreach ( $block_folders as $block_folder ) {
	if ( file_exists( AREOI__PLUGIN_DIR . '/blocks/' . $block_folder . '.php' ) ) {
		require AREOI__PLUGIN_DIR . '/blocks/' . $block_folder . '.php';
	}
}