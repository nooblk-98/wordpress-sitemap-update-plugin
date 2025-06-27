<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WPSitemapRobotsEditor {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'handle_form_submission'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'Sitemap Uploader by Lahiru',
            'Sitemap Uploader by Lahiru',
            'edit_others_posts',
            'wp_sitemap_tag_editor',
            array($this, 'admin_page'),
            'dashicons-admin-site',
            80
        );
    }

    public function admin_page() {
        include plugin_dir_path(__FILE__) . '../admin/admin-page.php';
    }

    public function handle_form_submission() {
        if (isset($_POST['update_settings']) && check_admin_referer('update_sitemap_tag_settings', 'sitemap_tag_nonce')) {
            // Handle Robots.txt upload
            if (isset($_FILES['robots_txt']) && !empty($_FILES['robots_txt']['tmp_name'])) {
                $robots_txt = $_FILES['robots_txt'];
                if ($robots_txt['type'] === 'text/plain') {
                    move_uploaded_file($robots_txt['tmp_name'], ABSPATH . 'robots.txt');
                    add_action('admin_notices', function() {
                        echo '<div class="updated"><p>Robots.txt file updated successfully.</p></div>';
                    });
                } else {
                    add_action('admin_notices', function() {
                        echo '<div class="error"><p>Please upload a valid robots.txt file.</p></div>';
                    });
                }
            }

            // Handle XML Sitemap upload
            if (isset($_FILES['sitemap_xml']) && !empty($_FILES['sitemap_xml']['tmp_name'])) {
                $sitemap_xml = $_FILES['sitemap_xml'];
                if ($sitemap_xml['type'] === 'application/xml' || $sitemap_xml['type'] === 'text/xml') {
                    move_uploaded_file($sitemap_xml['tmp_name'], ABSPATH . 'sitemap.xml');
                    add_action('admin_notices', function() {
                        echo '<div class="updated"><p>sitemap.xml file updated successfully.</p></div>';
                    });
                } else {
                    add_action('admin_notices', function() {
                        echo '<div class="error"><p>Please upload a valid sitemap.xml file.</p></div>';
                    });
                }
            }

            // Handle Image Sitemap upload
            if (isset($_FILES['image_sitemap_xml']) && !empty($_FILES['image_sitemap_xml']['tmp_name'])) {
                $image_sitemap_xml = $_FILES['image_sitemap_xml'];
                if ($image_sitemap_xml['type'] === 'application/xml' || $image_sitemap_xml['type'] === 'text/xml') {
                    move_uploaded_file($image_sitemap_xml['tmp_name'], ABSPATH . 'image-sitemap.xml');
                    add_action('admin_notices', function() {
                        echo '<div class="updated"><p>image-sitemap.xml file updated successfully.</p></div>';
                    });
                } else {
                    add_action('admin_notices', function() {
                        echo '<div class="error"><p>Please upload a valid image-sitemap.xml file.</p></div>';
                    });
                }
            }
        }
    }
}
