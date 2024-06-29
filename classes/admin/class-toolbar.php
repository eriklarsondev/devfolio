<?php
namespace devfolio;

class ToolbarConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('wp_before_admin_bar_render', [$this, 'setToolbarIcon']);
    }

    /**
     * set custom icon on admin toolbar
     *
     * @return void
     */
    public function setToolbarIcon()
    {
        $icon_path = dirname(get_template_directory_uri()) . '/public/icon.svg'; ?>
        <style>
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item {
                background-image: url(<?php echo $icon_path; ?>);
                background-position: center;
                background-size: 60% 60%;
                background-repeat: no-repeat;
            }

            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                content: '';
            }
        </style>
        <?php
    }
}

new ToolbarConfig();
