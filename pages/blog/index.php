<?php
$dir = get_template_directory() . "/shared";
include("$dir/utilities/pagination/index.php");
?>

<div style="background-color: #f9f9f9;">
    <div class="container py-[100px] pt-[7rem]">
        <h1 class="font-bold text-[42px]">
            Blog
        </h1>
        <p class="max-w-[500px]">
            Maximize your brand through visuals and experiences.
            Bring out the value in an effective way.
        </p>
    </div>
</div>

<?php
$paged = isset($_GET['pages']) && !empty($_GET['pages']) ? (int) $_GET['pages'] : 1;
$query = new WP_Query(array(
    'post_type' => 'blog',
    'posts_per_page' => 6,
    'paged' => $paged,
));
?>

<div class="py-[70px]">
    <div class="container">
        <div class="flex flex-col md:flex-row justify-between gap-4">
            <div class="md:w-[60%] flex flex-col gap-[50px]">
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <?php
                    $post_id = get_the_ID();
                    $post_title = get_the_title();
                    $thumbnail = get_the_post_thumbnail_url($post_id);
                    $excerpt = wp_trim_words(get_the_excerpt(), 30);
                    $url = get_permalink();
                    $tags = get_the_tags();
                    ?>
                    <div class="flex flex-wrap sm:flex-nowrap gap-7">
                        <div class="w-full sm:w-[40%]">
                            <div class="aspect-square w-full rounded-[30px] overflow-hidden">
                                <a href="<?php echo esc_url($url); ?>">
                                    <?php
                                    render_lazy_load_image([
                                        'image_path' => esc_url($thumbnail),
                                        'alt' => esc_attr($post_title),
                                        'class' => 'absolute w-full h-full object-cover',
                                        'lazy_load' => true,
                                    ]);
                                    ?>
                                </a>
                            </div>
                        </div>
                        <div class="w-fit mb-[30px]">
                            <a href="<?php echo esc_url($url); ?>">
                                <h2 class="font-bold text-[24px] hover:underline">
                                    <?php echo esc_html($post_title); ?>
                                </h2>
                            </a>
                            <div class="post-details">
                                <span class="date"><?php the_time('F j, Y'); ?></span>
                                <span class="author font-bold"><?php _e('By', 'html5blank'); ?>
                                    <?php the_author_posts_link(); ?></span>
                            </div>
                            <?php if ($tags): ?>
                                <div class="flex gap-3 flex-wrap py-3">
                                    <?php foreach ($tags as $tag): ?>
                                        <div class="rounded-full p-1 px-3 bg-[#F7C971] text-[12px] font-bold capitalize">
                                            <?php echo esc_html($tag->name); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <div class="mb-2">
                                    <?php echo esc_html($excerpt); ?>
                                </div>
                                <span class="font-bold underline hover:no-underline">
                                    <a href="<?php echo esc_url($url); ?>">
                                        Read more
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>


                <?php render_pagination($paged, $query->max_num_pages); ?>

            </div>
            <div class="md:w-[30%]">
                <div class="text-[20px]">
                    Discover more of what matters to you
                </div>

                <?php
                $tags = get_terms(array(
                    'taxonomy' => 'post_tag',
                    'hide_empty' => false,
                ));

                if ($tags) {
                    ?>
                    <div class="flex gap-3 flex-wrap py-3">
                        <?php foreach ($tags as $tag): ?>
                            <?php
                            $tag_link = get_tag_link($tag->term_id);
                            ?>
                            <a href="<?= esc_url($tag_link); ?>"
                                class="rounded-full p-1 px-3 bg-[#F7C971] text-[12px] font-bold capitalize">
                                <?= esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php
                } else {
                    echo 'No tags found.';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<style>
    header {
        position: absolute;
        width: 100%;
        z-index: 1;
    }
</style>