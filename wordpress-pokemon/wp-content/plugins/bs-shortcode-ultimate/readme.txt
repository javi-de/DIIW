=== Bootstrap Shortcodes Ultimate ===
Contributors: mdshuvo
Tags: CSS, bootstrap 4, Twitter Bootstrap, Twitter Bootstrap Javascript, Bootstrap CSS, WordPress Bootstrap,bootstrap4,bs4,grid,bootstrap grid,bootstrap shortcodes for wordpress, Bootstrap Shortcodes
Tested up to: 5.7.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple Plugin for Enqueue Bootstrap 4 CSS, JS, and Some Helpful WordPress Shortcodes for visual usages.

== Description ==
Simple Plugin for Enqueue Bootstrap 4 CSS, JS, and Some Helpful WordPress Shortcodes for visual usages.

### ShortCode List

# Container Fluid
<pre>[containerfluid] contents [/containerfluid]</pre>

# Container 
<pre>[container] contents [/container]</pre>

# Row
<pre>[row] contents [/row]</pre>

# Equal Columns
<pre>[col] contents [/col]</pre>

# Colunm for Extra small Devices - screen width:  <576px
<pre>[col num="12"] contents [/col]</pre>

# Colunm for small Devices - screen width: >=576px
<pre>[col sm="12"] contents [/col]</pre>

# Colunm for Medium Devices - screen width: >=768px
<pre>[col md="12"] contents [/col]</pre>

# Colunm for Large Devices - screen width: ≥992px
<pre>[col lg="12"] contents [/col]</pre>

# Colunm for Extra Large Devices - screen width: ≥1200px
<pre>[col xl="12"] contents [/col]</pre>

# Colunm for Multi Devices
<pre>[col sm="3" md="6" xl="12"] contents [/col]</pre>

# Button Group
#### Parameters:
- class="" ( add extra class with 'btn-group' )


<pre>[btngroup]
	[button tag='button' href="#" type="button" style='primary']Button 1[/button]
	[button tag='button' href="#" type="button" style='primary']Button 2[/button]
[/btngroup]</pre>


# Buttons
#### Parameters:
- tag="button" ( button | a | input )
- href="#" ( any link you want to set. NB: tag should be 'a' )
- type="button" ( button | submit | etc. )
- style="primary" ( primary | secondary | success | info | warning | danger | dark | light | link ) <a target="_blank" href="https://www.w3schools.com/bootstrap4/bootstrap_buttons.asp">See Button Ref</a>


<pre>[button tag="button" href="#" type="button" style="primary"]Click Me[/button]</pre>


# Card
#### Parameters:
- class="" ( add extra class with 'card' )


<pre>[card class="mycard"]
	[cardtitle]
		This is title.
	[/cardtitle]

	[cardbody]
		This is card body really cool?
	[/cardbody]
[/card]</pre>

# Accordion
#### Parameters:
- id="" ( required: a unique id for working correctely )
- class="some-class" ( optional: if you need to add custom class for styling )
- title="This is the title of the accordion" ( described the title )
- open="no" ( optional: no | yes - Accordion item will be open or closed? by default: no )


<pre>[accordion id="unique-id" class="some-class" title="This is the title of the accordion" open="no"]

	Accordion Content will goes here

[/accordion]</pre>

### More Shortcodes Coming Soon

== Installation ==
1. Upload bootstrap-shortcode-ultimate.zip" to the "wp-content/plugins/" directory.
1. Activate the plugin through the "Plugins" menu in WordPress.

== Frequently Asked Questions ==
= Will you do more shortcodes? =
yes, i will in every update.


= What version of Bootstrap did you used? =
Latest (4.x)

= How can I add Buttons? =
<pre>[button tag="button" href="#" type="button" style="primary"]Click Me[/button]</pre> see description for more info

= How can I add Button Group? =
<pre>[btngroup]
	[button tag='button' href="#" type="button" style='primary']Button 1[/button]
	[button tag='button' href="#" type="button" style='primary']Button 2[/button]
[/btngroup]</pre>

== Screenshots ==
1. Button Styles
2. Accordion / Card

== Changelog ==

= 4.3.0 : 24 Feb 2021 =
* Capibility fixed
* Code improved

= 4.2.3 : 23 Feb 2020 =
* Fixed: Spaces/ tags removed inside shortcodes
* Button Group shortcode added
* Button shotcode added

= 4.2.2 : 22 Feb 2020 =
* Fixed: Spaces/ tags removed inside shortcodes
* Button Group shortcode added
* Button shotcode added


= 0.1 =
* Initial release.