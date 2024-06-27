<?php
namespace devfolio;

class CustomPostTypeConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initCustomPostTypes']);
        }
    }

    /**
     * init default custom post types
     *
     * @return void
     */
    public function initCustomPostTypes()
    {
    }

    /**
     * register new custom post type
     *
     * @param string $post_type
     * @param object $config
     * @return void
     */
    private function addPostType($post_type, $config)
    {
        $id = parent::formatLabel($post_type);

        $args = [
            'labels' => $this->getPostLabels(
                $post_type,
                isset($config->collection) ? $config->collection : null
            ),
        ];
        register_post_type($id, $args);
    }

    /**
     * unregister existing custom post type
     *
     * @param string $post_type
     * @return void
     */
    private function removePostType($post_type)
    {
        $id = parent::formatLabel($post_type);
        unregister_post_type($id);
    }

    /**
     * get default post labels
     *
     * @param string $post_type
     * @param string $collection
     * @return array
     */
    private function getPostLabels($post_type, $collection = '')
    {
        if (!$collection) {
            $collection = $post_type . 's';
        }
        $labels = [
            'name' => ucwords($collection),
            'singular' => ucwords($post_type),
        ];
        return $labels;
    }

    /**************************************************************************
     *** static wrapper methods for custom post type config
     *************************************************************************/

    /**
     * static wrapper to register new custom post type
     *
     * @param string $post_type
     * @param object $config
     * @return void
     */
    static function add_post_type($post_type, $config)
    {
        add_action('init', function () use ($post_type, $config) {
            (new self(true))->addPostType($post_type, $config);
        });
    }

    /**
     * static wrapper to unegister custom post type
     *
     * @param string $post_type
     * @return void
     */
    static function remove_post_type($post_type)
    {
        add_action('init', function () use ($post_type) {
            (new self(true))->removePostType($post_type);
        });
    }
}

new CustomPostTypeConfig();
