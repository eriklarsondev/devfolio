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
        $this->addPostType(
            'content block',
            (object) [
                'icon' => 'editor aligncenter',
                'features' => 'title, editor',
            ]
        );

        $this->addPostType(
            'html snippet',
            (object) [
                'collection' => 'HTML snippets',
                'icon' => 'html',
                'features' => 'title, editor',
            ]
        );
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
            'can_export' => true,
            'capability_type' => 'post',
            'delete_with_user' => false,
            'description' => isset($config->description) ? $config->description : null,
            'exclude_from_search' => false,
            'has_archive' => false,
            'hierarchical' => false,
            'labels' => $this->getPostLabels(
                $post_type,
                isset($config->collection) ? $config->collection : null
            ),
            'menu_icon' => isset($config->icon)
                ? 'dashicons-' . parent::formatLabel($config->icon, '-', false)
                : 'dashicons-admin-plugins',
            'menu_position' => isset($config->order) ? (int) $config->order : null,
            'public' => true,
            'publicly_queryable' => false,
            'query_var' => $id,
            'rest_base' => isset($config->collection)
                ? parent::formatLabel($config->collection, '-', false)
                : parent::formatLabel($post_type . 's', '-', false),
            'rest_namespace' => 'collections',
            'rewrite' => [
                'slug' => isset($config->collection)
                    ? '/collections/' . parent::formatLabel($config->collection, '-', false)
                    : '/collections/' . parent::formatLabel($post_type . 's', '-', false),
            ],
            'show_in_admin_bar' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'show_ui' => true,
            'supports' => isset($config->features)
                ? $this->getPostFeatures($config->features)
                : $this->getPostFeatures(),
            'taxonomies' =>
                isset($config->categories) && (bool) $config->categories === true
                    ? ['category']
                    : [],
        ];
        register_post_type($id, $args);
    }

    /**
     * unregister existing custom post type
     *
     * @param string $post_type
     * @param boolean $prefix
     * @return void
     */
    private function removePostType($post_type, $prefix = true)
    {
        $id = parent::formatLabel($post_type, '_', $prefix);
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

    /**
     * get default supported post features
     *
     * @param string $supported
     * @return array
     */
    private function getPostFeatures($supported = '')
    {
        $features = [];
        if ($supported) {
            $arr = explode(',', $supported);
            for ($i = 0; $i < count($arr); $i++) {
                array_push($features, parent::formatLabel(trim($arr[$i]), '-', false));
            }
        } else {
            $features = [
                'title',
                'editor',
                'comments',
                'revisions',
                'trackbacks',
                'author',
                'excerpt',
                'page-attributes',
                'thumbnail',
                'custom-fields',
                'post-formats',
            ];
        }
        return $features;
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
     * static wrapper to unregister custom post type
     *
     * @param string $post_type
     * @param boolean $prefix
     * @return void
     */
    static function remove_post_type($post_type, $prefix = true)
    {
        add_action('init', function () use ($post_type, $prefix) {
            (new self(true))->removePostType($post_type, $prefix);
        });
    }
}

new CustomPostTypeConfig();
