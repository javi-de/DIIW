<?php
/**
 * Plugin Name: Events Made Easy & qTranslate-X
 * Plugin URI: https://wordpress.org/plugins/events-made-easy-qtranslate-x
 * Description: Enables multilingual framework for plugin "Events Made Easy".
 * Version: 1.1
 * Author: qTranslate Team
 * Author URI: http://qtranslatexteam.wordpress.com/about
 * License: GPL2
 * Tags: multilingual, multi, language, translation, qTranslate-X, Events Made Easy
 * Author e-mail: qTranslateTeam@gmail.com
 */
if(!defined('ABSPATH'))exit;

define('QEME_VERSION','1.1');

add_filter('qtranslate_compatibility', 'qeme_qtrans_compatibility');
function qeme_qtrans_compatibility($compatibility){ return true; }

function qeme_init_language($url_info)
{
	if(!$url_info['doing_front_end']) {
		require_once(dirname(__FILE__)."/qeme-admin.php");
	//}else{
	//	require_once(dirname(__FILE__)."/qeme-front.php");
	}
}
add_action('qtranslate_init_language','qeme_init_language');
