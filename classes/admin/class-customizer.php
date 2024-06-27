<?php
namespace devfolio;

class CustomizerConfig extends Base
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
}

new CustomizerConfig();
