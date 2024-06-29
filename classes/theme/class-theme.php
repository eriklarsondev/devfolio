<?php
namespace devfolio;

class ThemeConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('wp_head', [$this, 'setFavicon']);
    }

    /**
     * set custom favicon
     *
     * @return void
     */
    public function setFavicon()
    {
        $favicon_path = dirname(get_template_directory_uri()) . '/public/favicon.ico'; ?>
        <link rel="shortcut icon" href="<?php echo $favicon_path; ?>">
        <?php
    }
}

new ThemeConfig();
