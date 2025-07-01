<?php
function render_pagination($paged, $total_pages)
{
    ?>
    <div class="flex justify-between items-center mb-10">
        <!-- Previous Button -->
        <div>
            <?php if ($paged > 1 && $paged <= $total_pages) { ?>
                <a href="?pages=<?php echo $paged - 1 ?>" class="flex items-center gap-2 text-black hover:text-[#f7c971]">
                    <!-- Previous Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                </a>
            <?php } ?>
        </div>

        <!-- Pagination Numbers -->
        <div class="flex gap-2">
            <?php
            $range = 5; // Number of pages to display in the range
            $start = max(1, $paged - intval($range / 2));
            $end = min($total_pages, $start + $range - 1);

            if ($start > 1) {
                echo '<a href="?pages=1" class="px-3 py-1 font-bold text-black hover:text-[#f7c971]">1</a>';
                if ($start > 2)
                    echo '<span class="px-2 text-gray-500">...</span>';
            }

            for ($i = $start; $i <= $end; $i++) {
                echo '<a href="?pages=' . $i . '" class="px-3 py-1 font-bold ' . ($i == $paged ? ' text-black bg-[#f7c971] rounded-full' : 'text-black hover:text-[#f7c971]') . '">' . $i . '</a>';
            }

            if ($end < $total_pages) {
                if ($end < $total_pages - 1)
                    echo '<span class="px-2 text-gray-500">...</span>';
                echo '<a href="?pages=' . $total_pages . '" class="px-3 py-1 text-black hover:text-[#f7c971]">' . $total_pages . '</a>';
            }
            ?>
        </div>

        <!-- Next Button -->
        <div>
            <?php if ($paged < $total_pages) { ?>
                <a href="?pages=<?php echo $paged + 1 ?>" class="flex items-center gap-2 text-black hover:text-[#f7c971]">
                    <!-- Next Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>
