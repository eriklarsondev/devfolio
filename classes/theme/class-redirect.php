<?php
namespace devfolio;

class RedirectConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('template_redirect', [$this, 'redirect']);
    }

    /**
     * disable page routing by redirecting to homepage
     *
     * @return void
     */
    public function redirect()
    {
        if (!is_home() && !is_admin()) {
            wp_redirect(home_url(), 302);
        }
    }
}

new RedirectConfig();
