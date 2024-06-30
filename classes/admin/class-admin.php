<?php
namespace devfolio;

class AdminConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        // disable theme/plugin file editor
        define('DISALLOW_FILE_EDIT', true);

        // disable auto updates for themes and plugins
        add_filter('auto_update_theme', '__return_false');
        add_filter('auto_update_plugin', '__return_false');

        add_action('admin_head', [$this, 'setFavicon']);

        add_action('admin_init', [$this, 'disableAdminPages']);
    }

    /**
     * set custom favicon for admin dashboard
     *
     * @return void
     */
    public function setFavicon()
    {
        $favicon_path = dirname(get_template_directory_uri()) . '/public/favicon.ico'; ?>
        <link rel="shortcut icon" href="<?php echo $favicon_path; ?>">
        <?php
    }

    /**
     * disable admin pages found in dashboard sidebar
     *
     * @return void
     */
    public function disableAdminPages()
    {
        remove_menu_page('edit-comments.php');
        remove_submenu_page('themes.php', 'edit.php?post_type=wp_block');
    }
}

new AdminConfig();
