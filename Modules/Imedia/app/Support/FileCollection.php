<?php


namespace Modules\Imedia\Support;

use Illuminate\Database\Eloquent\Collection;
use Modules\Imedia\Models\File;

class FileCollection extends Collection
{

    /**
     * Relation used with transformers in Modules
     */
    public function byZones(array $zones = [], $resource = null)
    {
        $files = $this; //Get files
        $classInfo = $this->getClassInfo($resource);
        //Get media fillable
        $mediaFillable = $zones[$classInfo["entityName"]] ?? [];
        $response = []; //Default response

        //To each Zone (MediaFillable) - Transform Files
        foreach ($mediaFillable as $fieldName => $fileType) {
            $zone = strtolower($fieldName); //Get zone name
            //Init the zone , multiple or single
            $response[$zone] = ($fileType == 'multiple') ? [] : false;
            //Get files by zone
            $filesByZone = $files->filter(function ($item) use ($zone) {
                return ($item->pivot->zone == strtolower($zone));
            });

            //Not files so Add fake file
            if (!$filesByZone->count()) $filesByZone = [0];

            //Transform files
            foreach ($filesByZone as $file) {
                $transformedFile = $this->transformFile($file, $classInfo, $resource);
                //Add to response
                if ($fileType == 'multiple') {
                    if ($file) array_push($response[$zone], $transformedFile);
                } else
                    $response[$zone] = $transformedFile;
            }
        }
        //Response
        return (object)$response;
    }

    /**
     *
     */
    public function transformFile($file, $classInfo, $defaultPath = null)
    {

        //Create a mokup of a file if not exist
        if (!$file) {
            if (!$defaultPath) {
                $defaultPath = strtolower("/modules/{$classInfo["moduleName"]}/img/{$classInfo["entityName"]}/default.jpg");

                $defaultPath = \Modules\Imedia\Support\FileHelper::validateMediaDefaultPath($defaultPath);
            }
            $file = new \Modules\Imedia\Models\File(['path' => $defaultPath, 'is_folder' => 0]);
        }

        //Transform the file
        $transformerParams = $classInfo['entityName'] == 'user' ? ['ignoreUser' => true] : [];

        return json_decode(json_encode(new \Modules\Imedia\Transformers\FileTransformer($file, $transformerParams)));
    }

    /**
     * Get information about the class that use this trait
     */
    private function getClassInfo($resource): array
    {
        //Get Model
        $model = $resource->resource;

        $entityNamespace = get_class($model);
        $entityNamespaceExploded = explode('\\', strtolower($entityNamespace));

        return [
            "moduleName" => $entityNamespaceExploded[1],
            "entityName" => $entityNamespaceExploded[3],
        ];
    }
}
