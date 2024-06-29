<?php
namespace devfolio;

include_once __DIR__ . '/util/class-base.php';

include_once __DIR__ . '/theme/class-enqueue.php';
include_once __DIR__ . '/theme/class-excerpt.php';
include_once __DIR__ . '/theme/class-font.php';
include_once __DIR__ . '/theme/class-menu.php';
include_once __DIR__ . '/theme/class-post.php';
include_once __DIR__ . '/theme/class-redirect.php';
include_once __DIR__ . '/theme/class-sidebar.php';
include_once __DIR__ . '/theme/class-support.php';
include_once __DIR__ . '/theme/class-theme.php';

include_once __DIR__ . '/admin/class-admin.php';
include_once __DIR__ . '/admin/class-customizer.php';
include_once __DIR__ . '/admin/class-editor.php';
include_once __DIR__ . '/admin/class-login.php';
include_once __DIR__ . '/admin/class-plugin.php';
include_once __DIR__ . '/admin/class-toolbar.php';

class Devfolio
{
    /**
     * constructor
     */
    public function __construct()
    {
    }

    /**************************************************************************
     *** static wrapper methods for required plugin config
     *************************************************************************/

    /**
     * static wrapper to check to see if plugin is installed and active
     *
     * @param string $class_name
     * @param string $plugin_name
     * @return void
     */
    static function require_plugin($class_name, $plugin_name)
    {
        RequiredPluginConfig::require_plugin($class_name, $plugin_name);
    }

    /**************************************************************************
     *** static wrapper methods for menu location config
     *************************************************************************/

    /**
     * static wrapper to register new menu location
     *
     * @param string $menu_name
     * @return void
     */
    static function add_menu($menu_name)
    {
        MenuLocationConfig::add_menu_location($menu_name);
    }

    /**
     * static wrapper to unregister existing menu location
     *
     * @param string $menu_name
     * @return void
     */
    static function remove_menu($menu_name)
    {
        MenuLocationConfig::remove_menu_location($menu_name);
    }

    /**************************************************************************
     *** static wrapper methods for custom post type config
     *************************************************************************/

    /**
     * static wrapper to register new custom post type
     *
     * @param string $post_type
     * @param object $config
     * @return void
     */
    static function add_post_type($post_type, $config)
    {
        CustomPostTypeConfig::add_post_type($post_type, $config);
    }

    /**
     * static wrapper to unregister custom post type
     *
     * @param string $post_type
     * @return void
     */
    static function remove_post_type($post_type)
    {
        CustomPostTypeConfig::remove_post_type($post_type);
    }

    /**************************************************************************
     *** static wrapper methods for sidebar/widget location config
     *************************************************************************/

    /**
     * static wrapper to register new sidebar/widget location
     *
     * @param string $sidebar_name
     * @param string $description
     * @return void
     */
    static function add_sidebar($sidebar_name, $description = '')
    {
        SidebarLocationConfig::add_sidebar_location($sidebar_name, $description);
    }

    /**
     * static wrapper to unregister sidebar/widget location
     *
     * @param string $sidebar_name
     * @return void
     */
    static function remove_sidebar($sidebar_name)
    {
        SidebarLocationConfig::remove_sidebar_location($sidebar_name);
    }

    /**************************************************************************
     *** static wrapper methods for theme support config
     *************************************************************************/

    /**
     * static wrapper to register new theme support
     *
     * @param string $feature
     * @return void
     */
    static function add_support($feature)
    {
        ThemeSupportConfig::add_theme_support($feature);
    }

    /**
     * static wrapper to unregister existing theme support
     *
     * @param string $feature
     * @return void
     */
    static function remove_support($feature)
    {
        ThemeSupportConfig::remove_theme_support($feature);
    }
}
