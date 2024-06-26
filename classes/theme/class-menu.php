<?php
namespace devfolio;

class MenuLocationConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initMenuLocations']);
        }
    }

    /**
     * init default menu locations
     *
     * @return void
     */
    public function initMenuLocations()
    {
        $this->addMenuLocation('header menu');
        $this->addMenuLocation('social media bar');
    }

    /**
     * register new menu location
     *
     * @param string $menu_name
     * @return void
     */
    private function addMenuLocation($menu_name)
    {
        $id = parent::formatLabel($menu_name);
        register_nav_menu($id, __(ucwords($menu_name), $id));
    }

    /**
     * unregister existing menu location
     *
     * @param string $menu_name
     * @return void
     */
    private function removeMenuLocation($menu_name)
    {
        $id = parent::formatLabel($menu_name);
        unregister_nav_menu($id);
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
    static function add_menu_location($menu_name)
    {
        add_action('init', function () use ($menu_name) {
            (new self(true))->addMenuLocation($menu_name);
        });
    }

    /**
     * static wrapper to unregister existing menu location
     *
     * @param string $menu_name
     * @return void
     */
    static function remove_menu_location($menu_name)
    {
        add_action('init', function () use ($menu_name) {
            (new self(true))->removeMenuLocation($menu_name);
        });
    }
}

new MenuLocationConfig();
