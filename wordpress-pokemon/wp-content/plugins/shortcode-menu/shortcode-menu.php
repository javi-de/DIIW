<?php
/*
Plugin Name: Shortcode Menu
Plugin URI: http://wordpress.org/plugins/shortcode-menu/
Description: To display menu's everywhere like sidebar, header, footer, pages, posts or theme template with effective styling and customization using shortcode.
Version: 3.2
Author:Amit Sukapure
Author URI: http://in.linkedin.com/in/amitsukapure/
*/
/*  Copyright 2014 Shortcode Menu (email : amit.sukapure@gmail.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('menu_shortcode'))
{
	class menu_shortcode
	{
		function __construct()
		{
			require 'help.php';
			add_action('admin_menu',array($this, 'add_shortcode_menu'));
			add_action('wp_enqueue_scripts', array($this, 'menushort_template_scripts_styles'));
			add_action('admin_enqueue_scripts', array($this, 'menushort_admin_scripts_styles'));
			add_action( 'wp_ajax_wpsm_shortcode_menu_mail', array($this, 'wpsm_mail_callback' ));
			add_shortcode('shortmenu', array($this,'display_shortcode_menu'));
		}
		
		function add_shortcode_menu()
		{
			add_menu_page('Shortcode Menu', 'Shortcode Menu', 'administrator', 'shortcode-menu', 'shortcode_menu_help','',31 );	
		}
		
		function menushort_template_scripts_styles()
		{
			wp_enqueue_script('jquery');
			
			wp_register_script('enhance-script-enhance-menu', plugins_url('js/enhance.menu.js', __FILE__));
			wp_register_script('enhance-script-shortcode-menu-responsive', plugins_url('js/tinynav.min.js', __FILE__));
			wp_register_style('shortcode-menu-style', plugins_url('shortcode-menu.css', __FILE__));
		}
		
		function menushort_admin_scripts_styles()
		{
			wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-dialog' );
			
			wp_register_style('jquery-ui-style-plugin', plugins_url( '/css/jquery-ui.css',__FILE__));
			wp_enqueue_style( 'jquery-ui-style-plugin' );
			
			wp_register_style('menushort-admin-style', plugins_url('style.css', __FILE__));
			wp_enqueue_style( 'menushort-admin-style' );
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
		}
		
		function display_shortcode_menu($attr)
		{
			wp_enqueue_script('enhance-script-enhance-menu');
			wp_enqueue_script('enhance-script-shortcode-menu-responsive');
			wp_enqueue_style( 'shortcode-menu-style' );
			
			$id = $class = $menu = $display = $enhance = $menu_color = $menu_anchor_color = $menu_anchor_hover_color = $submenu_color = $submenu_anchor_color = $submenu_anchor_hover_color = $submenu_transparency = $menu_style = $css = $is_responsive = $responsive = $arrow = $menu_anchor_color_style = $menu_anchor_hover_color_style  = $opacity = $icon_style = $submenu_transparency = '';
			
			extract( shortcode_atts( array(
				'id' => '',
				'class' => '',
				'menu' => '',
				//'list' => 'ul',
				'display' => 'block',
				'enhance' => 'true',
				'menu_color' => '',
				'menu_anchor_color' => '',
				'menu_anchor_hover_color' => '',
				'submenu_color' => '',
				'submenu_anchor_color' => '',
				'submenu_anchor_hover_color' => '',
				'submenu_transparency' => '',
				'arrow' => 'true',
				'css' => '',
				'is_responsive' => 'true',
				'responsive' => '650'
			), $attr ) );
			
			$list = 'ul';
			
			if($menu_color != '')
			{
				$menu_style = 'background:'.$menu_color.'; ';
			}
			if($menu_anchor_color != '')
			{
				$menu_anchor_color_style = 'color:'.$menu_anchor_color.'; ';
			}
			if($menu_anchor_hover_color != '')
			{
				$menu_anchor_hover_color_style = 'color:'.$menu_anchor_hover_color.'; ';
			}
			if($submenu_color != '')
			{
				$rgba = $this->wpsm_hex2rgb($submenu_color);
				if($submenu_transparency != '')
					$opacity = $submenu_transparency;
				else
					$opacity = '1';
					
				$sub_menu_color = 'rgba('.$rgba[0].','.$rgba[1].','.$rgba[2].','.$opacity.');';
				
				$sub_menu_style = 'background: '.$sub_menu_color;
				$icon_style = 'color:'.$sub_menu_color;
			}
			if($submenu_anchor_color != '')
			{
				$submenu_anchor_color_style = 'color:'.$submenu_anchor_color.'; ';
			}
			if($submenu_anchor_hover_color != '')
			{
				$submenu_anchor_hover_color_style = 'color:'.$submenu_anchor_hover_color.'; ';
			}
			
			
			$menu_class = '';
			
			
			if($id == '')
				$menu_id = 'short_menu_'.uniqid();
			else
				$menu_id = $id;
				
			if($class != '')
				$menu_class .= $class;
				
				
			if($enhance == 'true' && $list == 'ul' && $display == 'block')
			{
				$menu_class .= ' wpsm-menu wpsm-vertical menu_enhance ';
			}
			elseif($enhance == 'true' && $list == 'ol' && $display == 'block')
			{
				$menu_class .= ' wpsm-menu wpsm-vertical enhance_shortcode_menu_list ';
			}
			elseif(($enhance == 'true' && $list == 'ol' && $display == 'inline')
			||($enhance == 'false' && $list == 'ol' && $display == 'inline'))
			{
				$menu_class .= ' wpsm-menu enhance_shortcode_menu_inline_list ';
			}
			elseif(($enhance == 'true' && $list == 'ul' && $display == 'inline')
			||($enhance == 'false' && $list == 'ul' && $display == 'inline'))
			{
				$menu_class .= ' wpsm-menu enhance_shortcode_menu_inline ';
			}
			elseif($enhance == 'false' && $list == 'ol' && $display == 'block')
			{
				$menu_class .= ' wpsm-menu shortcode_menu_list ';
			}
			else
			{
				$menu_class .= ' ';
			}
			
			$defaults = array(
				'theme_location'  => '',
				'menu'            => $menu,
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'shortcode_menu',
				'menu_id'         => '',
				'echo'            => false,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="'.$menu_id.'" class="%2$s '.$menu_class.' ">%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			$html = wp_nav_menu( $defaults );
			$html .= '<div class="clear"></div>
			<style>
				#'.$menu_id.' { '.$menu_style.' }
				#'.$menu_id.' ul.wpsm-arrow-enabled:before { '.$icon_style.' } 
				#'.$menu_id.' ul, #'.$menu_id.' ul ul { '.$sub_menu_style.' }
				#'.$menu_id.' a { '.$menu_anchor_color_style.' }
				#'.$menu_id.' a:hover { '.$menu_anchor_hover_color_style.' }
				#'.$menu_id.' ul a { '.$submenu_anchor_color_style.' }
				#'.$menu_id.' ul a:hover { '.$submenu_anchor_hover_color_style.' }
				'.$css.'
			</style>
			<script type="text/javascript">
				var show_arrow = "'.$arrow.'";';
				if($is_responsive == 'true')
				{
					$html .= 'var $sm = jQuery.noConflict();
					jQuery(function ($) {
						$("#'.$menu_id.'").tinyNav();
						$("#'.$menu_id.'").next().addClass("shortcode-menu-mobile");
						
						shortcode_menu_responsive();
					});
					jQuery(window).resize(function($){
						shortcode_menu_responsive();
					});
					function shortcode_menu_responsive()
					{
						var window_width = $sm(window).width();
						if(window_width <= '.$responsive.')
						{
							$sm("#'.$menu_id.'").hide();
							$sm("#'.$menu_id.'").next().show();
						}
						else
						{
							$sm("#'.$menu_id.'").show();
							$sm("#'.$menu_id.'").next().hide();
						}
					}';
				}				
			$html .= '</script>';
			return $html;
		}
		
		function wpsm_hex2rgb($hex) 
		{
			$hex = str_replace("#", "", $hex);
		
			if(strlen($hex) == 3) 
			{
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			  	$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			  	$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		   	} 
		   	else 
		   	{
			  	$r = hexdec(substr($hex,0,2));
			  	$g = hexdec(substr($hex,2,2));
			  	$b = hexdec(substr($hex,4,2));
		   	}
		   	$rgb = array($r, $g, $b);
		   	//return implode(",", $rgb); // returns the rgb values separated by commas
		   	return $rgb; // returns an array with the rgb values
		}
		
		function wpsm_mail_callback()
		{
			//if(wp_mail('amit9.rocks@gmail.com','Support request', 'Testing'))
			//	echo 'Mail sent';
			//else
			//	echo 'Not sent';
			$your_name = $_POST['your_name'];
			$your_message = $_POST['your_message'];
			$your_email = $_POST['your_email'];
			$errors = 0;
			$msg = '';
			if($your_name == '')
				$errors++;
			if($your_message == '')
				$errors++;
			if($errors == 0)
			{
				$site = home_url();
				$to = 'amit.sukapure@gmail.com';
				$from = $your_email;
				$subject = 'Support request for Shortcode Menu from '.$your_name;
				$message = $your_message.'<br/><br/>Email - '.$your_email.' <br/><br/> Site - '.$site.'<br/><br/> - <br/> '.$your_name;
				$headers = "From: ".$your_name." ". strip_tags($from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				if(wp_mail( $to, $subject, $message, $headers))
				{
					$msg = 'Your query has been sent.';
					$cls = 'updated';
				}
				else
				{
					$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
					if(wp_mail( $to, $subject, $message, $headers))
					{
						$msg = 'Your query has been sent.';
						$cls = 'updated';
					}
					else
					{
						$msg = 'Something went wrong. <br/> You can write directly to <strong>'.$to.'</strong>';
						$cls = 'error';
					}
				}
				//print_r(error_get_last());
			}
			else
			{
				$msg = 'All fields are required'; 
				$cls = 'error';
			}
			echo $msg;
			die();
			//echo '<div class="'.$cls.' wpsm-message">'.$msg.'</div>';
		}
	}
}
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');
if(class_exists('menu_shortcode'))
{
	$menu_shortcode = new menu_shortcode;
}

?>