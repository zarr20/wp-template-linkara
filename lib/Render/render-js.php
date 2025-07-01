<?php

class RenderJS
{
    private static $script = '';
    public static function start()
    {
        ob_start();
    }

    public static function end()
    {
        self::$script .= ob_get_clean();
    }

    public static function PrintJS()
    {
        // simpan ke file
        // handle sesuai page yg generate
        // tampilkan file cached sesuai page yang generate
        // jika durasi cache habis generate kembali
        if (!empty(self::$script)) {
            $WithoutTags = str_replace(['<script>', '</script>'], '', self::$script);
            $minified = Minifier::minify($WithoutTags);
            echo $minified;
        }
    }
}
