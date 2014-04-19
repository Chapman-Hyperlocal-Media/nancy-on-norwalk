<?php
/*
Plugin Name: Nancy on Norwalk snow effects
Plugin URI: 
Description: Activates a nifty animated snow effect in the header of the page.
Author: Eric Chapman	
Version: 1.0
Author URI: http://www.ericchapman.net/

Dependant on the Norwalk theme
*/

$params = array(
	pluginPath => get_bloginfo( 'template_url' )
);
wp_enqueue_script('norwalk-snow', plugins_url('/norwalk-snow-effects/norwalk-snow-effects.min.js'), array('jquery'));
wp_localize_script('norwalk-snow', 'snowData', $params);
?>