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
     * Create path to: Folder, File, Thumbnail
     */
    public static function makePath(string $filename, $folderId = null)
    {

        if (!is_null($folderId)) {
            $parent = self::findFolder($folderId);
            if ($parent !== null) {
                return $parent->path . '/' . $filename;
            }
        }

        return config('imedia.files-path') . $filename;
    }

    /**
     * Find specific folder
     */
    public static function findFolder($folderId)
    {

        $params = json_decode(json_encode([
            "filter" => [
                "is_folder" => 1
            ]
        ]));

        return  app("Modules\Imedia\Repositories\FileRepository")->getItem($folderId, $params);
    }

    /**
     *
     */
    public static function validateMediaDefaultPath($path)
    {
        //If path include word ad replace by media default path to prevent issues with ad blockers
        if (str_contains(strtolower($path), 'ad')) $path = "modules/imedia/img/file/default.jpg";
        //Response
        return $path;
    }
}
