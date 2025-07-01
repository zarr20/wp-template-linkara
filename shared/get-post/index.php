<?php
// $current_lang_slug = "/" . (pll_current_language('slug') && pll_current_language('slug'));
if (function_exists('pll_current_language')) {
    $current_lang_slug = "/" . pll_current_language('slug');
}
$base_url = [get_site_url(), get_home_url()];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$domain = $_SERVER['HTTP_HOST'];
$current_url = esc_url($protocol . $domain . $_SERVER['REQUEST_URI']);
$relative_path = str_replace($base_url, '', $current_url);
// echo $relative_path;
// exit;
if (function_exists('pll_current_language')) {
    $relative_path = str_replace($current_lang_slug, '', $relative_path);
}
$path_segments = explode('/', trim($relative_path, '/'));
// print_r($path_segments);
// exit;

$total_segment = count($path_segments);

if ($total_segment == 2 && strpos($path_segments[1], '?') !== 0) { //detail
    $slug_page = $path_segments[0];
    $slug_content = $path_segments[1];
    // $post = get_page_by_path($slug_content, OBJECT, $slug_content);
    // $page = get_page_by_path($slug_page, OBJECT, 'page');
    // if ($post || $page) {
    //     if ($post) {
    //         echo "Post found with slug: {$slug}, ID: {$post->ID}";
    //     }
    //     if ($page) {
    //         echo "Page found with slug: {$slug}, ID: {$page->ID}";
    //     }
    // }
    // setup_postdata($page);

    header("HTTP/1.1 200 OK");
    include get_template_directory() . "/pages/$slug_page/detail/index.php";
} else {
    if (have_posts()) {
        header("HTTP/1.1 200 OK");
        while (have_posts()):
            the_post();
            the_content();
        endwhile;
    } else {

        include get_template_directory() . "/shared/utilities/pages/404/index.php";
    }
}
wp_reset_postdata();
