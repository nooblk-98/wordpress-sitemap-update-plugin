<?php
/**
 * Plugin Name: WP Sitemap & Robots Editor
 * Description: A plugin to update sitemaps, image sitemaps, robots.txt, and inject custom head and body tags via WordPress admin.
 * Version: 1.0.4
 * Author: Lahiru Liyanage (Weblankan)
 */

 function wpsitemaprobots_enqueue_styles() {
    wp_enqueue_style('wpsitemaprobots-style', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
}
add_action('admin_enqueue_scripts', 'wpsitemaprobots_enqueue_styles');


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include required files
require_once plugin_dir_path(__FILE__) . 'includes/class-sitemap-robots.php';

// Initialize the plugin
function wpsitemaprobots_init() {
    new WPSitemapRobotsEditor();
}
add_action('plugins_loaded', 'wpsitemaprobots_init');
?>
