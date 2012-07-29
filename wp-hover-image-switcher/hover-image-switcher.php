<?php
/*=====================================================
 * Plugin Name:  Hover Image Switcher
 * Plugin URI:   http://ebenhale.com/hover-image-switcher
 * Version:      1.0.0
 * Description:  Lets you switch an image when the mouse hovers over the image and returns to the original image when the mouse leaves
 * Author:       Eben Hale
 * Author URI:   http://ebenhale.com/
 *====================================================*/

class hoverImageSwitcher {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	function __construct() {

		// // Define constants used throughout the plugin
		// //$this -> init_plugin_constants();
// 
		// load_plugin_textdomain(WP_PLUGIN_URL . '/wp-hover-image-switcher', false, dirname(plugin_basename(__FILE__)) . '/lang');

		add_action('wp_enqueue_scripts', array($this, 'register_scripts_and_styles'));
		add_action('init', array($this, 'add_button'));
		add_shortcode('his', array($this, 'his_shortcode'));
	}// end constructor


	function his_shortcode($atts, $content = null) {
		return '<div class="hover-image-switcher">' . $content . '</div>';
	}


	function add_button() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_external_plugins', array($this, 'add_plugin'));
			add_filter('mce_buttons', array($this, 'register_button'));
		}
	}


	function register_button($buttons) {
		array_push($buttons, "|", "his");
		return $buttons;
	}


	function add_plugin($plugin_array) {
		$plugin_array['his'] = WP_PLUGIN_URL . '/wp-hover-image-switcher/js/tinymce-button.js';
		return $plugin_array;
	}


	function add_admin_page() {

		add_submenu_page('plugins.php', 'Hover Image Switcher', 'Hover Image Switcher', 'manage_options', 'hover-image-switcher', array($this, 'admin_page'));
	
	}// end add_admin_page
	
	
	function admin_page() {
		
		require_once ('admin-page.php');
		
	}// end admin_page


	function register_scripts_and_styles() {
		
		wp_register_script('his', WP_PLUGIN_URL . '/wp-hover-image-switcher/js/hover-image-switcher.js', array('jquery'));
		wp_enqueue_script('his');
		
	}// end register_scripts_and_styles


}// End class hoverImageSwitcher


// Create a new instance off the class
if (class_exists("hoverImageSwitcher")) {
	$hoverimageswitcher = new hoverImageSwitcher();
}

if (isset($hoverimageswitcher)) {
	if (is_admin()) {

		//This will call the admin menu function that calls the option page function that has the html for the options page
		add_action('admin_menu', array($hoverimageswitcher, 'add_admin_page'));

	}
}
