<?php

function create_custom_post_type($post_type, $args = array())
{
    $defaults = array(
        'labels' => array(
            'name' => __('Portfolios', 'textdomain'),
            'singular_name' => __('Portfolio', 'textdomain')
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => $post_type),
        'supports' => array('title', 'editor', 'custom-fields', 'page-attributes'),
        'menu_icon' => 'dashicons-text-page',
        'taxonomies' => array('category'),
        'show_in_rest' => false,
        'menu_position' => 5,
    );

    $args = array_merge($defaults, $args);

    register_post_type($post_type, $args);
}

add_action('init', function () {
    // create_custom_post_type('blog', array(
    //     'labels' => array(
    //         'name' => __('Blogs', 'textdomain'),
    //         'singular_name' => __('Blog', 'textdomain'),
    //     ),
    // ));

    // create_custom_post_type('portfolio', array(
    //     'labels' => array(
    //         'name' => __('Portfolios', 'textdomain'),
    //         'singular_name' => __('Portfolio', 'textdomain'),
    //     ),
    //     'supports' => array('title', 'editor', 'custom-fields', 'page-attributes'),
    // ));

    // create_custom_post_type('liveweb', array(
    //     'labels' => array(
    //         'name' => __('Live Portfolios', 'textdomain'),
    //         'singular_name' => __('Live Portfolio', 'textdomain'),
    //     ),
    //     'supports' => array('title', 'custom-fields'),
    //     'publicly_queryable'  => false
    // ));
});
