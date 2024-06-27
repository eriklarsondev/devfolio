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
        $path = dirname(get_template_directory_uri()) . '/dist/';

        $this->removeStylesheet('wp block library', false);
        $this->removeStylesheet('classic theme styles', false);
        $this->removeStylesheet('global styles', false);
    }

    /**
     * init default theme stylesheets using wp_footer hook
     *
     * @return void
     */
    public function enqueueDeferredStylesheets()
    {
        $path = dirname(get_template_directory_uri()) . '/dist/';

        $this->addStylesheet(
            'fontawesome',
            $path . '/vendor/@fortawesome/fontawesome-free/css/all.min.css',
            [],
            '6.5.2'
        );
        $this->addStylesheet('theme styles', $path . '/css/main.css');
    }

    /**
     * init default theme javascript files
     *
     * @return void
     */
    public function enqueueJavascripts()
    {
        $path = dirname(get_template_directory_uri()) . '/dist/';
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
        $id = parent::formatLabel($name, '-');

        if (count($deps)) {
            for ($i = 0; $i < count($deps); $i++) {
                $deps[$i] = parent::formatLabel($deps[$i], '-');
            }
        }
        wp_register_style($id, $path, $deps, $vers);
        wp_enqueue_style($id);
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
        $id = parent::formatLabel($name, '-', $prefix);
        wp_deregister_style($id);
        wp_dequeue_style($id);
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
        $id = parent::formatLabel($name, '-');

        if (count($deps)) {
            for ($i = 0; $i < count($deps); $i++) {
                $deps[$i] = parent::formatLabel($deps[$i], '-');
            }
        }
        wp_register_script($id, $path, $deps, $vers, true);
        wp_enqueue_script($id);
    }

    /**
     * unregister and dequeue existing javascript file
     *
     * @param string $name
     * @param boolean $prefix
     * @return void
     */
    private function removeJavascript($name, $prefix = true)
    {
        $id = parent::formatLabel($name, '-', $prefix);
        wp_deregister_script($id);
        wp_dequeue_script($id);
    }
}

new FileEnqueueConfig();
