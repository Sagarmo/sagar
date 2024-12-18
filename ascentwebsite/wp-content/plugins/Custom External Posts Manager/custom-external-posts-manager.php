<?php
/**
 * Plugin Name: Custom External Posts Manager
 * Description: A plugin to manage 3 custom external posts with a shortcode for display.
 * Version: 1.0
 * Author: Your Name
 */

// Activation hook to create database table
register_activation_hook(__FILE__, 'cep_create_table');
function cep_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ang_custom_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        image_url TEXT NOT NULL,
        is_enabled TINYINT(1) NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Admin menu to manage custom posts
add_action('admin_menu', 'cep_register_menu');
function cep_register_menu() {
    add_menu_page(
        'Custom External Posts',
        'Custom Posts',
        'manage_options',
        'custom-posts',
        'cep_admin_page',
        'dashicons-admin-post',
        20
    );
}

function cep_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ang_custom_data';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_posts'])) {
        for ($i = 1; $i <= 3; $i++) {
            $title = sanitize_text_field($_POST["title_$i"]);
            $image_url = esc_url_raw($_POST["image_url_$i"]);
            $is_enabled = isset($_POST["is_enabled_$i"]) ? 1 : 0;

            if (empty($title) || empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) {
                echo '<div class="error"><p>Please ensure all fields are correctly filled for Post ' . $i . '.</p></div>';
                continue;
            }

            $wpdb->replace($table_name, [
                'id' => $i,
                'title' => $title,
                'image_url' => $image_url,
                'is_enabled' => $is_enabled
            ]);
        }
        echo '<div class="updated"><p>Posts saved successfully!</p></div>';
    }

    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id ASC", ARRAY_A);
    $posts = array_fill(0, 3, ["id" => '', "title" => '', "image_url" => '', "is_enabled" => 1]);
    foreach ($results as $result) {
        $posts[$result['id'] - 1] = $result;
    }
    ?>
    <div class="wrap">
        <h1>Manage Custom External Posts</h1>
        <form method="post">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <h2>Post <?php echo $i; ?></h2>
                <table class="form-table">
                    <tr>
                        <th><label for="title_<?php echo $i; ?>">Title</label></th>
                        <td><input name="title_<?php echo $i; ?>" id="title_<?php echo $i; ?>" type="text" value="<?php echo esc_attr($posts[$i - 1]['title']); ?>" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label for="image_url_<?php echo $i; ?>">Image URL</label></th>
                        <td><input name="image_url_<?php echo $i; ?>" id="image_url_<?php echo $i; ?>" type="url" value="<?php echo esc_url($posts[$i - 1]['image_url']); ?>" class="regular-text" required></td>
                    </tr>
                    <tr>
                        <th><label for="is_enabled_<?php echo $i; ?>">Enable</label></th>
                        <td><input name="is_enabled_<?php echo $i; ?>" id="is_enabled_<?php echo $i; ?>" type="checkbox" value="1" <?php checked($posts[$i - 1]['is_enabled'], 1); ?>></td>
                    </tr>
                </table>
            <?php endfor; ?>
            <p class="submit"><button type="submit" name="save_posts" class="button button-primary">Save Posts</button></p>
        </form>
    </div>
    <?php
}

/// Shortcode to display posts
add_shortcode('custom_external_posts', 'cep_display_posts');
function cep_display_posts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ang_custom_data';
    $posts = $wpdb->get_results("SELECT * FROM $table_name WHERE is_enabled = 1", ARRAY_A);

    if (empty($posts)) {
        return '<p>No posts available.</p>';
    }

    ob_start();
    echo '<div class="custom-external-posts">';
    foreach ($posts as $post) {
        echo '<div class="post">';
        echo '<img src="' . esc_url($post['image_url']) . '" alt="' . esc_attr($post['title']) . '">';
        echo '<h3>' . esc_html($post['title']) . '</h3>';
        echo '<a href="#" class="read-more-button">Read More</a>';
        echo '</div>';
    }
    echo '</div>';

    return ob_get_clean();
}


// Enqueue styles for the shortcode output
add_action('wp_enqueue_scripts', 'cep_enqueue_styles');
function cep_enqueue_styles() {
    wp_enqueue_style('cep-styles', plugin_dir_url(__FILE__) . 'styles.css');

}

?>
