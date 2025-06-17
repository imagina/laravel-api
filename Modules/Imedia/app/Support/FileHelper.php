<?php

namespace Modules\Imedia\Support;

class FileHelper
{

    /**
     *
     */
    public static function getExtension($name): string
    {
        return substr($name, strrpos($name, '.'));
    }

    /**
     *
     */
    public static function getSlugToFileName($name)
    {
        $extension = self::getExtension($name);
        $name = str_replace($extension, '', $name);
        $name = \Str::slug($name);
        return $name . strtolower($extension);
    }
}
