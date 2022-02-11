<?php
/**
 *  Plugin Name: Bootstrap Shortcodes Ultimate
 *  Plugin URI:  https://addonmaster.com
 *  Description: Simple Plugin for Enqueue Bootstrap 4 CSS, JS, and Some Helpful WordPress Shortcodes for visual usages.
 *  Version:     4.3.1
 *  Author:      Akhtarujjaman Shuvo
 *  Author URI:  https://www.facebook.com/akhterjshuvo
 *  License:     GPL2
 *  Text Domain: btsu
 *  Domain Path: /lang
 *
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define('BSTU_VERSION', '4.3.1');

/**
* Including Plugin file for security
* Include_once
*
* @since 1.0.0
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function btsu_scripts(){
	wp_register_style('bootstrap', plugin_dir_url(__FILE__).'assets/css/bootstrap.min.css', null, BSTU_VERSION);
	wp_register_script('bootstrap', plugin_dir_url(__FILE__).'assets/js/bootstrap.min.js', array('jquery'), BSTU_VERSION);

	wp_enqueue_style('bootstrap');
	wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts','btsu_scripts');


// Shortcodes
include_once( dirname( __FILE__ ) . '/inc/shortcodes.php' );

// Notice
include_once( dirname( __FILE__ ) . '/inc/class-admin-notice.php' );

/**
 * Remove extra paragraphs and line breaks
 */
add_filter('the_content','btsu_fix_shortcodes');
function btsu_fix_shortcodes($content){
	$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']<br>' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

/**
 * Add plugin action links.
 *
 * @since 1.0.0
 * @version 4.0.0
 */
function btsu_plugin_action_links( $links ) {
	$plugin_links = array(
		'<a target="_blank" href="'.esc_url('https://wordpress.org/plugins/bs-shortcode-ultimate/#tab-description').'">' . esc_html__( 'Shortcodes', 'btsu' ) . '</a>',
		'<a target="_blank" title="'.esc_attr('If you need help just create a support ticket').'" href="'.esc_url('https://wordpress.org/support/plugin/bs-shortcode-ultimate/#new-topic-0').'">' . esc_html__( 'Need Helps?', 'btsu' ) . '</a>',
		'<a target="_blank" title="'.esc_attr('We hope you\'re enjoying This plugin! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?').'" href="'.esc_url('https://wordpress.org/support/plugin/bs-shortcode-ultimate/reviews/?filter=5#new-post').'">' . esc_html__( '★★★★★', 'btsu' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'btsu_plugin_action_links' );

/**
 * Example Function for add notice
 */
function btsu_admin_notices($args){
	$args[] = array(
		'id' => "btsu_review_notice",
		'text' => "<strong>We hope you're enjoying this plugin! Could you please give a 5-star rating on WordPress to inspire us?</strong>",
		'logo' => "https://ps.w.org/bs-shortcode-ultimate/assets/icon-256x256.png",
		'border_color' => "#5b26a6",
		'is_dismissable' => "true",
		'dismiss_text' => "Dismiss",
		'buttons' => array(
			array(
				'text' => "Shortcodes",
				'link' => "https://wordpress.org/plugins/bs-shortcode-ultimate/#tab-description",
				'icon' => "dashicons dashicons-external",
				'class' => "button button-secondary",
			),
			array(
				'text' => "Need Helps?",
				'link' => "https://wordpress.org/support/plugin/bs-shortcode-ultimate/#new-topic-0",
				'icon' => "dashicons dashicons-admin-comments",
				'class' => "button button-secondary",
			),
			array(
				'text' => "Need Custom Shortcode",
				'link' => "mailto:info@addonmaster.com",
				'icon' => "dashicons dashicons-email",
				'class' => "button button-secondary",
			),
			array(
				'text' => "Rate us 5*",
				'link' => "https://wordpress.org/support/plugin/bs-shortcode-ultimate/reviews/?filter=5#new-post",
				'icon' => "dashicons dashicons-external",
				'class' => "button button-primary",
			),
		)

	);

	return $args;
}
add_filter( 'addonmaster_admin_notice', 'btsu_admin_notices' );