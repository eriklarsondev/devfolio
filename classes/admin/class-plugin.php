<?php
namespace devfolio;

class RequiredPluginConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('admin_init', [$this, 'initRequiredPlugins']);
        }
    }

    /**
     * init required plugins
     *
     * @return void
     */
    public function initRequiredPlugins()
    {
        $this->isPluginActive('ACF', 'advanced custom fields');
    }

    /**
     * check to see if plugin is installed and active
     *
     * @param string $class_name
     * @param string $plugin_name
     * @return boolean
     */
    private function isPluginActive($class_name, $plugin_name)
    {
        if (!class_exists($class_name)) {
            add_action('admin_notices', function () use ($plugin_name) {
                $url = $this->getSearchQuery($plugin_name); ?>
                <div class="notice notice-error">
                    <p>
                        <strong><?php echo $plugin_name; ?></strong> was not found.
                        Click <a href="<?php echo $url; ?>">here</a> to install or activate this plugin.
                    </p>
                </div>
                <?php
            });
            return false;
        }
        return true;
    }

    /**
     * get search query url to install or activate plugin
     *
     * @param string $plugin_name
     * @return string
     */
    private function getSearchQuery($plugin_name)
    {
        $query = parent::formatLabel($plugin_name, '%20', false);

        $url = admin_url('plugin-install.php') . "?s=$query";
        $url .= '&tab=search&type=term';

        return $url;
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
        add_action('admin_init', function () use ($class_name, $plugin_name) {
            (new self(true))->isPluginActive($class_name, $plugin_name);
        });
    }
}

new RequiredPluginConfig();
