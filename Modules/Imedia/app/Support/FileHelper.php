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

    /**
     * Get path for the Thumbnail
     */
    public static function getPathFor(string $filename, $label, $extension, $folderId = 0)
    {

        //Delete extension
        $pathInfo = pathinfo($filename, PATHINFO_FILENAME);

        if ($folderId !== 0) {
            dd("CASO FOLDER");
            /* $parent = app(FolderRepository::class)->findFolder($folderId);
            if ($parent !== null) {
                return $parent->path->getRelativeUrl() . '/' . $filename;
            } */
        }

        return config('imedia.files-path') . "{$pathInfo}-{$label}.{$extension}";
    }
}
