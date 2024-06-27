<?php
namespace devfolio;

class ThemeSupportConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('after_setup_theme', [$this, 'initThemeSupport']);
        }
    }

    /**
     * init default theme support
     *
     * @return void
     */
    public function initThemeSupport()
    {
        $this->addThemeSupport('custom logo');
        $this->addThemeSupport('post thumbnails');
        $this->addThemeSupport('title tag');

        $this->removeThemeSupport('widgets block editor');
    }

    /**
     * register new theme support
     *
     * @param string $feature
     * @return void
     */
    private function addThemeSupport($feature)
    {
        $id = parent::formatLabel($feature, '-', false);
        add_theme_support($id);
    }

    /**
     * unregister existing theme support
     *
     * @param string $feature
     * @return void
     */
    private function removeThemeSupport($feature)
    {
        $id = parent::formatLabel($feature, '-', false);
        remove_theme_support($id);
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
    static function add_theme_support($feature)
    {
        add_action('after_setup_theme', function () use ($feature) {
            (new self(true))->addThemeSupport($feature);
        });
    }

    /**
     * static wrapper to unregister existing theme support
     *
     * @param string $feature
     * @return void
     */
    static function remove_theme_support($feature)
    {
        add_action('after_setup_theme', function () use ($feature) {
            (new self(true))->removeThemeSupport($feature);
        });
    }
}

new ThemeSupportConfig();
