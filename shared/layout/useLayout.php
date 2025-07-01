<?php
function useLayout($child, $layout = "main-layout")
{
    ob_start();
    include $child;
    $child_content = ob_get_clean();
    $layout = __DIR__ . "/$layout/index.php";
    include $layout;
}
?>