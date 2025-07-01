<?php

$sharedLibPath = __DIR__;
$subdirectories = glob($sharedLibPath . '/*', GLOB_ONLYDIR);

foreach ($subdirectories as $subdirectory) {
    $indexFilePath = $subdirectory . '/index.php';
    if (file_exists($indexFilePath)) {
        require_once $indexFilePath;
    }
}