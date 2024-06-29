<?php
namespace devfolio;

class EditorConfig extends Base
{
    /**
     * constructor
     */
    public function __construct()
    {
        // restore classic text editor by disabling gutenberg editor
        add_filter('use_block_editor_for_post', '__return_false');

        add_filter('user_can_richedit', [$this, 'disableVisualEditor']);
    }

    /**
     * remove wysiwyg editor from text editor
     *
     * @param boolean $enabled
     * @return boolean
     */
    public function disableVisualEditor($enabled)
    {
        global $post;

        if ($post->post_type === parent::formatLabel('html snippet')) {
            return false;
        }
        return $enabled;
    }
}

new EditorConfig();
