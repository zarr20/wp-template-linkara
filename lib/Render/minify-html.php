<?php

class MinifyHtml
{
    protected static $minifiedHtml = '';
    public static function startMinifyHTML()
    {
        ob_start();
    }

    public static function endMinifyHTML()
    {
        $minifiedHtml = ob_get_clean();
        $pattern = '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s';
        $minifiedHtml = preg_replace($pattern, '', $minifiedHtml);
        echo $minifiedHtml;
    }
}
