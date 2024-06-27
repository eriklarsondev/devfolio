<?php
namespace devfolio;

class SidebarLocationConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initSidebarLocations']);
        }
    }

    /**
     * init default sidebar/widget location
     *
     * @return void
     */
    public function initSidebarLocations()
    {
        $this->addSidebarLocation('sidebar left');
        $this->addSidebarLocation('sidebar right');
    }

    /**
     * register new sidebar/widget location
     *
     * @param string $sidebar_name
     * @param string $description
     * @return void
     */
    private function addSidebarLocation($sidebar_name, $description = '')
    {
        $id = parent::formatLabel($sidebar_name);
        $args = [
            'name' => ucwords($sidebar_name),
            'id' => $id,
            'description' => $description,
        ];
        register_sidebar($args);
    }

    /**
     * unregister existing sidebar/widget location
     *
     * @param string $sidebar_name
     * @return void
     */
    private function removeSidebarLocation($sidebar_name)
    {
        $id = parent::formatLabel($sidebar_name);
        unregister_sidebar($id);
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
    static function add_sidebar_location($sidebar_name, $description = '')
    {
        add_action('init', function () use ($sidebar_name, $description) {
            (new self(true))->addSidebarLocation($sidebar_name, $description);
        });
    }

    /**
     * static wrapper to unregister sidebar/widget location
     *
     * @param string $sidebar_name
     * @return void
     */
    static function remove_sidebar_location($sidebar_name)
    {
        add_action('init', function () use ($sidebar_name) {
            (new self(true))->removeSidebarLocation($sidebar_name);
        });
    }
}

new SidebarLocationConfig();
