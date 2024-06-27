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
    }
}

new AdminConfig();
