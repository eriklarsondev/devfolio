<?php
namespace devfolio;

class FontConfig
{
    /**
     * constructor
     */
    public function __construct()
    {
        add_action('wp_footer', [$this, 'initFontFaces']);
    }

    /**
     * append custom font faces to end of html document
     *
     * @return void
     */
    public function initFontFaces()
    {
        $path = dirname(get_template_directory_uri()) . '/fonts'; ?>
        <style>
            @font-face {
                font-family: 'PT Serif';
                font-weight: 400;
                font-display: swap;
                src:
                    url: ('<?php echo $path; ?>/PT_Serif/PTSerif-Regular.ttf') format('truetype');
            }

            @font-face {
                font-family: 'Roboto Condensed';
                font-weight: 300 400;
                font-display: swap;
                src:
                    url: ('<?php echo $path; ?>/Roboto_Condensed/RobotoCondensed-Light.ttf') format('truetype'),
                    url: ('<?php echo $path; ?>/Roboto_Condensed/RobotoCondensed-Regular.ttf') format('truetype');
            }
        </style>
        <?php
    }
}

new FontConfig();
