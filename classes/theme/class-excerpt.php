<?php
namespace devfolio;

class ExcerptConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_filter('excerpt_length', [$this, 'setExcerptLength']);
        add_filter('excerpt_more', [$this, 'setExcerptLink']);
    }

    /**
     * set word length of post excerpt
     *
     * @param integer $length
     * @return integer
     */
    function setExcerptLength($length)
    {
        return 40;
    }

    /**
     * set custom post excerpt link
     *
     * @param string $more
     * @return string
     */
    function setExcerptLink($more)
    {
        global $post;
        return '...';
    }
}

new ExcerptConfig();
