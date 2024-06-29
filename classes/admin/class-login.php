<?php
namespace devfolio;

class LoginConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('login_head', [$this, 'setFavicon']);
        add_action('login_enqueue_scripts', [$this, 'setLoginLogo']);
    }

    /**
     * set custom favicon on login screen
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
     * set custom logo on login screen
     *
     * @return void
     */
    public function setLoginLogo()
    {
        $logo_path = dirname(get_template_directory_uri()) . '/public/logo.svg'; ?>
        <style>
            #login h1 a {
                width: 200px;
                height: 150px;
                background-image: url(<?php echo $logo_path; ?>);
                background-position: center;
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }
        </style>
        <?php
    }
}

new LoginConfig();
