<?php function SectionWrapper($props)
{
    ob_start();
?>
    <div class="container">
        <div class="pb-10">
            <div class="grid grid-cols-none sm:grid-cols-5 gap-5 sm:items-center justify-between my-[50px]">
                <div class="sm:col-span-4">
                    <h2 class="text-3xl font-bold">
                        <?php echo $props['title']; ?>
                    </h2>
                    <p>
                        <?php echo $props['subtitle']; ?>
                    </p>
                </div>
                <div>
                    <div>
                        <a class="sectionMore" href="<?php echo esc_url($props['link_url']); ?>">
                            <?php echo esc_html($props['link_text']); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php
    }

    function endSectionWrapper()
    {
        $SectionContent = ob_get_clean();
        ?>
            <?php echo $SectionContent; ?>
        </div>
    </div>
<?php
    }
