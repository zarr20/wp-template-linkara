
<div style="background: linear-gradient(0deg, rgba(0, 0, 0, 0) 0%, #ff0000 226.94%);height: 174px;"></div>


<section class="bg-white py-20 px-6 md:px-24 max-w-7xl mx-auto space-y-20">
    <!-- Section Title -->
    <h1 class="text-5xl font-extrabold text-gray-900 mb-16 text-center tracking-tight">
        <?php the_field('about_title', 'option'); ?>
    </h1>

    <!-- Tentang singkat -->
    <div class="max-w-4xl mx-auto space-y-6">
        <p class="text-gray-700 text-lg leading-relaxed">
            <?php the_field('about_description', 'option'); ?>
        </p>
    </div>

    <!-- Pimpinan dengan foto -->
    <div class="max-w-4xl mx-auto space-y-6">
        <h2 class="text-3xl font-semibold text-gray-800 border-b border-gray-300 pb-3 mb-6">
            <?php the_field('leader_title', 'option'); ?>
        </h2>

        <?php
        $leader_photo = get_field('leader_photo', 'option');
        if ($leader_photo): ?>
            <div class="mb-6 flex justify-center">
                <img
                    src="<?php echo esc_url($leader_photo['sizes']['medium']); ?>"
                    alt="<?php echo esc_attr($leader_photo['alt']); ?>"
                    class="w-48 h-auto rounded-lg">
            </div>
        <?php endif; ?>

        <p class="text-gray-700 leading-relaxed mb-6 text-lg">
            <?php the_field('leader_description', 'option'); ?>
        </p>
    </div>

    <!-- Program Kelas dengan SwiperJS -->
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-900 mb-8 border-b border-gray-300 pb-3">
            Program Kelas Kami
        </h2>

        <div class="swiper about-slider">
            <div class="swiper-wrapper">
                <?php if (have_rows('program_classes', 'option')): ?>
                    <?php while (have_rows('program_classes', 'option')): the_row(); ?>
                        <div class="swiper-slide bg-gray-50 rounded-lg p-6 shadow-sm border border-gray-200">
                            <h3 class="text-xl font-semibold text-indigo-700 mb-3 border-b border-indigo-300 pb-1">
                                <?php the_sub_field('class_title'); ?>
                            </h3>

                            <?php $type = get_sub_field('class_content_type'); ?>
                            <?php if ($type === 'list') : ?>
                                <ul class="list-disc list-inside space-y-3 text-gray-700 text-sm leading-relaxed">
                                    <?php if (have_rows('class_items')): ?>
                                        <?php while (have_rows('class_items')): the_row(); ?>
                                            <li><?php the_sub_field('item'); ?></li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php else : ?>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    <?php the_sub_field('class_paragraph'); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
       
        </div>
    </div>
</section>

<?php RenderJS::start() ?>
<script>
    new Swiper('.about-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 2500,
        },
        breakpoints: {
            640: {
                slidesPerView: 2.1,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
</script>
<?php RenderJS::end() ?>


<?php RenderStyle::start() ?>
<style>
    body {
        padding-top: 0 !important;
    }
</style>
<?php RenderStyle::end() ?>