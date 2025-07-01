<?php
function render_lazy_load_image($attributes = [])
{
    $defaults = [
        'image_path' => '',
        'alt' => '',
        'class' => 'h-10',
        'lazy_load' => true,
        'placeholder' => '',
    ];
    $attr = array_merge($defaults, $attributes);
    if (empty($attr['image_path'])) {
        return;
    }

    $image_url = esc_url(($attr['image_path']));
    $onclick_attr = !empty($attr['onclick']) ? ' onclick="' . $attr['onclick'] . '"' : '';

    echo '<div class="lazy-image-container w-full flex items-center justify-center relative">';
    echo '<div class="loader-container"><div class="loader"></div></div>'; // Loader ditambahkan
    echo '<noscript>';
    echo '<img alt="' . htmlspecialchars($attr['alt'], ENT_QUOTES, 'UTF-8') . '" src="' . $image_url . '" class="' . htmlspecialchars($attr['class'], ENT_QUOTES, 'UTF-8') . '">';
    echo '</noscript>';
    echo '<img alt="' . htmlspecialchars($attr['alt'], ENT_QUOTES, 'UTF-8') . '" src="' . esc_url($attr['placeholder']) . '" class="' . htmlspecialchars($attr['class'], ENT_QUOTES, 'UTF-8') . ' lazyload" data-src="' . $image_url . '"' . $onclick_attr . '>';
    echo '</div>';
}
function run_render_lazy_load_image()
{ ?>

    <?php RenderJS::start() ?>
    <script>
        new zarcore.LazyLoader({
            rootMargin: '0px',
            threshold: 0.1
        });
    </script>
    <?php RenderJS::end() ?>

    <?php RenderStyle::start() ?>
    <style>
       
    </style>
    <?php RenderStyle::end() ?>

<?php } ?>