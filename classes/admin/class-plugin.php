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
        }
    }

    /**
     * init required plugins
     *
     * @return void
     */
    public function initRequiredPlugins()
    {
    }
}

new RequiredPluginConfig();
