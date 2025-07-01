<?php
function loadPageTemplateByPageName($atts)
{
    $atts = shortcode_atts(array(
        'name' => '',
    ), $atts, 'page');
    $pageName = $atts['name'];
    $customTemplate = get_template_directory() . "/pages/{$pageName}/index.php";
    if (file_exists($customTemplate)) {
        ob_start();
        include($customTemplate);
        return ob_get_clean();
    }
    return '<p>page not found!</p>';
}

add_shortcode('page', 'loadPageTemplateByPageName');
