<header id="header" class="fixed w-full z-50 top-0">
    <div class="container">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex w-0 flex-1 items-center" style="height:60px">
                <a href="<?php echo map_url("home"); ?>"
                    aria-label="<?php echo get_field('options_header_logo', 'option') && esc_attr(get_field('options_header_logo', 'option')['alt']); ?>">
                    <?php if (get_field('options_header_logo', 'option')) : ?>
                        <?php
                        render_lazy_load_image([
                            'image_path' => get_field('options_header_logo', 'option')['url'],
                            'alt' => get_field('options_header_logo', 'option')['alt'],
                            'class' => 'max-w-[150px] lazy-load',
                            'lazy_load' => true,
                        ]);
                        ?>
                    <?php else : ?>
                        <span class="text-xl font-bold">
                            <?php echo bloginfo('name'); ?>
                        </span>
                    <?php endif; ?>
                </a>

            </div>
            <div id="nav">
                <ul class="flex items-stretch gap-4">
                    <?php
                    $cta_text = get_field('options_header_cta_text', 'option');
                    $cta_link = get_field('options_header_cta_link', 'option');

                    if ($cta_text && $cta_link): ?>
                        <li class="flex">

                            <a
                                href="<?php echo esc_url($cta_link); ?>"
                                class="flex justify-center items-center h-[45px] bg-[#fa9136e0] text-white font-bold rounded">
                                <div class="px-5">
                                    <?php echo esc_html($cta_text); ?>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (function_exists('pll_current_language')): ?>
                        <li class="flex">
                            <?php include get_template_directory() . "/shared/utilities/polylang-switcher/index.php"; ?>
                        </li>
                    <?php endif; ?>
                    <li class="flex">
                        <button aria-label="navigation-toggle"
                            class="navigation-toggle aspect-square flex justify-center items-center h-[45px] bg-[#20252F] text-white border-2 border-[#20252F] font-bold rounded">
                            <div class=" aspect-square">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                </svg>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<?php if (is_admin_bar_showing()): ?>
    <?php RenderStyle::start() ?>
    <style>
        #wpadminbar {
            position: fixed;
        }

        #header {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 226.94%);
        }
    </style>
    <?php RenderStyle::end() ?>
<?php endif; ?>

<?php RenderStyle::start() ?>
<style>
    #header {
        background: linear-gradient(0deg, rgba(0, 0, 0, 0) 0%, #000000 226.94%);
    }
</style>
<?php RenderStyle::end() ?>

<?php RenderJS::start() ?>
<script>
    var headerHeight = document.getElementById('header').offsetHeight;
    <?php if (is_admin_bar_showing()): ?>
        headerHeight = headerHeight + document.getElementById('wpadminbar').offsetHeight;
        document.getElementById('header').style.marginTop = document.getElementById('wpadminbar').offsetHeight + "px";
    <?php endif; ?>
    document.body.style.paddingTop = headerHeight + "px";

    gsap.fromTo(
        "#header", {
            autoAlpha: 0,
            y: -200
        }, {
            autoAlpha: 1,
            y: 0,
            duration: 1
        }
    );
</script>
<?php RenderJS::end() ?>