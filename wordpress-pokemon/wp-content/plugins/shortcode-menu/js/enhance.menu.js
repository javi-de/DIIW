if (typeof yourvar != 'undefined')
	var show_arrow = false;
//var show_arrow = false;
$x = jQuery.noConflict();

$x(document).ready(function() {
	$x(".menu_enhance .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).addClass('wpsm-arrow-enabled');
			$x(this).addClass('wpsm-left-arrow');
		}
	});
	$x(".enhance_shortcode_menu_inline .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).addClass('wpsm-arrow-enabled');
			$x(this).addClass('wpsm-up-arrow');
		}
	});
	$x(".enhance_shortcode_menu_inline .sub-menu .sub-menu").each(function(index,element){
		if(show_arrow == 'true')
		{
			$x(this).removeClass('wpsm-up-arrow');
			$x(this).addClass('wpsm-left-arrow');
		}
	});
	
	$x('.wpsm-up-arrow').each(function(index,element){
		var pid = $x(this).parents('.shortcode_menu').attr('id');
		var w = $x(this).prev('a').width();
		$x('head').append('<style>#'+pid+' .wpsm-up-arrow:before { width : '+(w-10)+'px; }</style>');
	});
});
