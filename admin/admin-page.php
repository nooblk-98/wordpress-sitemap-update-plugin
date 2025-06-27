<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Save settings when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_settings'])) {
    check_admin_referer('update_sitemap_tag_settings', 'sitemap_tag_nonce');

    if (!empty($_POST['robots_txt'])) {
        file_put_contents(ABSPATH . 'robots.txt', sanitize_textarea_field($_POST['robots_txt']));
    }
    if (!empty($_POST['sitemap_xml'])) {
        file_put_contents(ABSPATH . 'sitemap.xml', sanitize_textarea_field($_POST['sitemap_xml']));
    }
    if (!empty($_POST['image_sitemap_xml'])) {
        file_put_contents(ABSPATH . 'image-sitemap.xml', sanitize_textarea_field($_POST['image_sitemap_xml']));
    }

    echo '<div class="updated"><p>Settings updated successfully.</p></div>';
}

// Retrieve saved values
?>

<div class="wrap">
    <h1>Sitemap Uploader by Lahiru</h1>
    <form method="post" enctype="multipart/form-data">
        <?php wp_nonce_field('update_sitemap_tag_settings', 'sitemap_tag_nonce'); ?>

        <div class="section">
            <h2>Upload Robots.txt</h2>
            <input type="file" name="robots_txt" accept=".txt" />
            <p>Current Robots.txt content:</p>
            <pre><?php echo file_exists(ABSPATH . 'robots.txt') ? esc_html(file_get_contents(ABSPATH . 'robots.txt')) : 'No file uploaded yet.'; ?></pre>
        </div>

        <div class="section">
            <h2>Upload XML Sitemap</h2>
            <input type="file" name="sitemap_xml" accept=".xml" />
            <p>Current Sitemap.xml content:</p>
            <pre><?php echo file_exists(ABSPATH . 'sitemap.xml') ? esc_html(file_get_contents(ABSPATH . 'sitemap.xml')) : 'No file uploaded yet.'; ?></pre>
        </div>

        <div class="section">
            <h2>Upload Image Sitemap</h2>
            <input type="file" name="image_sitemap_xml" accept=".xml" />
            <p>Current Image Sitemap.xml content:</p>
            <pre><?php echo file_exists(ABSPATH . 'image-sitemap.xml') ? esc_html(file_get_contents(ABSPATH . 'image-sitemap.xml')) : 'No file uploaded yet.'; ?></pre>
        </div>

        <p><input type="submit" name="update_settings" class="button-primary" value="Save Changes"></p>
    </form>
</div>



