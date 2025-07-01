<main role="main" class="container max-w-[680px]">
    <!-- section -->
    <section class="content-container">

        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>

                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <!-- post thumbnail -->
                    <?php if (has_post_thumbnail()): ?>
                        <?php
                        // Get the post thumbnail ID and registered image sizes
                        $image_id = get_post_thumbnail_id();
                        $image_sizes = wp_get_registered_image_subsizes($image_id);

                        // Get the URL of the full-size image
                        $image_url = wp_get_attachment_image_src($image_id, 'full');
                        $full_image_src = esc_attr($image_url[0]);

                        // Initialize variables for srcset and sizes
                        $image_srcset = '';

                        // Build srcset and sizes values
                        foreach ($image_sizes as $size_name => $size_data) {
                            $image_url = wp_get_attachment_image_src($image_id, $size_name);
                            $image_srcset .= esc_attr($image_url[0]) . ' ' . esc_attr($size_data['width']) . 'w, ';
                        }

                        // Remove trailing comma and space from srcset
                        $image_srcset = rtrim($image_srcset, ', ');

                        // Set sizes value based on the maximum width of the full-size image
            
                        if (isset($image_sizes['full']) && isset($image_sizes['full']['width'])) {
                            $sizes_value = '(max-width: ' . esc_attr($image_sizes['full']['width']) . 'px) 100vw, ' . esc_attr($image_sizes['full']['width']) . 'px';
                        } else {
                            // Provide a default value or handle the case where 'full' or 'width' is not defined
                            $sizes_value = '(max-width: 100vw)'; // Or any other appropriate fallback
                        }

                        ?>
                        <div class="py-[30px]">
                            <?php
                            render_lazy_load_image([
                                'image_path' => esc_url($full_image_src),
                                'alt' => get_the_title(),
                                'class' => 'rounded-xl',
                                'lazy_load' => true,
                            ]);
                            ?>
                        </div>
                    <?php endif; ?>
                    <!-- /post thumbnail -->

                    <div class="py-3">
                        <h1 class="text-[20px] md:text-[36px] pb-3">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <span class=" font-semibold">
                                    <?php the_title(); ?>
                                </span>
                            </a>
                        </h1>
                        <div class="post-details">
                            <span class="date"><?php the_time('F j, Y'); ?>         <?php //the_time('g:i a'); 
                                               ?></span>
                            <span class="author font-bold"><?php _e('By', 'html5blank'); ?>
                                <?php the_author_posts_link(); ?></span>
                            <!-- <span class="comments"><?php if (comments_open(get_the_ID()))
                                comments_popup_link(__('Leave your thoughts', 'html5blank'), __('1 Comment', 'html5blank'), __('% Comments', 'html5blank')); ?></span> -->
                        </div>
                    </div>

                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="share-buttons ">
                        <div class="flex gap-5 items-center py-3 mb-3 font-bold border-b-2">
                            <?php
                            $post_url = get_permalink();
                            $post_title = get_the_title();
                            $whatsapp_message = rawurlencode("Check out this post: $post_title - $post_url");
                            ?>
                            <span>
                                Share:
                            </span>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_message; ?>" target="_blank"
                                rel="noopener noreferrer" class="share-button whatsapp">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="18"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url); ?>"
                                target="_blank" rel="noopener noreferrer" class="share-button facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                                </svg>
                            </a>
                            <a href="https://t.me/share/url?url=<?php echo esc_url($post_url); ?>&text=<?php echo rawurlencode($post_title); ?>"
                                target="_blank" rel="noopener noreferrer" class="share-button telegram">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="19.5"
                                    viewBox="0 0 496 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M248 8C111 8 0 119 0 256S111 504 248 504 496 393 496 256 385 8 248 8zM363 176.7c-3.7 39.2-19.9 134.4-28.1 178.3-3.5 18.6-10.3 24.8-16.9 25.4-14.4 1.3-25.3-9.5-39.3-18.7-21.8-14.3-34.2-23.2-55.3-37.2-24.5-16.1-8.6-25 5.3-39.5 3.7-3.8 67.1-61.5 68.3-66.7 .2-.7 .3-3.1-1.2-4.4s-3.6-.8-5.1-.5q-3.3 .7-104.6 69.1-14.8 10.2-26.9 9.9c-8.9-.2-25.9-5-38.6-9.1-15.5-5-27.9-7.7-26.8-16.3q.8-6.7 18.5-13.7 108.4-47.2 144.6-62.3c68.9-28.6 83.2-33.6 92.5-33.8 2.1 0 6.6 .5 9.6 2.9a10.5 10.5 0 0 1 3.5 6.7A43.8 43.8 0 0 1 363 176.7z" />
                                </svg>
                            </a>
                            <a href="mailto:?subject=<?php echo rawurlencode($post_title); ?>&body=Check out this post: <?php echo esc_url($post_url); ?>"
                                class="share-button email">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>&title=<?php echo rawurlencode($post_title); ?>"
                                target="_blank" rel="noopener noreferrer" class="share-button linkedin">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="18"
                                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                </svg>
                            </a>
                        </div>
                    </div>



                    <?php
                    $edit_link_url = get_edit_post_link(get_the_ID());
                    if ($edit_link_url):
                        ?>
                        <div class="edit-link">
                            <a href="<?php echo esc_url($edit_link_url); ?>">
                                <div class="flex gap-3 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                    </svg>
                                    <span>
                                        Edit
                                    </span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                </article>
                <!-- /article -->

            <?php endwhile; ?>

        <?php else: ?>

            <!-- article -->
            <article>

                <h1><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h1>

            </article>
            <!-- /article -->

        <?php endif; ?>

    </section>
    <!-- /section -->


</main>

<?php
// Get the current post's ID
$current_post_id = get_the_ID();

// Get the current post's categories
$categories = get_the_category($current_post_id);

// Get the current post's tags
$tags = get_the_tags($current_post_id);

// Combine categories and tags to use as related terms
$related_terms = array();

if (!empty($categories)) {
    foreach ($categories as $category) {
        $related_terms[] = $category->term_id;
    }
}

if (!empty($tags)) {
    foreach ($tags as $tag) {
        $related_terms[] = $tag->term_id;
    }
}

// Query related posts based on categories and tags
$args = array(
    'numberposts' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'blog',
    'post__not_in' => array($current_post_id), // Exclude the current post
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $related_terms,
        ),
    ),
);
$related_posts = get_posts($args);

// var_dump($related_posts);
?>

<?php if (!empty($related_posts)): ?>
    <div class="container">
        <?php
        $section_data = [
            'title' => 'Related Blog',
            'data' => $related_posts,
            'content_include' => get_template_directory() . '/components/article/card_wrapper.php'
        ];
        // include(get_template_directory() . '/components/section_wrapper.php');
        include(get_template_directory() . '/components/blog/latest-widget/index.php');
        ?>
    </div>
<?php endif; ?>