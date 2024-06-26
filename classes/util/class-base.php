<?php
namespace devfolio;

class Base
{
    /**
     * constructor
     */
    public function __construct()
    {
    }

    /**
     * format label and set prefix if applicable
     *
     * @param string $label
     * @param string $divider
     * @param boolean $prefix
     * @return string
     */
    protected function formatLabel($label, $divider = '_', $prefix = true)
    {
        $formatted = trim(strtolower($label));
        $formatted = str_replace(' ', $divider, $formatted);

        if ($prefix) {
            if (substr($formatted, 0, 3) !== 'dev') {
                $formatted = 'dev' . $divider . $formatted;
            }
            return $formatted;
        }

        return $formatted;
    }
}
