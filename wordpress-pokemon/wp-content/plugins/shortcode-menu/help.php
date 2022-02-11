<?php
function shortcode_menu_help()
{
?>
	<div id="menu-short-page" class="wrap">
    	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
        <h2>Shortcode Menu Help</h2>
        <div class="clear"></div>
        
		<?php 
			$items = wp_get_nav_menus(); 
			$count = count($items);if($count==0)
			{
				echo '<div class="error padding">It seems you don\'t have any menu\'s created yet.<br/> Please create your menu <a href="./nav-menus.php">here</a>.</div>';	
			}
		?>
        
        <div class="postbox-container">
            <div class="postbox">
                <table id="create_table">
                    <tr>
                        <th colspan="2">Create Your Shortcode</th>
                    </tr>
                    <tr>
                        <td width="50%"><label>Select Menu</label></td>
                        <td>
                            <select id="menu_name" onchange="generate_shortcode()">
                                        <option value="Select">-- Select Menu --</option>
                                <?php
                                    foreach($items as $item)
                                    {
                                ?>
                                        <option value="<?php echo $item->name ?>"><?php echo $item->name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label>Menu ID (Optional)</label></td>
                        <td><input type="text" class="full_text" value="" id="shortcode_id" placeholder="Menu ID" onchange="generate_shortcode();" /></td>
                    </tr>
                    
                    <tr>
                        <td><label>Menu Class (Optional)</label></td>
                        <td><input type="text" class="full_text" value="" id="shortcode_class" placeholder="Menu Class" onchange="generate_shortcode();"/></td>
                    </tr>
                    
					<!--<tr>
                        <td>List Style (Optional)<div class="example">( Ordered | Unordered )</div></td>
                        <td><label for="shortcode_list"><input type="checkbox" id="shortcode_list"/> Ordered List Style (Defualt Unordered)</label></td>
                    </tr>-->
                    
                    
                    <tr>
                        <td>Display Style (Optional)<div class="example">( block | inline )</div></td>
                        <td><input type="checkbox" id="shortcode_display"/><label for="shortcode_display"> Display Inline (Defualt Block)</label></td>
                    </tr>
                    
                    <tr>
                        <td>Enhance (Optional) <div class="example">( true | false )</div></td>
                        <td><input checked="checked" type="checkbox" id="shortcode_enhance"/><label for="shortcode_enhance"> Enhance List (Defualt true)</label></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2" class="wpsm-highlighter-row"><span>Design your menu on fly</span></td>
                    </tr>
                    
                    <tr>
                        <td>Menu Background Color (Optional)</td>
                        <td><input type="text" value="#fff" id="wpsm-color-field" class="color-picker" /><input type="checkbox" checked="checked" id="wpsm-color-field-check" class="field-check"/><label for="wpsm-color-field-check"> Disable</label></td>
                    </tr>
                    
                    <tr>
                        <td>Menu Anchor Color (Optional)</td>
                        <td><input type="text" value="#fff" id="wpsm-anchor-color-field" class="color-picker"/><input type="checkbox" checked="checked" id="wpsm-anchor-color-field-check" class="field-check" /><label for="wpsm-anchor-color-field-check"> Disable</label></td>
                    </tr>
                    
                    <tr>
                        <td>Menu Anchor Hover Color (Optional)</td>
                        <td><input type="text" value="#fff" id="wpsm-anchor-hover-color-field" class="color-picker"/><input type="checkbox" checked="checked" id="wpsm-anchor-hover-color-field-check" class="field-check" /><label for="wpsm-anchor-hover-color-field-check"> Disable</label></td>
                    </tr>
                    
                    <tr class="hide-field">
                        <td>Sub Menu Background Color (Optional)</td>
                        <td><input type="text" value="#000" id="wpsm-submenu-color-field" class="color-picker"/><input type="checkbox" id="wpsm-submenu-color-field-check" class="field-check" /><label for="wpsm-submenu-color-field-check"> Disable</label><br/> 
                        <span>Opacity:</span> <input type="text" value="0.8" id="wpsm-submenu-transparency" style="width:2.5em" onchange="generate_shortcode();" /> <span>(Max: 1)</span></td>
                    </tr>
                
                    
                    <tr class="hide-field">
                        <td>Sub Menu Anchor Color (Optional)</td>
                        <td><input type="text" value="#e0e0e0" id="wpsm-submenu-anchor-color-field" class="color-picker" /><input type="checkbox" id="wpsm-submenu-anchor-color-field-check" class="field-check" /><label for="wpsm-submenu-anchor-color-field-check"> Disable</label></td>
                    </tr>
                    
                    <tr class="hide-field">
                        <td>Sub Menu Anchor Hover Color (Optional)</td>
                        <td><input type="text" value="#fff" id="wpsm-submenu-anchor-hover-color-field" class="color-picker" /><input type="checkbox" id="wpsm-submenu-anchor-hover-color-field-check" class="field-check" /><label for="wpsm-submenu-anchor-hover-color-field-check"> Disable</label></td>
                    </tr>
                    
                    <tr class="hide-field">
                        <td>Enable arrow (Optional)</div></td>
                        <td><input checked="checked" type="checkbox" id="shortcode_arrow" class="field-check"/><label for="shortcode_arrow"> Menu Arrow (Defualt true)</label></td>
                    </tr>
                    
                    <tr class="hide-field">
                        <td>Custom CSS (Optional)</div></td>
                        <td><textarea id="sm_custom_css" name="sm_custom_css" onchange="generate_shortcode();"></textarea></td>
                    </tr>
                    <tr>
                    	<td colspan="2" class="wpsm-highlighter-row"><span>Responsive Menu</span></td>
                    </tr>
                    <tr class="hide-field">
                        <td>Responsive Menu</div></td>
                        <td><input type="checkbox" id="shortcode_is_mobile" checked="checked" onchange="generate_shortcode(); toggle_breakpoint();"/> <label for="shortcode_is_mobile">Enable</label></td>
                    </tr>
                    <tr class="breakpoint-field">
                        <td>Display Mobile Menu Breakpoint (Optional)</div></td>
                        <td><input type="number" id="shortcode_mobile_breakpoint" placeholder="650" onchange="generate_shortcode();"/>px (Defualt 650px)</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <p id="help-text" style="font-size:x-small"></p>
                        <textarea class="sm-area" readonly="readonly" id="shortcode"></textarea></td>
                    </tr>
                    
                </table>
            </div><!-- .postbox -->
      	</div><!-- .postbox-container -->
		
        <div class="postbox-container">
            	<div class="postbox">
                    <h3>Connect with me</h3>
                    
                    <div class="inner">
                    	<div id="server_msg"></div>
                    	<form method="post" id="wpsm_support_form">
                        	<div class="field field-last">
                            	<label for="your_name">Your name</label>
                            	<input type="text" id="your_name" required="required" name="your_name" placeholder="Your name"/>
                         	</div>
                            <div class="field field-last">
                            	<label for="your_email">Your Email</label>
                            	<input type="text" id="your_email" name="your_email" required="required" placeholder="Your email"/>
                           	</div>
                            <div class="field field-last">
                            	<label for="your_message">Your Message</label>
                            	<textarea id="your_message" name="your_message" required="required" placeholder="Your message"></textarea>
                           	</div>
                        </form>
                        <div class="field field-last">
                            <input type="button" name="wpsm_submit" id="wpsm_submit" onclick="send_support()" value="Send" class="button"/>
                        </div>
                    </div>
             	</div>
      	</div>
        
        <div class="postbox-container">
            <div class="postbox">
            	<h3>Donation</h3>
                <div class="field field-last">
                    <form id="paypal_form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                    	Enjoyed this plugin? You can donate to this plugin using PayPal. Click to donate.<br/>
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="6KENHJ854VL7J">
                        <input type="image" class="donate" src="<?php echo plugins_url('/images/donate.png',__FILE__); ?>" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
              	</div>
          	</div>
     	</div> 
        
        <div class="postbox-container">
            	<div class="postbox">
                    <h3>Are you CSS lover? Customize your menu (Add in your theme's style.css)</h3>
                    
                    <div class="inner">
                        <code>
                    	<strong>/* style main menu */</strong></code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li
                        {
                        
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li:hover
                        {
                        
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li a
                        {
                        
                        }
                        </code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li:hover a
                        {
                        
                        }
                        </code>
                        <code>
                        <strong>/* style sub menus */</strong></code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li ul.sub-menu
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li ul.sub-menu li
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li ul.sub-menu li:hover
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li ul.sub-menu li a
                        {
                        
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS li ul.sub-menu li:hover a
                        {
                        
                        }</code>
                        <code>
                        <strong>/* style arrows */</strong></code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS ul.wpsm-arrow-enabled:before
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS ul.wpsm-arrow-enabled.wpsm-left-arrow:before
                        {
                            
                        }</code>
                        <code>
                        ul.shortcode_menu.YOUR_MENU_CLASS ul.wpsm-arrow-enabled.wpsm-up-arrow:before
                        {
                        
                        }
                        </code>
                        <code><strong>/* sub menu without arrow */</strong></code>
                        <code>
                        .shortcode_menu.wpsm-menu.menu_enhance ul
                        {
                            
                        }</code>
                        <code><strong>/* enhance sub menu with arrow */</strong></code>
                        <code>
                        .shortcode_menu.wpsm-menu.menu_enhance ul.wpsm-arrow-enabled.wpsm-left-arrow
                        {
                            
                        }</code>
                        <code>
                        .shortcode_menu.wpsm-menu.menu_enhance ul.wpsm-arrow-enabled.wpsm-left-arrow ul.wpsm-arrow-enabled.wpsm-left-arrow
                        {
                            
                        }</code>
                        <code><strong>/* inline sub menu without arrow */</strong></code>
                        <code>
                        .shortcode_menu.wpsm-menu.enhance_shortcode_menu_inline ul
                        {
                            
                        }</code>
                        <code>
                        .shortcode_menu.wpsm-menu.enhance_shortcode_menu_inline ul ul
                        {
                            
                        }</code>
                        <code><strong>/* inline sub menu with arrow */</strong></code>
                        <code>
                        .shortcode_menu.wpsm-menu.enhance_shortcode_menu_inline ul.wpsm-arrow-enabled.wpsm-up-arrow
                        {
                           
                        }</code>
                        <code>
                        .shortcode_menu.wpsm-menu.enhance_shortcode_menu_inline ul.wpsm-arrow-enabled.wpsm-left-arrow
                        {
                            
                        }</code>
                        
                    </div>
               
           		</div><!-- .postbox -->
        	</div><!-- .postbox-container -->
             
        
        <div class="postbox-container">
            	<div class="postbox">
                    <h3>Supported Attributes</h3>
                    
                    <table cellspacing="10px">
                        <tr>
                            <td><strong>menu</strong></td> 
                            <td>: Name or Slug of the menu. (required) </td>
                        </tr>
                        <tr>
                            <td><strong>id</strong></td> 
                            <td>: Used to set id to menu. (optional)</td>
                        </tr>
                        <tr>
                            <td><strong>class</strong></td> 
                            <td>: Used to set class to menu (optional)</td>
                        </tr>
                        
                        <!--<tr>
                            <td><strong>list</strong></td> 
                            <td>: To display <em>oredered</em> or <em>unordered list</em> (default : ul)
                            	<span id="list_help" class="help_button" onclick="show_help(this.id)"><img src="<?php //echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>-->
                        <tr>
                            <td><strong>display</strong></td> 
                            <td>: To display <em>inline</em> or <em>block</em> (default : block)
                            	<span id="display_help" class="help_button" onclick="show_help(this.id)"><img src="<?php echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>enhance</strong></td> 
                            <td>: To style Sub Menu's
                            	<span id="sub_menu_help" class="help_button" onclick="show_help(this.id)"><img src="<?php echo plugins_url('/images/q-icon.png',__FILE__); ?>"/></span>
                            </td>
                        </tr>
                    </table>
               
           		</div><!-- .postbox -->
        	</div><!-- .postbox-container -->
            
           
           
           
    </div><!-- wrap -->
    
  	<!-------------------------------- Modals ------------------------------------>
    
    <div id="display_help_content" class="plugin_text hide">
    	You can display your menu inline. Default is <strong><em>block</em></strong>.<br/>
        For Example : <br/>
        <img src="<?php echo plugins_url('/images/inline.png',__FILE__); ?>"/>
        
    </div>
    
    
	<div id="list_help_content" class="plugin_text hide">
    	To display menu in Ordered or Unordered List.
        By default it is <strong><em>unordered</em></strong>.<br/><br/>
        For Example : <br/></br>
        <div class="alignleft" style="margin-right:2em;">
            <h3 class="mshort-h3">Simple Ordered Menu</h3>
            <img src="<?php echo plugins_url('/images/ol-simple.png',__FILE__); ?>"/>
        </div>
        
        <div class="alignright">
            <h3 class="mshort-h3">Enhance Ordered Menu</h3>
            <img src="<?php echo plugins_url('/images/ol-enhance.png',__FILE__); ?>"/>
        </div>
        <div class="clear"></div>
    </div>
    
    <div id="sub_menu_help_content" class="plugin_text hide">
    	For better and effective styling.
        By default it is <strong><em>true</em></strong>.<br/><br/>
        For Example : <br/></br>
        <div class="alignleft" style="margin-right:2em;">
            <h3 class="mshort-h3">Simple Menu</h3>
            <img src="<?php echo plugins_url('/images/simple.jpg',__FILE__); ?>"/>
        </div>
        
        <div class="alignright">
            <h3 class="mshort-h3">Enhance Menu</h3>
            <img src="<?php echo plugins_url('/images/simple-enhance.png',__FILE__); ?>"/>
        </div>
        <div class="clear"></div>
    </div>
    
    <script type="text/javascript">
    	function generate_shortcode()
		{
			var menu = jQuery('#menu_name option:selected').val();
			
			var shortcode_id = jQuery('#shortcode_id').val();
			var shortcode_class = jQuery('#shortcode_class').val();
						
			var shortcode_start = '[shortmenu';
			var shortcode_end = ']';
			var shortcode_menu = ' menu="'+menu+'" ';
			
			if(shortcode_id != '')
				var shortcode_id = ' id="'+shortcode_id+'" ';
			else
				var shortcode_id = '';
			
			if(shortcode_class != '')
				var shortcode_class = ' class="'+shortcode_class+'" ';
			else
				var shortcode_class = '';
				
			if (jQuery('#shortcode_display').is(':checked')) 
				var shortcode_display = ' display="inline" ';
			else
				var shortcode_display = '';
				
			if (jQuery('#shortcode_list').is(':checked')) 
				var shortcode_list = ' list="ol" ';
			else
				var shortcode_list = '';
			
			if (jQuery('#shortcode_enhance').is(':checked')) 
			{
				var shortcode_enhance = ' enhance="true" ';
				jQuery('.hide-field').fadeIn('slow');
				var enhance_enable = true;
			}
			else
			{
				var shortcode_enhance = ' enhance="false" ';
				jQuery('.hide-field').fadeOut('slow');
				var enhance_enable = false;
			}
			
			
			if(jQuery('#shortcode_list').is(':checked'))
				var shortcode_list = ' list="ol" ';
			else
				var shortcode_list = '';
			
			if(!jQuery('#wpsm-color-field-check').is(':checked'))
			{	
				var menu_color = jQuery( '#wpsm-color-field' ).wpColorPicker( 'color' );
				if(menu_color != '')
					var shortcode_menu_color = ' menu_color="'+menu_color+'" ';
				else
					var shortcode_menu_color = '';
			}
			else
					var shortcode_menu_color = '';
			
			if(!jQuery('#wpsm-anchor-color-field-check').is(':checked'))
			{	
				var menu_anchor_color = jQuery( '#wpsm-anchor-color-field' ).wpColorPicker( 'color' );
				if(menu_anchor_color != '')
					var shortcode_menu_anchor_color = ' menu_anchor_color="'+menu_anchor_color+'" ';
				else
					var shortcode_menu_anchor_color = '';
			}
			else
					var shortcode_menu_anchor_color = '';
					
			if(!jQuery('#wpsm-anchor-hover-color-field-check').is(':checked'))
			{	
				var menu_anchor_hover_color = jQuery( '#wpsm-anchor-hover-color-field' ).wpColorPicker( 'color' );
				if(menu_anchor_hover_color != '')
					var shortcode_menu_anchor_hover_color = ' menu_anchor_hover_color="'+menu_anchor_hover_color+'" ';
				else
					var shortcode_menu_anchor_hover_color = '';
			}
			else
					var shortcode_menu_anchor_hover_color = '';
				
			if(!jQuery('#wpsm-submenu-color-field-check').is(':checked') && enhance_enable == true)
			{	
				var submenu_color = jQuery( '#wpsm-submenu-color-field' ).wpColorPicker( 'color' );
				if(submenu_color != '')
					var shortcode_submenu_color = ' submenu_color="'+submenu_color+'" ';
				else
					var shortcode_submenu_color = '';
			}
			else
					var shortcode_submenu_color = '';
			
			if(!jQuery('#wpsm-submenu-anchor-color-field-check').is(':checked') && enhance_enable == true)
			{	
				var submenu_anchor_color = jQuery( '#wpsm-submenu-anchor-color-field' ).wpColorPicker( 'color' );
				if(submenu_anchor_color != '')
					var shortcode_submenu_anchor_color = ' submenu_anchor_color="'+submenu_anchor_color+'" ';
				else
					var shortcode_submenu_anchor_color = '';
			}
			else
					var shortcode_submenu_anchor_color = '';
					
			if(!jQuery('#wpsm-submenu-anchor-hover-color-field-check').is(':checked') && enhance_enable == true)
			{	
				var submenu_anchor_hover_color = jQuery( '#wpsm-submenu-anchor-hover-color-field' ).wpColorPicker( 'color' );
				if(submenu_anchor_hover_color != '')
					var shortcode_submenu_anchor_hover_color = ' submenu_anchor_hover_color="'+submenu_anchor_hover_color+'" ';
				else
					var shortcode_submenu_anchor_hover_color = '';
			}
			else
					var shortcode_submenu_anchor_hover_color = '';
				
			var submenu_transparency = jQuery('#wpsm-submenu-transparency').val();
			if(submenu_transparency != ''  && enhance_enable == true)
				var submenu_transparency_code = ' submenu_transparency="'+submenu_transparency+'" ';
			else
				var submenu_transparency_code = '';
				
			if(enhance_enable == true)
			{
				if(!jQuery('#shortcode_arrow').is(':checked'))
					var shortcode_arrow = ' arrow="false" ';
				else
					var shortcode_arrow = ' arrow="true" ';
			}
			else
					var shortcode_arrow = '';
			var sm_custom_css = jQuery('#sm_custom_css').val();
			if(sm_custom_css != '')
				var shortcode_sm_custom_css = ' css="'+sm_custom_css+'" ';
			else
				var shortcode_sm_custom_css = '';
			
			if(jQuery('#shortcode_is_mobile').is(':checked'))
			{
				var sm_is_responsive = ' is_responsive="true" ';
				
				var sm_responsive_breakpoint = jQuery('#shortcode_mobile_breakpoint').val();
				if(sm_responsive_breakpoint != '')
					var shortcode_sm_responsive_breakpoint = ' responsive="'+sm_responsive_breakpoint+'" ';
				else
					var shortcode_sm_responsive_breakpoint = '';
			}
			else
			{
				var sm_is_responsive = ' is_responsive="false" ';
				var shortcode_sm_responsive_breakpoint = '';
			}
			
			
			
			var shortcode = shortcode_start+shortcode_menu+shortcode_id+shortcode_class+shortcode_display+shortcode_list+shortcode_enhance+shortcode_menu_color+shortcode_menu_anchor_color+shortcode_menu_anchor_hover_color+shortcode_submenu_color+shortcode_submenu_anchor_color+shortcode_submenu_anchor_hover_color+submenu_transparency_code+shortcode_arrow+sm_is_responsive+shortcode_sm_responsive_breakpoint+shortcode_sm_custom_css+shortcode_end;
			if(menu != 'Select')
			{
				jQuery('#help-text').html('Now just copy and paste anywhere');
				jQuery("#shortcode").fadeOut("fast", function()
				{
				  jQuery('#shortcode').text(shortcode).fadeIn('slow');
				});
			}
			else
			{
				jQuery('#shortcode').fadeOut('slow');
				jQuery('#shortcode').text('');
				jQuery('#help-text').html('');
			}
		}
		
		jQuery('#shortcode_display').click(function() {
			if (jQuery('#shortcode_display').is(':checked'))
			{
				jQuery('#shortcode_enhance').attr('checked',true);
			}
			generate_shortcode();
		});
		
		jQuery('#shortcode_enhance').click(function() {
			generate_shortcode();
		});
		
		jQuery('#shortcode_list').click(function() {
			generate_shortcode();
		});
		
		jQuery('.field-check').click(function() {
			generate_shortcode();
		});
		
		jQuery(document).ready(function($){
			var myOptions = {
				// you can declare a default color here,
				// or in the data-default-color attribute on the input
				defaultColor: false,
				// a callback to fire whenever the color changes to a valid color
				change: function(event, ui){
					var id = jQuery(this).attr('id');
					var id_check = id+'-check';
					jQuery('#'+id_check).attr('checked',false);
					generate_shortcode();
				},
				// a callback to fire when the input is emptied or an invalid color
				clear: function(event, ui) {
					generate_shortcode();
				},
				// hide the color picker controls on load
				hide: true,
				// show a group of common colors beneath the square
				// or, supply an array of colors to customize further
				palettes: true
			};
			$('.color-picker').wpColorPicker(myOptions);
			
			jQuery('.wp-picker-clear').click(function(){
				var id = jQuery(this).prev().attr('id');
				var check_id = id+'-check';
				jQuery('#'+check_id).attr('checked',true);
				generate_shortcode();
			});
			
			toggle_breakpoint();
		});
		
		function send_support()
		{
			var data = jQuery('#wpsm_support_form').serialize();
			data = 'action=wpsm_shortcode_menu_mail&'+data;
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('#server_msg').html('<div>'+response+'</div>');
			});
		}
		function toggle_breakpoint()
		{
			if(jQuery('#shortcode_is_mobile').is(':checked'))
				jQuery('.breakpoint-field').fadeIn('slow');
			else
				jQuery('.breakpoint-field').fadeOut('slow');
			generate_shortcode();
		}
    </script>
    
    <script type="text/javascript">
    	function show_help(id)
		{
			jQuery("#"+id+"_content").dialog({ 
				modal: true,
				title: "Help",
				width: 'auto',
				closeText: '&times;',
			});
		}
    </script>
<?php
}
?>