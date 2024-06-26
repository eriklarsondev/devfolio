<?php
namespace devfolio;

class EditorConfig extends Base
{
    /**
     * constructor
     *
     * @param boolean $static
     */
    public function __construct($static = false)
    {
        // restore classic text editor by disabling gutenberg editor
        add_filter('use_block_editor_for_post', '__return_false');
    }
}

new EditorConfig();
