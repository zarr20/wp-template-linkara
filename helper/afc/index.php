<?php
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Data Page Settings',
        'menu_title' => 'Data Page',
        'menu_slug'  => 'data-page',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ));
}


add_action('acf/input/admin_head', function () {
    $screen = get_current_screen();

    if ($screen && $screen->id === 'toplevel_page_data-page') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Collapse all postboxes
                $('.postbox').addClass('closed');

                // Keep the 'submitdiv' (Publish box) open
                $('#submitdiv').removeClass('closed');
            });
        </script>
        <?php
    }
});



include __DIR__ . "./fields/page-data/index.php";
