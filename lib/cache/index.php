<?php

class CacheHelper
{
    private static $cacheDir = __DIR__ . '/cache/';

    public static function get($key)
    {
        $filename = self::getCacheFilename($key);

        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $data = unserialize($content);
            if ($data !== false && $data['expiry'] > time()) {
                return $data['value'];
            } else {
                self::delete($key);
            }
        }

        return null;
    }

    public static function set($key, $value, $expiry = 3600)
    {
        $filename = self::getCacheFilename($key);
        $data = [
            'value' => $value,
            'expiry' => time() + $expiry,
        ];
        $content = serialize($data);
        file_put_contents($filename, $content);
    }

    public static function delete($key)
    {
        $filename = self::getCacheFilename($key);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    private static function getCacheFilename($key)
    {
        return self::$cacheDir . md5($key) . '.cache';
    }
}
?>
