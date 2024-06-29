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
        $this->isPluginActive('Advanced Custom Fields', 'ACF');
    }

    /**
     * check to see if plugin is installed and active
     *
     * @param string $plugin_name
     * @param string $class_name
     * @return boolean
     */
    private function isPluginActive($plugin_name, $class_name = '')
    {
        if ($class_name) {
            if (!class_exists($class_name)) {
                $this->renderNotification($plugin_name);
                return false;
            }
            return true;
        } else {
            $plugin_names = [];
            $plugins = get_plugins();

            foreach ($plugins as $plugin) {
                array_push($plugin_names, $plugin['Name']);
            }

            if (!in_array($plugin_name, $plugin_names)) {
                $this->renderNotification($plugin_name);
                return false;
            }
            return true;
        }
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

    /**
     * render notification
     *
     * @param string $plugin_name
     * @return void
     */
    private function renderNotification($plugin_name)
    {
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
    }

    /**************************************************************************
     *** static wrapper methods for required plugin config
     *************************************************************************/

    /**
     * static wrapper to check to see if plugin is installed and active
     *
     * @param string $plugin_name
     * @param string $class_name
     * @return void
     */
    static function require_plugin($plugin_name, $class_name = '')
    {
        add_action('admin_init', function () use ($plugin_name, $class_name) {
            (new self(true))->isPluginActive($plugin_name, $class_name);
        });
    }
}

new RequiredPluginConfig();
