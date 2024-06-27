<?php
namespace devfolio;

class FileEnqueueConfig extends Base
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueStylesheets']);
        add_action('wp_footer', [$this, 'enqueueDeferredStylesheets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueJavascripts']);
    }

    /**
     * init default theme stylesheets
     *
     * @return void
     */
    public function enqueueStylesheets()
    {
    }

    /**
     * init default theme stylesheets using wp_footer hook
     *
     * @return void
     */
    public function enqueueDeferredStylesheets()
    {
    }

    /**
     * init default theme javascript files
     *
     * @return void
     */
    public function enqueueJavascripts()
    {
    }

    /**
     * register and enqueue new css stylesheet
     *
     * @param string $name
     * @param string $path
     * @param array $deps
     * @param string $vers
     * @return void
     */
    private function addStylesheet($name, $path, $deps = [], $vers = '0.1.0')
    {
    }

    /**
     * unregister and dequeue existing css stylesheet
     *
     * @param string $name
     * @param boolean $prefix
     * @return void
     */
    private function removeStylesheet($name, $prefix = true)
    {
        $id = parent::formatLabel($name, '-');
    }

    /**
     * register and enqueue new javascript file
     *
     * @param string $name
     * @param string $path
     * @param array $deps
     * @param string $vers
     * @return void
     */
    private function addJavascript($name, $path, $deps = [], $vers = '0.1.0')
    {
    }

    /**
     * unregister and dequeue existing javascript file
     *
     * @param string $name
     * @return void
     */
    private function removeJavascript($name)
    {
    }
}

new FileEnqueueConfig();
