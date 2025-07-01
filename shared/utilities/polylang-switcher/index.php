<?php if (function_exists('pll_the_languages')) : ?>
    <?php
    $languages = pll_the_languages(array('dropdown' => 1, 'hide_current' => 0, 'raw' => 1));
    ?>
    <?php if (!empty($languages)) : ?>
        <div class="relative">
            <button id="languageDropdownButton" class="sm:flex h-[45px] hover:bg-[#20252F] hover:text-white border-2 border-[#20252F] font-bold px-4 rounded flex justify-between items-center <?= isset($showDropdown) && $showDropdown ? 'hover:bg-[#20252F]' : '' ?>" type="button">
                <?php foreach ($languages as $language) : ?>
                    <?php if ($language['current_lang']) : ?>
                        <span class="flex gap-3 items-center uppercase">
                            <?php if (!empty($language['flag'])) : ?>
                                <div class="lazy-load" data-src="<?= esc_url($language['flag']) ?>" alt="<?= esc_attr($language['name']) ?>" class="w-5 h-auto lazyload"></div>
                                <!-- <img data-src="<?= esc_url($language['flag']) ?>" alt="<?= esc_attr($language['name']) ?>" class="w-5 h-auto lazyload" /> -->
                            <?php endif; ?>
                            <?= esc_html($language['slug']) ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
                <svg class="w-2.5 h-2.5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="languageDropdown" class="hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 mt-2 absolute right-0 min-w-full top-full border-2 border-[#20252F] rounded-md">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="languageDropdownButton">
                    <?php foreach ($languages as $language) : ?>
                        <?php
                        $translated_id = pll_get_post(get_the_ID(), $language['slug']);
                        $has_translation = $translated_id ? get_post_status($translated_id) === 'publish' : false;
                        ?>
                        <?php if ($has_translation) : ?>
                            <li>
                                <a href="<?= esc_url($language['url']) ?>" aria-label="<?= esc_html($language['name']) ?>" class="block px-4 py-2 hover:bg-gray-100 <?= $language['current_lang'] ? 'font-bold' : '' ?>">
                                    <?= esc_html($language['name']) ?>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <div class="languageNoContent block px-4 py-2 hover:bg-gray-100">
                                    <?= esc_html($language['name']) ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>

        <?php RenderJS::start() ?>
        <script>
            $('#languageDropdownButton').on('click', function(e) {
                e.stopPropagation();
                $('#languageDropdown').removeClass('hidden');
            });

            $('.languageNoContent').on('click', function(e) {
                e.preventDefault()
                ZarrAlert.show({
                    status: "Content is not available",
                    message: "The content you are looking for is not available in the selected language."
                });
            });

            $(document).on('click', function(e) {
                if (!$('#languageDropdownButton').is(e.target) && $('#languageDropdownButton').has(e.target).length === 0 && !$('#languageDropdown').is(e.target) && $('#languageDropdown').has(e.target).length === 0) {
                    $('#languageDropdown').addClass('hidden');
                }
            });
        </script>
        <?php RenderJS::end() ?>

    <?php endif; ?>
<?php endif; ?>